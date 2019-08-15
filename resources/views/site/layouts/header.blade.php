<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="@if (isset($meta['title'])) {{ $meta['title'] }} @endif" />
    <meta content="@if (isset($meta['description'])) {{ $meta['description'] }} @endif" name="description">
    <meta content="@if (isset($meta['keywords'])) {{ $meta['keywords'] }} @endif" name="keywords">
    <meta http-equiv="Last-Modified" content="{{ !empty($lastModified)?$lastModified:'Fri, 11 Sep 2015 11:20:27' }}">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="
        @if (!empty($Category_meta))
    {{{$Category_meta['title']}}}
        @elseif (!empty($meta_title)) {{ $meta_title }}
    @else @yield('title')
    @endif
        ">
    <meta itemprop="description" content="{{ !empty($Category_meta)?$Category_meta['description']:(!empty($meta_description) ? $meta_description : '') }}">
    <meta itemprop="image" content="{{  !empty($meta_image) ? $meta_image : ''  }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="{{ !empty($meta_url) ? $meta_url : '' }}">
    <meta name="twitter:title" content="@if (!empty($Category_meta))
    {{ $Category_meta['title'] }}
    @elseif (!empty($meta_title)) {{ $meta_title }}
    @else @yield('title')
    @endif
        ">
    <meta name="twitter:description" content="{{ !empty($Category_meta)?$Category_meta['description']:(!empty($meta_description) ? $meta_description : '') }}">
    <meta name="twitter:creator" content="{{ !empty($meta_creator) ? $meta_creator : '' }}">
    <meta name="twitter:image" content="{{ !empty($meta_image) ? $meta_image : '' }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="@if (!empty($Category_meta))
    {{ $Category_meta['title'] }}
    @elseif (!empty($meta_title)) {{ $meta_title }}
    @else @yield('title')
    @endif
        " />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ !empty($meta_url) ? $meta_url : '' }}" />
    <meta property="og:image" content="{{ !empty($meta_image) ? $meta_image : '' }}" />
    <meta property="og:description" content="{{ !empty($Category_meta)?$Category_meta['description']:(!empty($meta_description) ? $meta_description : '') }}" />

    <link rel="image_src" href="{{ !empty($meta_image) ? $meta_image : '' }}" />

    <link rel="icon" type="image/x-icon" href="/images/site/logoF.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#e30079">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>@if (isset($meta['title'])) {{ $meta['title'] }} @endif</title>

    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="{{ asset('/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('/js/respond.min.js') }}"></script>
    <![endif]-->

    <link href="/css/admin_site.css" rel="stylesheet" type="text/css" />

{{--    @yield('header')--}}
</head>

<body>