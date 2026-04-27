<?php 

if (!function_exists('iconAssets')) {
    function iconAssets()
    {
        return view('Icon::icon');
    }
}

if (!function_exists('iconInput')) {
    function iconInput()
    {
        return view('Icon::input');
    }
} 