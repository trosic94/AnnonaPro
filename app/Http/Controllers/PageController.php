<?php

namespace App\Http\Controllers;

use TCG\Voyager\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
 	public function page($pageSlug)
    {
   	
    	$page = Page::where('slug',$pageSlug)->first();

        if ($page):
            $metaTitle = $page->title;
            $metaDescription = $page->meta_description;
            $metaKeywords = $page->meta_keywords;

            return view('page.static', compact('page','metaTitle','metaDescription','metaKeywords'));
        else:
            return abort(404);
        endif;

    }

	public function contactForm(Request $request)
    {

    	$this->validateContact($request);

    	$contact = array();

    	$mailData['ime'] = request('ime');
    	$mailData['email'] = request('email');
    	$mailData['poruka'] = request('poruka');
    	$mailData['tst'] = request('hpASSdDGT3e5345345');

    	if ($mailData['tst'] == null):

            Mail::send('emails.contact', $mailData, function($message) use ($mailData)
            {
                $message->to('nenad.stankov@gomex.rs','AnnonaPro')
                        ->from('noreply@annonapro.rs', 'AnnonaPro')
                        //->cc('petar.medarevic@onestopmarketing.rs', 'OSM')
                        // ->bcc('webmaster@onestpmarketing.rs', 'OSM')
                        ->sender($mailData['email'], $mailData['ime'])
                        ->replyTo($mailData['email'], $mailData['ime'])
                        ->subject('Kontakt sa sajta - '. $mailData['ime']);
            });

    	endif;

        return  redirect()->back()->with('mailSent', 'Vaša poruka je poslata. Hvala.');

    }

	public function validateContact($request)
    {
    	return $this->validate($request, [
    		'ime' => 'required',
    		'email' => 'required|email',
    		'poruka' => 'required'
    	]);
    }
}
