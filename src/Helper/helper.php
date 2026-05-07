<?php 

if (!function_exists('iconAssets')) {
    function iconAssets()
    {
        return view('icon::icon');
    }
}

if (!function_exists('iconInput')) {
    function iconInput()
    {
        return view('icon::input');
    }
} 