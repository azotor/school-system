<?php

    namespace Tk\Engine;

    use Tk\Config\Path;
    use Tk\Config\App;

    class Parser {

        protected string $controller = App::DEFAULT_CONTROLLER;
        protected string $action = App::DEFAULT_ACTION;
        protected array $params = [];
        protected array $queries = [];

        public function __construct() {

            $uri = explode( '?', trim( substr( $_SERVER[ 'REQUEST_URI' ], strlen( Path::SUB_DIR ) ) ) );
            
            $uri = array_filter($uri, 'strlen');

            if( count( $uri ) > 0 )
                foreach( explode( '/', $uri[ 0 ] ) as $param )
                    $this -> setParam( $param );

            if( count( $uri ) > 1 )
                foreach( explode( '&', $uri[ 1 ] ) as $query ) {
                    $query = explode( '=', $query );
                    $this -> setQuery( $query[ 0 ], $query[ 1 ] );
                }

            if( $this -> countParams() > 0 ) $this -> setController( $this -> getParam( 0 ) );

            if( $this -> countParams() > 1 ) $this -> setAction( $this -> getParam( 1 ) );

        }

        public function setParam( string $_value ) : void { $this -> params[] = $_value; }

        public function getParam( int $_id ) : string { return $this -> existsParam( $_id ) ? $this -> params[ $_id ] : ''; }

        public function existsParam( int $_id ) : bool { return array_key_exists( $_id, $this -> params ); }

        public function countParams() : int { return count( $this -> params ); }

        public function setQuery( string $_key, string $_value ) : void { $this -> queries[ $_key ] = $_value; }

        public function getQuery( string $_key ) : string { return $this -> queries[ $_key ]; }

        public function existsQuereKey( string $_key) : bool { return array_key_exists( $_key, $this -> queries ); }

        public function countQueries() : int { return count( $this -> queries ); }

        public function setController( string $_controller ) : void { $this -> controller = $_controller; }

        public function getController() : string { return $this -> controller; }

        public function setAction( string $_action ) : void { $this -> action = $_action; }

        public function getAction() : string { return $this -> action; }

        public function setDefaultController() : void { $this -> controller = App::DEFAULT_CONTROLLER; }

        public function setDefaultAction() : void { $this -> action = App::DEFAULT_ACTION; }

    }

?>