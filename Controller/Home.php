<?php

    namespace Tk\Controller;

    class Home extends FrontController {

        public function indexAction() : void {
            echo 'IND';
        }

        public function testAction() : void {
            echo 'Test action';
        }

        public function prostaAction() : void {
            echo 'prosta action';
        }

    }

?>