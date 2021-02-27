<?php

class Routing {

    public static function buildRoute() {


        /* Контроллер и action по умолчанию */
        $controllerName = "IndexController";
        $modelName = "IndexModel";
        $action = "index";
        
        
/*        $routes = explode('/', $_SERVER['REQUEST_URI']);
        print_r($_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}
        
        
     //   $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                $route = explode('/', $_SERVER['REQUEST_URI']);
        $i = count($route)-0;
        
             //   print_r($_SERVER['REQUEST_URI']);
        print_r($i);
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
                        $controllerName = ucfirst($controller_name) . "Controller";
                        $modelName =  ucfirst($controller_name) . "Model";
                        print_r($controller_name);
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action = $routes[2];
                        print_r($action);
		}

*/
        $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $i = count($route)-1;
     //  print_r($i);
    //   print_r($_SESSION['user']);
     //  print_r($route);
        while($i>0) {
            if($_SESSION['user']) {
            if($route[1] != 'admin') {
                header('Location: /admin');
            } }else {break;}
            if($route[$i] != '') {
                if(is_file(CONTROLLER_PATH . ucfirst($route[$i]) . "Controller.php")) {
                    $controllerName = ucfirst($route[$i]) . "Controller";
                    $modelName =  ucfirst($route[$i]) . "Model";
                 //   echo ucfirst($route[$i]);
                    break;
                } else {
                    $action = $route[$i];
               //    echo $action;
                }
            }
                $i--;
            }
           
            require_once CONTROLLER_PATH . $controllerName . ".php";
            require_once MODEL_PATH . $modelName . ".php";
            
            $controller = new $controllerName();
            
            if(method_exists($controller, $action)) {
                $controller->$action();
            } else {
                self::errorPage();
            }
    }

    public static function errorPage() {
        header("Location: /404.php");
    }

}
