<?php

    namespace Tk\Controller;

    class Test extends FrontController {

        public function indexAction() : void {
            echo 'IND test';
        }

        public function testAction() : void {
            echo 'Test action test ';
        }

        public function prostaAction() : void {
            echo 'prosta action test ';
        }

    }

?>