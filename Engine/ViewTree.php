<?php

    namespace Tk\Engine;

    use Tk\Engine\GlobalVar;
    use Tk\Engine\ViewBranch;

    class ViewTree {

        public static function init() : void { GlobalVar::set( '_viewtree', new ViewBranch( 'root' ) ); }

        public static function appendFromFile( string $_filename, string $_parent = 'root' ) : void {

            ob_start();
            include $_filename;
            self::append( ob_get_clean(), $_parent );

        }

        public static function append( string $_content, string $_parent = 'root' ) : void {

            $map = [];

            $_content = preg_replace( '~[\r\n]+~', '', $_content );

            $indexFrom = 0;
            $indexTo = 0;

            while( $indexTo < strlen( $_content ) ) {

                $indexTo = strpos( $_content, '<', $indexTo );

                if( is_numeric( $indexTo ) ) {
                    
                    if( ctype_upper( $_content[ $indexTo + 1 ] ) ) {

                        $fragment = htmlspecialchars( trim( substr( $_content, $indexFrom, $indexTo - $indexFrom ) ) );
                        if( strlen( $fragment ) ) $map[] = '<font color="orange">html</font>:: ' . $fragment;
                        $indexFrom = $indexTo;

                        $indexTo = strpos( $_content, '>', $indexFrom );

                        if( is_numeric( $indexTo ) ) {
                            
                            $map[] = '<font color="green">begin</font>:: ' . htmlspecialchars( substr( $_content, $indexFrom, $indexTo - $indexFrom + 1 ) );
                            $indexFrom = $indexTo + 1;

                        } else break;

                    } else if( $_content[ $indexTo + 1 ] == '/' && ctype_upper( $_content[ $indexTo + 2 ] ) ) {

                        $fragment = htmlspecialchars( trim( substr( $_content, $indexFrom, $indexTo - $indexFrom ) ) );
                        if( strlen( $fragment ) ) $map[] = '<font color="orange">html</font>:: ' . $fragment;
                        $indexFrom = $indexTo;

                        $indexTo = strpos( $_content, '>', $indexFrom );

                        if( is_numeric( $indexTo ) ) {
                            
                            $map[] = '<font color="red">close</font>:: ' . htmlspecialchars( substr( $_content, $indexFrom, $indexTo - $indexFrom + 1 ) );
                            $indexFrom = $indexTo + 1;

                        } else break;
    
                    } else $indexTo++;

                } else break;

            }

            $map[] = '<font color="orange">html</font>:: ' . htmlspecialchars( substr( $_content, $indexFrom ) );

            echo '<pre>';
            print_r( $map );
            echo '</pre>';

        }

    }

?>