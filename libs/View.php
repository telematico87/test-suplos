<?php
class View
{
    function __construct()
    {
    }
    
      /**
         *Redirecciona a la vista
        * @param: $name  nuestra plantillan,$var=contenedor de nuestras variables
        * @return  response
        */
    public function show($name, $vars = array())
    {
        //Traemos una instancia de nuestra clase de configuracion.
        $config = Config::singleton();
 
        //Armamos la ruta a la plantilla
        $path = $config->get('viewsFolder') . $name;
 
        //Si no existe el fichero en cuestion, mostramos un 404
        if (file_exists($path) == false)
        {
            trigger_error ('Template `' . $path . '` does not exist.', E_USER_NOTICE);
            return false;
        }
   
        //Si hay variables para asignar, las pasamos una a una.
        if(is_array($vars))
        {
                    foreach ($vars as $key => $value)
                    {
                    $key = $value;
                    }
                }
   
        //Finalmente, incluimos la plantilla.
        include($path);
    }
}

?>