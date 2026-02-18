@extends('site.layouts.main-layout', ["tabTitle" => config('i.service_name')])

@section('page')

@push('meta')
    <title>吴梦梦电视剧在线观看</title>
    <meta name="title" content="{{ isset($seo->meta_title) ? $seo->meta_title : 'Default Meta Title' }}">
    <meta name="keywords" content="{{ isset($seo->meta_keywords) ? $seo->meta_keywords : 'default, keywords' }}">
    <meta name="description" content="{{ isset($seo->meta_description) ? $seo->meta_description : 'Default description' }}">
@endpush

<style>
    .main-canvas { min-height: 100vh; display: flex; justify-content: center; }
    .mobile-wrapper { width: 100%; max-width: 450px; min-height: 100vh; position: relative; }
    .section-title { font-size: 1.1rem; font-weight: bold; color: #fff; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .section-title span { font-size: 0.8rem; color: #666; text-transform: uppercase; }
</style>

<div class="main-canvas">
    <div class="mobile-wrapper">
        @include('site.pages.landing._fragments.header')
        @include('site.pages.landing._fragments.slider')
        @include('site.pages.landing._fragments.mini_app')
        @include('site.pages.landing._fragments.dating_zone')
        @include('site.pages.landing._fragments.active_zone')
        @include('site.pages.landing._fragments.mall')
    </div>
</div>
@endsection