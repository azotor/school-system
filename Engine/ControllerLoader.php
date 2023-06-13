<?php

    namespace Tk\Engine;

    use Tk\Engine\GlobalVar;
    use Tk\Config\App;

    class ControllerLoader {

        public function __construct() {
            
            $parser = GlobalVar::get( '_parser' );

            $className = App::CLASS_PREFIX . $parser -> getController();

            if( !class_exists( $className ) ) {
                
                $parser -> setDefaultController();
                $parser -> setDefaultAction();

                $className = App::CLASS_PREFIX . $parser -> getController();

            }

            new $className();

        }

    }

?>