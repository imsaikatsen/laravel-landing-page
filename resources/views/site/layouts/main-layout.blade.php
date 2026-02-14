<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ isset($seo->title) ? hexEncode($seo->title) : hexEncode('APP') }}</title>
<meta name="title" content="{{ isset($seo->meta_title) ? hexEncode($seo->meta_title) : hexEncode('Default Meta Title') }}">
<meta name="keywords" content="{{ isset($seo->meta_keywords) ? hexEncode($seo->meta_keywords) : hexEncode('default, keywords') }}">
<meta name="description" content="{{ isset($seo->meta_description) ? hexEncode($seo->meta_description) : hexEncode('Default description') }}">
{!! $seo?->customScript ?? '' !!}


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
