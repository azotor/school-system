<?php

    namespace Tk\Engine;

    use Tk\Config\Path;
    use Tk\Enum\ViewsType;
    use Tk\Engine\ViewTree;
    use Tk\Engine\GlobalVar;

    class View {

        protected ViewsType $viewType = ViewsType::DEFAULT;
        protected bool $render = true;

        public function __construct() {

            ViewTree::init();

            GlobalVar::set( '_styles', [] );
            GlobalVar::set( '_scripts', [] );
            
        }

        public function __destruct() {

            if( !$this -> render ) return;

            ViewTree::appendFromFile( $this -> getPath( 'test' ) );

            //require_once $this -> getPath( 'index' );
            
        }

        public function getPath( string $_name, ViewsType $_viewtype = null ) : string {

            if( !$_viewtype ) $_viewtype = $this -> viewType;

            return Path::VIEW . $_viewtype -> value . '/' . $_name . '.php';

        }

        public function setViewType( ViewsType $_type ) : void { $this -> viewType = $_type; }

        public function getViewType() : ViewsType { return $this -> viewType; }

        public function addStyle( array $_style, ViewsType $_viewtype = null ) : void {

            if( !$_viewtype ) $_viewtype = $this -> viewType;

        }

    }

?>