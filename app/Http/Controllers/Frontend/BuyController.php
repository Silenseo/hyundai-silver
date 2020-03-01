<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\CitiesRegion;

use Crawler;

class BuyController extends Controller
{
	public function corporateClients() {
		// return view();
	}

	public function findDealer() {
    	if(Crawler::isCrawler())
        {
            return view('frontend.findDealer.seo', ['header' => true, 'highlight' => false, 'footer' => true]);
        }
        else
        {
            return view('frontend.findDealer.index', ['header' => true, 'highlight' => false, 'footer' => true]);
        }
    }

    public function contactUs() {
    	if(Crawler::isCrawler())
        {
            return view('frontend.contactUs.seo', ['header' => true, 'highlight' => false, 'footer' => true]);
        }
        else
        {
            return view('frontend.contactUs.index', ['header' => true, 'highlight' => false, 'footer' => true]);
        }
	}
	
    public function contactUsDealer() {
    	if(Crawler::isCrawler())
        {
            return view('frontend.contactUs.seo', ['header' => true, 'highlight' => false, 'footer' => true]);
        }
        else
        {
            return view('frontend.contactUs.index-dealer', ['header' => true, 'highlight' => false, 'footer' => true]);
        }
    }
}
