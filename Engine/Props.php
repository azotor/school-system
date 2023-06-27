<?php

    namespace Tk\Engine;

    class Props {

        private array $properties = [];

        public function __get( string $_name ) : mixed { return $this -> properties[ $_name ]; }

        public function __set( string $_name, mixed $_value ) : void { $this -> properties[ $_name ] = $_value; }

        public function read( array $_props ) : void {

            foreach( $_props as $prop  )
                $this -> { $prop[ 0 ] } = $prop[ 1 ];
                
        }

    }

?>