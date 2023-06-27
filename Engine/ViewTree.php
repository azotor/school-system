<?php

    namespace Tk\Engine;

    use Tk\Engine\GlobalVar;
    use Tk\Engine\Component;
    use Tk\Config\App;

    class ViewTree {

        public static function initGlobalTree( ) : void { self::init( 'global' ); }

        public static function init( string $_tree ) : void { GlobalVar::set( '_' . $_tree . 'Tree', new Component( [ 'name' => 'viewRoot' ] ) ); }

        public static function appendFromFile( string $_filename, string $_tree = 'global' ) : void {

            ob_start();
            include $_filename;
            self::append( ob_get_clean() );

        }

        public static function append( string $_content, string $_tree = 'global' ) : void {

            $map = [];

            $_content = preg_replace( '~[\r\n]+~', '', $_content );

            $indexFrom = 0;
            $indexTo = 0;

            while( $indexTo < strlen( $_content ) ) {

                $indexTo = strpos( $_content, '<', $indexTo );

                if( is_numeric( $indexTo ) ) {
                    
                    if( ctype_upper( $_content[ $indexTo + 1 ] ) ) {

                        $fragment = trim( substr( $_content, $indexFrom, $indexTo - $indexFrom ) );
                        if( strlen( $fragment ) ) $map[] = $fragment;
                        $indexFrom = $indexTo;

                        $indexTo = strpos( $_content, '>', $indexFrom );

                        if( is_numeric( $indexTo ) ) {
                            
                            $map[] = substr( $_content, $indexFrom, $indexTo - $indexFrom + 1 );
                            $indexFrom = $indexTo + 1;

                        } else break;

                    } else if( $_content[ $indexTo + 1 ] == '/' && ctype_upper( $_content[ $indexTo + 2 ] ) ) {

                        $fragment = trim( substr( $_content, $indexFrom, $indexTo - $indexFrom ) );
                        if( strlen( $fragment ) ) $map[] = $fragment;
                        $indexFrom = $indexTo;

                        $indexTo = strpos( $_content, '>', $indexFrom );

                        if( is_numeric( $indexTo ) ) {
                            
                            $map[] = substr( $_content, $indexFrom, $indexTo - $indexFrom + 1 );
                            $indexFrom = $indexTo + 1;

                        } else break;
    
                    } else $indexTo++;

                } else break;

            }

            $map[] = substr( $_content, $indexFrom );

            self::createBranches( $map, 0, GlobalVar::get( '_' . $_tree . 'Tree' ) );

        }

        public static function createBranches( array $_map, int $_id, Component $_parent ) : int {

            while( $_id < count( $_map ) ) {
                $pop = $_map[ $_id++ ];
                
                if( strlen( $pop ) == 0 ) continue;

                if( self::isComponentAutoClose( $pop ) ) {

                    $componentClassName = APP::COMPONENT_CLASS_PREFIX . self::getComponentName( $pop );
                    echo '<hr>'.$componentClassName.'<hr>';
                    $component = new $componentClassName( $pop );
                    $_parent -> addChild( $component );

                } else if( self::isComponentOpen( $pop ) ) {

                    $componentClassName = APP::COMPONENT_CLASS_PREFIX . self::getComponentName( $pop );
                    $component = new $componentClassName( $pop );
                    $_parent -> addChild( $component );
                    $_id = self::createBranches( $_map, $_id, $component );
                    
                } else if( self::isComponentClose( $pop ) && $_parent -> hasParent() ) return $_id++;
                else $_parent -> addChild( new Component( [ 'name' => 'html', 'child' => $pop ] ) );
                
            }

            return $_id;

        }

        public static function isComponentOpen( string $_input ) : bool { return $_input[ 0 ] == '<' && ctype_upper( $_input[ 1 ] ); }

        public static function isComponentClose( string $_input ) : bool { return $_input[ 0 ] == '<' && $_input[ 1 ] == '/' && ctype_upper( $_input[ 2 ] ); }

        public static function isComponentAutoClose( string $_input ) : bool { return self::isComponentOpen( $_input ) && $_input[ strlen( $_input ) - 2 ] == '/'; }

        public static function getComponentName( string $_input ) : string {
            $_input = explode( ' ', trim( $_input, '<>/' ) );
            return array_shift( $_input );
        }

        public static function render( string $_tree = 'global' ) : string {
            $viewTree = GlobalVar::get( '_' . $_tree . 'Tree' );
            return $viewTree -> generate();
        }

        public static function remove( string $_tree = 'global' ) : void { GlobalVar::remove( '_' . $_tree . 'Tree' ); }

    }

?>