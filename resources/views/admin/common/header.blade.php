<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{isset($website['admin_title'])?$website['admin_title']:''}}</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="{{isset($website['admin_logo'])?$website['admin_logo']:''}}" type="image/x-icon" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <!-- css样式文件引入 -->
        @include('admin.common.css')
        <!-- js文件引入 -->
        @include('admin.common.javascript')
    </head>
    <body>
@yield('content')