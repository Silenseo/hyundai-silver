<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Crawler;

class SpaConfiguratorController extends Controller
{
    public function index()
    {
        if(Crawler::isCrawler())
        {
            return view('configurator_seo', ['header' => true, 'headerFixed' => true, 'highlight' => false, 'footer' => true]);
        }
        else
        {
            return view('configurator', ['header' => true, 'headerFixed' => true, 'highlight' => false, 'footer' => true]);
        }

	}
	
    public function configuratorDealer()
    {
        if(Crawler::isCrawler())
        {
            return view('configurator_seo', ['header' => true, 'headerFixed' => true, 'highlight' => false, 'footer' => true]);
        }
        else
        {
            return view('configurator-dealer', ['header' => true, 'headerFixed' => true, 'highlight' => false, 'footer' => true]);
        }

    }
}
