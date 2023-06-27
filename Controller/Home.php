<?php

    namespace Tk\Controller;

use Tk\Engine\Component;
use Tk\Engine\ViewTree;

    class Home extends FrontController {

        public function indexAction() : void {

            if( $this -> parser -> existsParam( 0 ) && Component::isExists( $this -> parser -> getParam ( 0 ) ) )
                ViewTree::append( '<' . $this -> parser -> getParam ( 0 ) . ' />' );
            else
                ViewTree::append( '<Home />' );

        }

    }

?>