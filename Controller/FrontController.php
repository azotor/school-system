<?php

    namespace Tk\Controller;

    use Tk\Config\App;
    use Tk\Engine\GlobalVar;

    class FrontController {

        public function __construct() {

            $parser = GlobalVar::get( '_parser' );
            $view = GlobalVar::get( '_view' );

            $actionName = $parser -> getAction() . App::ACTION_SUFIX;

            if( !method_exists( $this, $actionName ) ) {

                $parser -> setDefaultAction();

                $actionName = $parser -> getAction() . App::ACTION_SUFIX;

            }

            $this -> { $actionName }();

        }

        public function indexAction() : void { echo '<h1>Default Action</h1>'; }

    }

?>