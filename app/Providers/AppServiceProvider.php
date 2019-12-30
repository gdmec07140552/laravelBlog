<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //头部公共信息传值
        view()->composer('admin.common.header', function ($view) {
            //获取配置文件信息
            $conf = Config::get('websiteConf');
            $view->with('website',$conf);
        });
        //首页公共信息传值
        view()->composer('admin.index.index', function ($view) {
            //获取配置文件信息
            $conf = Config::get('websiteConf');
            $view->with('website',$conf);
        });
        //首页欢迎页面公共信息传值
        view()->composer('admin.index.welcome', function ($view) {
            //获取配置文件信息
            $conf = Config::get('websiteConf');
            $view->with('website',$conf);
        });
        //页脚公共信息传值
        view()->composer('admin.common.footer', function ($view) {
            //获取配置文件信息
            $conf = Config::get('websiteConf');
            $view->with('website',$conf);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
