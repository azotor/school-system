<?php

    namespace Tk\Controller;

    use Tk\Config\App;
    use Tk\Engine\GlobalVar;
    use Tk\Engine\Parser;
    use Tk\Engine\View;

    class FrontController {

        public Parser $parser;
        public View $view;

        public function __construct() {

            $this -> parser = GlobalVar::get( '_parser' );
            $this -> view = GlobalVar::get( '_view' );

            $actionName = $this -> parser -> getAction() . App::ACTION_SUFIX;

            if( !method_exists( $this, $actionName ) ) {

                $this -> parser -> setDefaultAction();

                $actionName = $this -> parser -> getAction() . App::ACTION_SUFIX;

            }

            $this -> { $actionName }();

        }

        public function indexAction() : void { echo '<h1>Default Action</h1>'; }

    }

?>