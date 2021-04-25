<?php
/**
 * Created by PhpStorm.
 * User: manuel.gomez
 * Date: 24-04-2021
 * Time: 13:20
 */
include_once $_SERVER['DOCUMENT_ROOT']. '/testPHP/config/DBClass.php';

class Vehiculo
{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "vehiculos";

    // table columns
    public $id;
    public $patente;
    public $vehiculo;
    public $estado;
    public $fecha_creacion;
    public $fecha_modificacion;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C

    public function create($patente,$vehiculo,$estado, $valorPermiso, $multa, $intereses){

        if ($valorPermiso == "" or $valorPermiso == null){
            $valorPermiso =0;
        }
        if ($multa == "" or $multa == null){
            $multa =0;
        }
        if ($intereses == "" or $intereses == null){
            $intereses =0;
        }
        $link = 'http://localhost/modelo/v1/auto';

        $headr = array();
        $headr[] = 'Content-Type: application/x-www-form-urlencoded';

        //$headr[] = 'Authorization: OAuth '.$accesstoken;
        $headr[] = 'Authorization: 21232f297a57a5a743894a0e4a801fc3';


        $url = $link;
        $ch = curl_init($url);
        //$data = array('patente'=>$patente,'vehiculo'=>$vehiculo, 'estado'=>$estado, 'valor_permiso'=>$valorPermiso);

        //curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "patente=".$patente."&vehiculo=".$vehiculo."&estado=".$estado."&valor_permiso=".$valorPermiso."&intereses=".$intereses."&multa=".$multa);

        $result = curl_exec($ch);
        //json_decode($result, true);
        curl_close($ch);

        //header("Refresh:0; url=index.php");

        return $result;


    }
    //R
    public function readAll(){
        $query = "SELECT v.id, v.patente, v.vehiculo, p.valor_permiso, m.multa_impaga, m.intereses_reajustes FROM " . $this->table_name . " as v INNER JOIN permisos as p ON p.vehiculo_id = v.id INNER JOIN multas as m ON m.vehiculo_id = p.vehiculo_id";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    public function read($patente){
        $query = "SELECT v.id, v.patente, v.vehiculo, p.valor_permiso FROM " . $this->table_name . " as v LEFT JOIN permisos as p ON p.vehiculo_patente = v.patente WHERE v.patente = '". $patente."'" ;

        $stmt = $this->connection->prepare($query);

        $stmt->execute();



        return $stmt;
    }

    //U
    public function update($patente,$vehiculo, $valorPermiso, $vehiculoId, $intereses, $multa){

        if ($valorPermiso == "" or $valorPermiso == null){
            $valorPermiso =0;
        }
        if ($multa == "" or $multa == null){
            $multa =0;
        }
        if ($intereses == "" or $intereses == null){
            $intereses =0;
        }
        $link = 'http://localhost/modelo/v1/update';

        //print_r($vehiculoId);die;
        $headr = array();
        $headr[] = 'Content-Type: application/x-www-form-urlencoded';

        //$headr[] = 'Authorization: OAuth '.$accesstoken;
        $headr[] = 'Authorization: 21232f297a57a5a743894a0e4a801fc3';


        $url = $link;
        $ch = curl_init($url);
        //$data = array('patente'=>$patente,'vehiculo'=>$vehiculo, 'estado'=>$estado, 'valor_permiso'=>$valorPermiso);

        //curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "patente=".$patente."&vehiculo=".$vehiculo."&valor_permiso=".$valorPermiso."&vehiculo_id=".$vehiculoId."&intereses=".$intereses."&multa=".$multa);

        $result = curl_exec($ch);
        //json_decode($result, true);
        curl_close($ch);

        //header("Refresh:0; url=index.php");

        return $result;


    }
    //D
    public function delete(){}

    public function lastID($sql){
        $stmt = $this->connection->prepare($sql);

        $stmt->execute();
        return $stmt;

    }


}