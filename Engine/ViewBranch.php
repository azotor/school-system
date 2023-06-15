<?php

    namespace Tk\Engine;

    class ViewBranch {

        protected string $name;
        protected string $content; // potem dodać Component
        protected array $branches;

        public function __constrictor( string $_name, string $_content ) {

            $this -> name = $_name;
            $this -> content = $_content;

        }

        public function getName() : string { return $this -> name; }

        public function addBranch( string $_branch ) : void {

            $name = ( gettype( $_branch ) === 'string' ) ? 'html' : 'obj';

            $this -> branches[] = new ViewBranch( $name, $_branch );

        }

    }

?>