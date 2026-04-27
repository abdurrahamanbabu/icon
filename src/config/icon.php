<?php

/**
 * Icon Package Configuration
 * 
 * Customize the appearance of the icon picker component.
 */

return [
    
    /**
     * Icon Showcase Container Colors
     */
    'showcase' => [
        /**
         * Background color of the main icon showcase container
         * Format: HEX, RGB, RGBA, or CSS color names
         * Default: #e3e3e2
         */
        'background_color' => '#e3e3e2',
    ],

    /**
     * Icon Item Colors (Individual icons inside showcase)
     */
    'icon_item' => [
        /**
         * Background color of individual icon items
         * Format: HEX, RGB, RGBA, or CSS color names
         * Default: #e6e8ea
         */
        'background_color' => '#e6e8ea',

        /**
         * Font/Text color of individual icon items
         * Format: HEX, RGB, RGBA, or CSS color names
         * Default: #3c3737e0
         */
        'font_color' => '#3c3737e0',
    ],

    /**
     * Additional Customization Options
     */
    'border' => [
        /**
         * Border color of individual icon items
         * Format: HEX, RGB, RGBA, or CSS color names
         * Default: #f1f1f1
         */
        'color' => '#f1f1f1',
    ],

    'shadow' => [
        /**
         * Box shadow color of the showcase container
         * Format: RGBA with transparency
         * Default: #01010170 (black with 70% opacity)
         */
        'color' => '#01010170',
    ],
];
