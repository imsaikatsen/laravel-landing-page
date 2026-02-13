<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\MiniApp;
use App\Models\DatingZone;
use App\Models\LiveZone;
use App\Models\MallProduct;
use App\Models\PageSeo;

class LandingPageController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $miniApps = MiniApp::latest()->get();
        $datingZones = DatingZone::latest()->get();
        $liveZones = LiveZone::latest()->get();
        $mallProducts = MallProduct::latest()->get();
        $seo = PageSeo::find(1);
        return view('site.pages.landing.index', compact('sliders','miniApps','datingZones',
            'liveZones', 'mallProducts','seo'));
    }
}
