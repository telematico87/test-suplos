<?php

require 'models/gestionModel.php';

class gestionController
{
    private $view;
    private $gestionModel;

    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
        $this->gestionModel = new gestionModel();
    }


    //Login
    public function login(){
        $this->view->show("login.php");
    }

    /**
  * Logearse
  * @param 
  * @return  response
  */
    public function loginProceso(){

        $_POST = json_decode(file_get_contents("php://input"), true);
        $correo = isset($_POST['correo']) && (trim($_POST['correo']) != '')?$_POST['correo']:'';
        $password = isset($_POST['password']) && (trim($_POST['password']) != '')?$_POST['password']:'';
        
        $password=md5($_POST["password"]);

        $login=$this->gestionModel->login($correo,$password)->fetch();
        
        if($login['num']>0){
            $response = ['type' => "success", 'data'=>'','message' => "Credenciales correctas !"];
        }else{
            $response = ['type' => "Error", 'data'=>'','message' => "Error en las Credenciales !"];
        }
        echo json_encode($response);

    }   



       /**
  * dasboard
  * @param 
  * @return  view
  */
    public function dashboard(){
            //Finalmente presentamos nuestra plantilla
            $this->view->show("listar_opciones.php");
    }

     /**
         * Cambiar estado a evaluar
        * @param 
        * @return  view
        */
    public function evaluarProceso(){
        

        $_POST = json_decode(file_get_contents("php://input"), true);
        
        $id = isset($_POST['id']) && (trim($_POST['id']) != '')?$_POST['id']:'';
       

        $this->gestionModel->cambiarEstadoProceso($id,3);

        $this->getListadoFiltro();
    }

     /**
         * Imprimir procesos
        * @param: datos de filtro
        * @return  view
        */

    public function imprimirProceso(){
        
        $id = isset($_GET['id']) && (trim($_GET['id']) != '')?$_GET['id']:'';
        $objeto_descripcion = isset($_GET['objeto_descripcion']) && (trim($_GET['objeto_descripcion']) != '')?$_GET['objeto_descripcion']:'';
        $estado = isset($_GET['estado']) && (trim($_GET['estado']) != '')?$_GET['estado']:'';
        $comprador = isset($_GET['comprador']) && (trim($_GET['comprador']) != '')?$_GET['comprador']:'';

        $gestiones=$this->gestionModel->listadoGestionFilter($id,$objeto_descripcion,$estado,$comprador);

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=test_upload.csv');
            $output = fopen("php://output", "w");
         
     
               //Cabecera
                $headingArray[] = "ID oferta";
                $headingArray[] = "Objeto";
                $headingArray[] = "Actividad";
                $headingArray[] = "Moneda";
                $headingArray[] = "Presupuesto";
                $headingArray[] = "Fecha de inicio";
                $headingArray[] = "Hora de inicio";
                $headingArray[] = "Fecha de cierre";
                $headingArray[] = "Estado";


            fputcsv( $output , $headingArray );


            while($item = $gestiones->fetch())
            {   
                $dataArray[] =  $item['id'];
                $dataArray[] =  $item['objeto'];
                $dataArray[] =  $item['producto'];
                $dataArray[] =  $item['moneda'];
                $dataArray[] =  $item['presupuesto'];
                $dataArray[] =  $item['fecha_inicio'];
                $dataArray[] =  $item['hora_inicio'];
                $dataArray[] =  $item['fecha_cierre'];
                $dataArray[] =  $item['estado'];
                
                fputcsv($output, $dataArray);
                $dataArray = []; 
            }


            fclose($output);
    }

     /**
         * publicar Proceso
        * @param: id de proceso
        * @return  response
        */

    public function publicarProceso(){
        

        $_POST = json_decode(file_get_contents("php://input"), true);
        
        $id = isset($_POST['id']) && (trim($_POST['id']) != '')?$_POST['id']:'';
     
        $this->gestionModel->cambiarEstadoProceso($id,2);

        $this->getListadoFiltro();
    }

    public function getFormulario(){
        
        $actividades=$this->gestionModel->listadoActividades();

        while($item = $actividades->fetch())
        {
            $dev_act[]=['id' =>$item['id'],'producto' =>$item['producto']];
      
        }
        
        $data['actividades'] = json_encode($dev_act);

        $this->view->show("crear_proceso.php", $data);

    }


        /**
         * Trae Listado del filtro
        * @param: datos del filtro
        * @return  response
        */

    public function getListadoFiltro(){
        
        $_POST = json_decode(file_get_contents("php://input"), true);
        
        $id = isset($_POST['id']) && (trim($_POST['id']) != '')?$_POST['id']:'';
        $objeto_descripcion = isset($_POST['objeto_descripcion']) && (trim($_POST['objeto_descripcion']) != '')?$_POST['objeto_descripcion']:'';
        $estado = isset($_POST['estado']) && (trim($_POST['estado']) != '')?$_POST['estado']:'';
        $comprador = isset($_POST['comprador']) && (trim($_POST['comprador']) != '')?$_POST['comprador']:'';
       

        $gestiones=$this->gestionModel->listadoGestionFilter($id,$objeto_descripcion,$estado,$comprador);
        $dev_gest=[];
        while($item = $gestiones->fetch())
        {
            
            $dev_gest[]=['id' =>$item['id'],'objeto' =>$item['objeto'],'descripcion'=>$item['descripcion']
            ,'estado'=>$item['estado'],'fecha_cierre'=>$item['fecha_cierre'],'fecha_inicio'=>$item['fecha_inicio'] 
        ];
      
        }

        $response = ['type' => "success", 'data'=>$dev_gest,'message' => "Los datos se guardaron correctamente!"];
        echo json_encode($response);
    }

      /**
         * Trae Listado total
        * @param: 
        * @return  response
        */
    public function getListado(){


        $gestiones=$this->gestionModel->listadoTotal();

        while($item = $gestiones->fetch())
        {
            $dev_gest[]=['id' =>$item['id'],'objeto' =>$item['objeto'],'descripcion'=>$item['descripcion']
            ,'estado'=>$item['estado'],'fecha_cierre'=>$item['fecha_cierre'],'fecha_inicio'=>$item['fecha_inicio']
        
        
        ];
      
        }

        $data['gestiones'] = json_encode($dev_gest);
        
        $this->view->show("listado_proceso.php", $data);

    }


      /**
         * Guardar Proceso
        * @param: datos del formulario
        * @return  response
        */

    public function guardarProceso(){

        $_POST = json_decode(file_get_contents("php://input"), true);
        
        $moneda = isset($_POST['moneda']) && (trim($_POST['moneda']) != '')?$_POST['moneda']:''; 
        $presupuesto = isset($_POST['presupuesto']) && (trim($_POST['presupuesto']) != '')?$_POST['presupuesto']:''; 
        $descripcion = isset($_POST['descripcion']) && (trim($_POST['descripcion']) != '')?$_POST['descripcion']:''; 
    
        $actividad = isset($_POST['actividad']) && (trim($_POST['actividad']) != '')?$_POST['actividad']:''; 
        $objeto = isset($_POST['objeto']) && (trim($_POST['objeto']) != '')?$_POST['objeto']:''; 
        
        $fecha_inicio = isset($_POST['fecha_inicio']) && (trim($_POST['fecha_inicio']) != '')?$_POST['fecha_inicio']:''; 
        $fecha_cierre = isset($_POST['fecha_cierre']) && (trim($_POST['fecha_cierre']) != '')?$_POST['fecha_cierre']:''; 
        $hora_inicio = isset($_POST['hora_inicio']) && (trim($_POST['hora_inicio']) != '')?$_POST['hora_inicio']:''; 
        $hora_cierre = isset($_POST['hora_cierre']) && (trim($_POST['hora_cierre']) != '')?$_POST['hora_cierre']:''; 
    
          
                $data = [
                    "presupuesto" => $presupuesto,
                    "moneda" =>  $moneda,
                    "descripcion" =>$descripcion,
                    "actividad" => $actividad,
                    "objeto" => $objeto,
                    "fecha_inicio" =>$fecha_inicio ,
                    "fecha_cierre" => $fecha_cierre,
                    "hora_inicio" =>$hora_inicio,
                    "hora_cierre" =>$hora_cierre,
                    "estado" =>1
                ];

           
                $this->gestionModel->crearProceso($data);
                $id_proceso =$this->gestionModel->getLastID()->fetch();

                $documentos=$_POST["documentos"];

                
	
                    foreach ($documentos as $clave=>$value)
                    {

                        $data_documento = [
                            "id_proceso" =>$id_proceso["id"],
                            "titulo" =>$value,
                            
                        ];
                        
                        $this->gestionModel->crearDocumento($data_documento);
                
                    }

                $response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
                echo json_encode($response);
            
        


    }
    
}
?>