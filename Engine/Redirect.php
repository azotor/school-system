<?php

    namespace Tk\Engine;

    use Tk\Config\Path;

    class Redirect {

        public function __construct( string $_location = 'home', int $_delay = 0 ) {
            
            header( 'refresh:' . $_delay . '; url=' . Path::SERVER . $_location );
            die();

        }

    }

?>