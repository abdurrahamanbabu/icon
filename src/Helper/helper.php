<?php 

if (!function_exists('iconAssets')) {
    function iconAssets()
    {
        return view('icon::icon');
    }
}

if (!function_exists('iconInput')) {
    function iconInput($icon = null)
    {
        return view('icon::input', compact('icon'));
    }
} 