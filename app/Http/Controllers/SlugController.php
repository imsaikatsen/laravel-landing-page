<?php

namespace App\Http\Controllers;

use App\Models\MiniApp;
use App\Models\DatingZone;
use App\Models\LiveZone;
use App\Models\MallProduct;

class SlugController extends Controller
{
    public function resolve($slug)
    {
        // Mini App
        if (MiniApp::where('slug', $slug)->exists()) {
            return app(MiniAppController::class)->show($slug);
        }

        // Dating Zone
        if (DatingZone::where('slug', $slug)->exists()) {
            return app(DatingZoneController::class)->show($slug);
        }

        // Live Zone
        if (LiveZone::where('slug', $slug)->exists()) {
            return app(LiveZoneController::class)->show($slug);
        }

        // Mall Product
        if (MallProduct::where('slug', $slug)->exists()) {
            return app(MallProductController::class)->show($slug);
        }

        abort(404);
    }
}
