<?php

    namespace Tk\Engine;

    use Tk\Config\Path;
    use Tk\Engine\Props;
    use Tk\Engine\ViewTree;

    class Component {

        protected Props $props;
        protected string $name;
        protected string $id;
        protected Component $parent;
        protected array $children = [];

        public function __construct( array | string $_data ) {

            $this -> id = md5( microtime() );
            $this -> props = new Props();

            if( gettype( $_data ) == 'string' ) $this -> validate( $_data );
            else {
                $this -> name = $_data[ 'name' ];
                if( array_key_exists( 'props', $_data ) ) $this -> props -> read( $_data[ 'props' ] );
                if( array_key_exists( 'child', $_data ) ) $this -> children[] = $_data[ 'child' ];
            }

        }

        public function validate( string $_data ) : void {

            $_data = explode( ' ', trim( $_data, '<>/' ) );
            $propsArray = [];

            $this -> name = array_shift( $_data );

            foreach( $_data as $prop ) {

                if( empty( $prop ) ) continue;

                $ex = explode( '=', trim( $prop ) );
                $propsArray[] = [ $ex[ 0 ], trim( $ex[ 1 ], '"\'' ) ];

            }

            if( count( $propsArray ) ) $this -> props -> read( $propsArray );

        }

        public function getName() : string { return $this -> name; }

        public function addChild( Component $_component ) : void {

            $_component -> setParent( $this );
            $this -> children[] = $_component;

        }

        public function setParent( Component $_parent ) : void { $this -> parent = $_parent; }

        public function hasParent() : bool { return !empty( $this -> parent ); }

        public function render() : string { return $this -> props -> child; }

        public function generate() : string {

            $out = '';

            if( $this -> name == 'html' )
                $out .= $this -> children[ 0 ];
            else {
                $this -> props -> child = '';
                if( count( $this -> children ) )
                    foreach( $this -> children as $child )
                        $this -> props -> child .= $child -> generate();
                $out .= $this -> render();
            }
            return $out;

        }

        public static function isExists( string $_componentName ) : bool { return file_exists( Path::COMPONENT . $_componentName . '.php' ); }
        
    }

?>