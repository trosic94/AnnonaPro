<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Banner;
use App\Category;
use App\Post;
use App\Page;

class KontaktController extends Controller
{
    public function index()
	{
        $title = 'Kontakt';
        $metaTitle = 'Kontakt';
		$slug = array(
            '0' => array(
                'slug' => '/',
                'title' => trans('shop.title_home'),
                'active' => '',
            ),
            '1' => array(
                'slug' => trans('shop.slug_url_kontakt'),
                'title' => trans('shop.slug_title_kontakt'),
                'active' => 'active',
            )
        );
        
        // podaci za PAGE - Kontakt
        $pageDATA = Page::getPageBySlug('kontakt');
    
        
    	return view('kontakt.kontakt',compact('title','slug','metaTitle','pageDATA'));
    }
    public function contactForm(Request $request)
    {

    	$this->validateContact($request);

    	$contact = array();

        $mailData['ime'] = request('ime');
        $mailData['prezime'] = request('prezime');
        $mailData['email'] = request('email');
        $mailData['telefon'] = request('telefon');
    	$mailData['poruka'] = request('poruka');
    	$mailData['tst'] = request('hpASSdDGT3e5345345');

    	if ($mailData['tst'] == null):

            Mail::send('emails.contact', $mailData, function($message) use ($mailData)
            {
                $message->to(setting('shop.shop_notification_email'),'AnnonaPro')
                        ->from($mailData['email'], 'AnnonaPro')
                        //->cc('petar.medarevic@onestopmarketing.rs', 'OSM')
                        // ->bcc('webmaster@onestpmarketing.rs', 'OSM')
                        ->sender($mailData['email'], $mailData['ime'])
                        ->replyTo($mailData['email'], $mailData['ime'])
                        ->subject('Kontakt sa sajta - '. $mailData['ime'].' '.$mailData['prezime']);
            });

    	endif;

        return  redirect()->back()->with('mailSent', 'Vaša poruka je poslata. Hvala.');

    }

	public function validateContact($request)
    {
    	return $this->validate($request, [
            'ime' => 'required',
            'prezime' => 'required',
    		'email' => 'required|email',
    		'poruka' => 'required'
    	]);
    }

}
