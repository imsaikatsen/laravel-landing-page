<?php

namespace App\Http\Controllers;

use App\Models\MiniApp;
use App\Models\DatingZone;
use App\Models\LiveZone;
use App\Models\MallProduct;

class SlugController extends Controller
{
    public function resolveWithCategory($categorySlug, $slug)
    {
        $miniApp = MiniApp::with('category')->where('slug', $slug)->first();
        if ($miniApp && $miniApp->category_active && ($miniApp->category?->slug ?? null) === $categorySlug) {
            return app(MiniAppController::class)->show($slug);
        }

        $datingZone = DatingZone::with('category')->where('slug', $slug)->first();
        if ($datingZone && $datingZone->category_active && ($datingZone->category?->slug ?? null) === $categorySlug) {
            return app(DatingZoneController::class)->show($slug);
        }

        $liveZone = LiveZone::with('category')->where('slug', $slug)->first();
        if ($liveZone && $liveZone->category_active && ($liveZone->category?->slug ?? null) === $categorySlug) {
            return app(LiveZoneController::class)->show($slug);
        }

        $mallProduct = MallProduct::with('category')->where('slug', $slug)->first();
        if ($mallProduct && $mallProduct->category_active && ($mallProduct->category?->slug ?? null) === $categorySlug) {
            return app(MallProductController::class)->show($slug);
        }

        abort(404);
    }

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
