<?php

    namespace Tk\Controller;

    use Tk\Engine\Redirect;
    use Tk\Engine\ViewTree;

    class Home extends FrontController {

        public function indexAction() : void {

            if( false ) { // tutaj trzeba dodać sprawdzenie czy jest admin czy nie
                ViewTree::append( '<Klocek />' );
            } else {

                new Redirect( 'home' );

            }

        }

    }

?>