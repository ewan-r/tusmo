<?php
require_once ('/var/www/html/projet_web/app/Model.php');
require_once ('/var/www/html/projet_web/app/Controller.php');
// define('ROOT', 'var/www/html/projet_web/');
// echo ROOT;


$params = explode('/', $_GET['p']);
//var_dump($_GET['p']);die();

if ($params[0] != ""){
    $controller = ucfirst($params[0]);
    $action = (isset($params[1])) ? $params[1] : 'index'; 
    require_once ('controllers/' . $controller . '.php');
    $controller = new $controller();
    if (method_exists($controller, $action)){
        unset($params[0]);
        unset($params[1]); 
        call_user_func_array([$controller, $action], $params);
    }else{
        http_response_code(404);
        echo "La page demandée n'existe pas";
    }
    // echo "<h1>controller 
    // = $controller</h1>";
    // $action = (isset($params[1])) ? $params[1] : 'index';
    // echo "<h1>action = $action</h1>";
} else{
    echo'failed';
    
}
?>