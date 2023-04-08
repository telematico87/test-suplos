<?php
class gestionModel
{
    protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    public function login($correo,$password){  

        $sql="SELECT count(*) as num FROM usuario where correo='$correo' and password='$password'";

        $consulta = $this->db->prepare($sql);
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }

    public function listadoGestionFilter($id,$objeto_descripcion,$estado,$comprador)
    {       

        $sql="SELECT p.id,p.estado, p.objeto, p.moneda, p.descripcion,
        p.presupuesto,p.id_actividad,p.fecha_inicio,p.fecha_cierre,p.hora_inicio,
        
        p.hora_cierre,a.producto  FROM proceso p inner join actividad a on a.id=p.id_actividad";
     
        if ($id!='') {
           $where0="p.id='$id'";
        }
        if ($objeto_descripcion!='') {
            $where1="(p.objeto='$objeto_descripcion' or p.descripcion='$objeto_descripcion')";
        } 
        if ($estado!=0) {
            $where2="p.estado='$estado'";
        }
  
        if(isset($where0) or isset($where1) or isset($where2)){
            $sql=$sql." WHERE ";
        }
        $cont=0;
        
        if (isset($where0)) {

            if($cont>0){
                $sql=$sql.' AND '.$where0;
            } else{
                $sql=$sql.$where0;
            }
            $cont++;
         }
         if (isset($where1) ) {
            if($cont>0){
                $sql=$sql.' AND '.$where1;
            } else{
                $sql=$sql.$where1;
            }
            $cont++;
         } 
         if (isset($where2) ) {
            if($cont>0){
                $sql=$sql.' AND '.$where2;
            } else{
                $sql=$sql.$where2;
            }
            $cont++;
         }


        
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare($sql);
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }

 
    public function listadoTotal()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM proceso');
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }

    public function listadoActividades()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM actividad');
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }
    
    public function crearProceso($data)
    { 
        $sql = "INSERT INTO proceso (estado, objeto, moneda, descripcion,presupuesto,id_actividad,fecha_inicio,fecha_cierre,hora_inicio,hora_cierre) VALUES (:estado,:objeto, :moneda, :descripcion,:presupuesto,:actividad,:fecha_inicio,:fecha_cierre,:hora_inicio,:hora_cierre)";
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare($sql);
        $consulta->execute($data);

        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }


    public function crearDocumento($data)
    { 
        $sql = "INSERT INTO documento (titulo, id_proceso) VALUES (:titulo,:id_proceso)";
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare($sql);
        $consulta->execute($data);

        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }


    public function getLastID()   { 
        $sql = "SELECT MAX(id) as id FROM proceso";
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare($sql);
        $consulta->execute();

        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }

    public function cambiarEstadoProceso($id,$estado) { 
        $sql = "UPDATE  proceso SET estado='$estado' where id='$id'";
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare($sql);
        $consulta->execute();

        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }


}
?>