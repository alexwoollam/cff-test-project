<?php

namespace CFF\Utilities\Core;

class ThemeDefinitions
{
    public function Init(){

        $this->theme_path();
        $this->dev_mode();
        $this->theme_name();
        $this->theme_version();
    }

    /**
     * Define theme path.
     */
    public function theme_path(){
        define( 'THEME_PATH', dirname( __FILE__ ) );
    }

    /**
     * Define dev mode (controled via docker env).
     */
    public function dev_mode(){
        //define( 'DEV_MODE', !!getenv_docker( 'WORDPRESS_DEBUG', '' ) );
    }
    
    /**
     * Define theme name.
     */
    public function theme_name(){
        define( 'THEME_NAME', 'CFF' );
    }

    /**
     * Define theme version.
     */
    public function theme_version(){
        define( 'THEME_VERSION', '0.0.0a' );
    } 

}