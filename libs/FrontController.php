<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
class FrontController
{
    static function main()
    {
        //Incluimos algunas clases:
 
        require 'libs/Config.php'; //de configuracion
        require 'libs/SPDO.php'; //PDO con singleton
        require 'libs/View.php'; //Mini motor de plantillas
        require 'config.php'; //Archivo con configuraciones.
        
 
        //Lo mismo sucede con las acciones, si no hay acción, tomamos index como acción
        if(! empty($_SERVER['REQUEST_URI'])){
              $url = $_SERVER['REQUEST_URI'];
              $arr_url=explode('/', $url);
             
              $controllerName = $arr_url[2]. 'Controller';
              
              if(strpos($arr_url[3], "?") !== false){ // parametros
                $arr_url_action=explode('?', $arr_url[3]);
                $actionName=$arr_url_action[0];
               }else{
                $actionName=$arr_url[3];
               }
            }
            
        else{
              $actionName = "dasboard";
              $controllerName = 'gestionController';
            }
        $controllerPath = $config->get('controllersFolder') . $controllerName . '.php';
        
   
        
        //Incluimos el fichero que contiene nuestra clase controladora solicitada
        if(is_file($controllerPath))
              require $controllerPath;
        else
              die('El controlador no existe - 404 not found');
              
              $controller = new $controllerName;
              $controller->$actionName();
          

   

       
     
    }
}
?>