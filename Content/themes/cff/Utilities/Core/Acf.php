<?php
/**
 * ACF - General Settings
 * 
 */

namespace CFF\Utilities\Core;

class Acf{

    public function __construct(){
                
        add_filter('acf/settings/save_json', function($path){
            $path = THEME_CORE . '/acf/json';
            return $path;
        });

        add_filter('acf/settings/load_json', function($paths){
            unset($paths[0]);
            $paths[] = THEME_CORE . '/acf/json';
            return $paths;
        }); 
    }
}
