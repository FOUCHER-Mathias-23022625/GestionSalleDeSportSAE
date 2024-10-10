
    <?php
        require_once 'modules/blog/controllers/utilisateurs.php';

        class index{
            public function url(){
                $url = '';
                if(isset($_SERVER['REQUEST_URI'])){
                    $url = explode('/', $_SERVER['REQUEST_URI']);
                    var_dump($url);
                    return $url;
                 }
                else{
                    return 'erreur';
                }
            }
            public function routeur($url){
                $controller = new $url[0].'Controller';
                return $controller.'->'.$url[1].'()';
            }

        }