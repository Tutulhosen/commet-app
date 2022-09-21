<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * show home page
     */
    public function index()
    {
        $slider_data= Slider:: where('status', true)->latest()->get();
        return view('frontend.pages.home', compact('slider_data'));
    }

    /**
     * show contact page
     */

     public function contactPageShow()
     {
       return view('frontend.pages.contact.index');
     }


     /**
      * show single portfolio page
      */

      public function portfolioSinglePage($slug)
      {
        $single_data= Portfolio::where('slug', $slug)->first();
        return view('frontend.pages.single_page.index', compact('single_data'));
      }




}
