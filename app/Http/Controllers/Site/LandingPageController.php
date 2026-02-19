<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\MiniApp;
use App\Models\DatingZone;
use App\Models\LiveZone;
use App\Models\MallProduct;
use App\Models\PageSeo;
use App\Services\SitemapGenerator;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function __construct(private SitemapGenerator $sitemapGen) {}
    public function index()
    {
        $seo = PageSeo::first();
        // if (Carbon::parse($seo?->last_map)->format('Y-m-d') != Carbon::now()->format('Y-m-d')) {
        //     $this->sitemapGen->generate();
        //     if ($seo != null) {
        //         $seo->last_map = Carbon::now()->format('Y-m-d');
        //         $seo->save();
        //     }
        // }
        $sliders = Slider::latest()->get();
        $miniApps = MiniApp::latest()->get();
        $datingZones = DatingZone::latest()->get();
        $liveZones = LiveZone::latest()->get();
        $mallProducts = MallProduct::latest()->get();
        return view('site.pages.landing.index', compact('sliders', 'miniApps', 'datingZones', 'liveZones', 'mallProducts'));
    }
}
