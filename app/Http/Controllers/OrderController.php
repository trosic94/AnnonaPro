<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItems;
use App\OrdersLog;
use App\PaymentMethod;
use App\OrderStatus;

use Illuminate\Http\Request;

use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDO;
use Carbon\Carbon;
use Session;
use Cookie;
use Config;
use PDF;
use App;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{

    public function checkOut()
    {     
        $ulogovan = Auth::user();
        $intro = 'Poručivanje';

        $paymentMethod = PaymentMethod::paymentMethods();

        return view('order.checkout', compact('intro','ulogovan','paymentMethod'));
    }

    public function orderConfirmed()
    {     
        $ulogovan = Auth::user();
        $orderTotal = Session::get('mailData');

        $intro = 'Hvala!';

        return view('order.thank-you', compact('intro','ulogovan','orderTotal'));
    }

    public function quitPayment()
    {     
        $ulogovan = Auth::user();
        
        //preusmeravanje u koliko je odustao od paymenta
        if(Auth::check()):
            return redirect('/checkout');
        else:
            return redirect('/');
        endif;
    }

    public function confirmOrder(Request $request)
    {

       // return $request->all();

        $ulogovan = Auth::user();

        // podaci iz SESIJE
        $crt = Session::get('crt');

        // kreiram DATUM
        $sada = Carbon::now();
        $order_DATETIME = date('d.m.Y H:i:s', strtotime($sada));

        // app URL
        $url = URL::to('/');

        // PAYMENT METHOD
        $paymentMethod = request('payment');


        // CUSTOME ------------------------------------------------------------------------------------ //
        $customer = array();

        $customer['name'] = $ulogovan->name;
        $customer['last_name'] = $ulogovan->last_name;
        $customer['phone'] = $ulogovan->phone;
        $customer['email'] = $ulogovan->email;
        $customer['address'] = $ulogovan->address;
        $customer['zip'] = $ulogovan->zip;
        $customer['city'] = $ulogovan->city;
        $customer['phone'] = $ulogovan->phone;
        $customer['email'] = $ulogovan->email;


        // ORDER -------------------------------------------------------------------------------------- //
        $order = array();

        $order['user_id'] = $ulogovan->id;
        $order['order_number'] = null;
        $order['order_invoice'] = null; // unosi se kasnije, kada se kreira ID ordera
        $order['rabat'] = $ulogovan->discount;
        $order['total'] = $crt['total'];
        $order['order_status'] = 1; // uplata na cekanju
        $order['payment_method'] = $paymentMethod;
        $order['proforma_invoice'] = null; // unosi se kasnije, kada se kreira ID ordera
        $order['comment'] = request('cart_comment'); // komentar vezan za porudzbinu
        $order['merchantPaymentId'] = null; // unosi se kasnije, kada se koristi CC payment (1)
        $order['pgTranId'] = null; // unosi se kasnije, kada se koristi CC payment (1)
       
        $orderID = DB::table('orders')->insertGetId($order);


        // ORDER DOCs --------------------------------------------------------------------------------- //
        $orderDOCs = array();

        // ORDER INVOICE
        $orderDOCs['order_invoice'] = Order::invoiceNO($orderID);
        // priprema za kasnije slanje na mail
        $order['order_invoice'] = $orderDOCs['order_invoice'];


        // PROFORMA INVOICE NO
        $orderDOCs['proforma_invoice'] = Order::proformaInvoiceNO($orderID);
        // priprema za kasnije slanje na mail
        $order['proforma_invoice'] = $orderDOCs['proforma_invoice'];

        // kreiram ORDER NUMBER
        $orderDOCs['order_number'] = Order::orderNumber($orderID);
        // priprema za kasnije slanje na mail
        $order['order_number'] = $orderDOCs['order_number'];

        // DATUM koji se koristi pri kreiranju PDFa
        $order['order_date'] = $sada;

        $update_order = DB::table('orders')->where('id',$orderID)->update($orderDOCs);


        // ORDER ITEMS -------------------------------------------------------------------------------- //
        $orderItems = array(); // podaci za upis u DB order_items
        $products = array(); // podaci za slanje mailom

        for ($oi=0; $oi < count($crt['products']); $oi++) { 
            
            $orderItems[$oi]['order_id'] = $orderID;
            $orderItems[$oi]['product_id'] = $crt['products'][$oi]['prod_id'];
            $orderItems[$oi]['kolicina'] = $crt['products'][$oi]['quantity'];
            $orderItems[$oi]['description'] = null;

            // u zavisnosti od toga koja cena je dostupna
            // prvo se uzima cena sa popustom
            if ($crt['products'][$oi]['prod_price_with_discount'] != null):
                $total = $crt['products'][$oi]['prod_price_with_discount'] * $crt['products'][$oi]['quantity'];

                //cena koja se prikazuje u mailu
                $displayPrice = $crt['products'][$oi]['prod_price_with_discount'];
            else:
                $total = $crt['products'][$oi]['prod_price'] * $crt['products'][$oi]['quantity'];

                //cena koja se prikazuje u mailu
                $displayPrice = $crt['products'][$oi]['prod_price'];
            endif;

            $orderItems[$oi]['total'] = $total;


            $products[$oi]['order_id'] = $orderID;
            $products[$oi]['product_id'] = $crt['products'][$oi]['prod_id'];
            $products[$oi]['prod_title'] = $crt['products'][$oi]['prod_title'];
            $products[$oi]['prod_sku'] = $crt['products'][$oi]['prod_sku'];
            $products[$oi]['quantity'] = $crt['products'][$oi]['quantity'];
            $products[$oi]['display_price'] = $displayPrice;
            $products[$oi]['total'] = $total;


            if ($crt['products'][$oi]['prod_image'] != null):
                $imgFILE = $crt['products'][$oi]['prod_image'];
            else:
                $imgFILE = 'no_image.jpg';
            endif;

            $products[$oi]['prod_image'] = $url.'/storage/products/'.$imgFILE;

        }

        $insert_orderItems = DB::table('order_items')->insert($orderItems);

        // SHIPPING ---------------------------------------------------------------------------------- //

        // na koju adresu se salje?
        $shippingOption = request('cart_shipping_address_option');

        $orderShipping = array();

        // zajednicki podaci
        $orderShipping['user_id'] = $ulogovan->id;
        $orderShipping['order_id'] = $orderID;

        switch ($shippingOption) {
            case 'profil':
                
                $orderShipping['shp_name'] = $ulogovan->name;
                $orderShipping['shp_last_name'] = $ulogovan->last_name;
                $orderShipping['shp_email'] = $ulogovan->email;
                $orderShipping['shp_phone'] = $ulogovan->phone;
                $orderShipping['shp_address'] = $ulogovan->address;
                $orderShipping['shp_zip'] = $ulogovan->zip;
                $orderShipping['shp_city'] = $ulogovan->city;

                break;
            
            case 'other':

                $orderShipping['shp_name'] = request('cart_new_shp_name');
                $orderShipping['shp_last_name'] = request('cart_new_shp_last_name');
                $orderShipping['shp_email'] = request('cart_new_shp_email');
                $orderShipping['shp_phone'] = request('cart_new_shp_phone');
                $orderShipping['shp_address'] = request('cart_new_shp_address');
                $orderShipping['shp_zip'] = request('cart_new_shp_zip');
                $orderShipping['shp_city'] = request('cart_new_shp_city');

                break;
        }

        $shippingOption = DB::table('order_shipping')->insert($orderShipping);


        // EMAIL NOTIFICATIONS ----------------------------------------------------------------------- //

        // ORDER STATUS data
        $orderStatusDATA = DB::table('order_status as OS')
                            ->where('OS.id',$order['order_status'])
                            ->select(
                                'OS.title as title',
                                'OS.description as description'
                            )
                            ->first();

        $order['order_status_name'] = $orderStatusDATA->title;
        $order['order_status_description'] = $orderStatusDATA->description;

        // PAYMENT METHOD data
        $paymentMethodDATA = DB::table('payment_methods as PM')
                            ->where('PM.id',$order['payment_method'])
                            ->select(
                                'PM.title as title',
                                'PM.description as description'
                            )
                            ->first();

        $order['payment_method_name'] = $paymentMethodDATA->title;
        $order['payment_method_description'] = $paymentMethodDATA->description;



        // FINAL ORDER data ******************************************************************** ////
        $orderDATA = array();

        $orderDATA['url'] = $url;
        $orderDATA['dateTime'] = $order_DATETIME;
        $orderDATA['customer'] = $customer; // podaci o ulogovanom korisniku
        $orderDATA['order'] = $order; // podaci o ORDERu
        $orderDATA['order_items'] = $products; // podaci o proizvodima
        $orderDATA['order_shipping'] = $orderShipping; // podaci o adresi za isporuku

        // kreiram sesiju za test, koristim za ThankYou page
        //Session::put('ordTEST', $orderDATA);

        // kreiram PDF za download
        $pdf = PDF::loadView('pdf.proforma-invoice', $orderDATA);
        $pdf->save('storage/proforma-invoice/'.$orderDATA['order']['proforma_invoice'].'.pdf');

        // slanje NOTIFIKACIJA
        $sendOrderInfoCustomer = Order::sendOrderInfoCustomer($orderDATA);
        $sendOrderInfoAdmin = Order::sendOrderInfoAdmin($orderDATA);

        //brisem podatke o ORDERu iz sesije
        Session::forget('crt');

        return redirect('/thank-you')->with(['orderDATA' => $orderDATA]);

    }

    public function orderDetails($id)
    {
        $intro = 'Informacije o odabranoj porudzbini';
        $ulogovan = Auth::user();

        $orderDATA = Order::with('orderItems','orderItems.product','orderStatus','orderShipping','user')
                                ->where('id',$id)
                                ->first();

        return view('order.view', compact('intro','ulogovan','orderDATA'));
    }

    public function procesPayment(Request $request)
    {     

        $ulogovan = Auth::user();
        $sada = Carbon::now();

        //podaci o Orderu iz sesije
        //$orderTotal = json_decode(Session::get('orderTotal'));

        $merchantPaymentId = request('merchantPaymentId');
       
        $pgTranId = request('pgTranId');
        $pgTranRefId = request('pgTranRefId');
        $pgOrderId = request('pgOrderId');
        $pgTranApprCode = request('pgTranApprCode');
        $pgTranDate = request('pgTranDate');
        $customerId = request('customerId');
        $amount = request('amount');
        $sessionToken = request('sessionToken');
        $responseCode = request('responseCode');
        $responseMsg = request('responseMsg');


        //podaci o Orderu iz DB
        $retrieveOrdersLog = OrdersLog::where('orderID',$merchantPaymentId)->first()->toArray();
        $orderTotal = json_decode($retrieveOrdersLog['orderitems'],true);
        

        if(Auth::check()):

        else:
            $user = User::where('id',$orderTotal['orders']['customer_id'])->first();

            Auth::login($user, TRUE);
        endif;

        $orderTotal['transaction']['pgOrderId'] = $pgOrderId;
        $orderTotal['transaction']['pgTranApprCode'] = $pgTranApprCode;
        $orderTotal['transaction']['responseMsg'] = $responseMsg;
        $orderTotal['transaction']['responseCode'] = $responseCode;
        $orderTotal['transaction']['pgTranId'] = $pgTranId;
        $orderTotal['transaction']['pgTranDate'] = $pgTranDate;
        $orderTotal['transaction']['pgTranRefId'] = $pgTranRefId;

        $mailData = $orderTotal;

        if ($responseCode == '00' && $responseMsg == 'Approved'): //upis u DB

            $orderTotal = json_decode($retrieveOrdersLog['orderitems'],true);

        	$addToDB = Order::addOrderToDB($orderTotal,$merchantPaymentId,$pgTranId);

            //brisem podatke o Orderu iz sesije
            Session::forget('orderTotal');
            Session::forget('atc');

            //saljem notifikacije na mail
            $sendOrderInfo = Order::sendOrderInfoCustomer($mailData);
            $sendOrderInfoAdmin = Order::sendOrderInfoAdmin($mailData);
            
        	return redirect('/thank-you')->with(['mailData' => $mailData]);

        else: //redirect to error page

            //saljem notifikacije na mail
            $sendOrderErrorCustomer = Order::sendPaymentError($mailData);
            
        	return redirect('/payment-error')->with(['mailData' => $mailData]);

        endif;



    }
}