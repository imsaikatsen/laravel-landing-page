<!DOCTYPE html>
<html lang="zh-CN">
<head>
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@if(isset($seo) && $seo != null)
    <title>吴梦梦电视剧在线观看</title>
    <meta name="title" content="{{ $seo?->meta_title ?? 'Default Title' }}">
    <meta name="keywords" content="{{ $seo?->meta_keywords ?? 'default, keywords' }}">
    <meta name="description" content="{{ $seo?->meta_description ?? 'Default description' }}">
    {!! $seo->customScript !!}
@endif

@if(isset($item) && $item != null)
    <title>吴梦梦电视剧在线观看 | {{ ($item?->metaTitle) }}</title>
    <meta name="title" content="吴梦梦电视剧在线观看 | {{ ($item?->metaTitle) }} ">
    <meta name="keywords" content="{{ $item?->metaKeywords ?? 'default, keywords' }}">
    <meta name="description" content="{{ $item?->metaDescription ?? 'Default description' }}">
@endif 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
body{
    background:#000;
    margin:0;
}
</style>
</head>
<body>

@yield('page')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
