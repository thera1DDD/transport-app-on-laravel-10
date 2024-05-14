<?php

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

if (!function_exists('getImage')) {

    function getImage($filename)
    {
        if (!empty($filename)) {
            $trimmedPath = Str::replaceFirst(Env::get('APP_URL'),'',$filename);
            return  $trimmedPath;
        }
        return $filename;
    }
    function getUrl(){
        $appUrl = Config::get('app.url') . '/img/profile.png';
        return $appUrl;
    }
}
