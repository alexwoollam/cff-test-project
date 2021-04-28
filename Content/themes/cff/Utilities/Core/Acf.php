<?php
/**
 * ACF - General Settings
 * 
 */

namespace CFF\Utilities\Core;

class Acf{

    public function __construct(){

        if( ! class_exists('ACF')  )
        {
            add_action( 'admin_notices', function(){
                ?>
                <div class="notice notice-error is-dismissible">
                    <p><?php _e( 'ACF NOT FOUND! - check composer is updated and installed on this server.', 'cff' ); ?></p>
                </div>
                <?php
            } );
            return;
        }
                
        
    }

    public function set_save_location(){
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
