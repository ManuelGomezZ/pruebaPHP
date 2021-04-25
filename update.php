<?php
/**
 * Created by PhpStorm.
 * User: manuel.gomez
 * Date: 24-04-2021
 * Time: 21:05
 */

require_once 'config/DBClass.php';
require_once 'class/Vehiculo.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
if(ISSET($_POST['ID0'])){
    $id = $_POST['ID0'];
    $patente = $_POST['PATENTE1'];
    $vehiculo = $_POST['VEHICULO2'];
    $valorPermiso = $_POST['VALOR_PERMISO3'];
    $intereses = $_POST['INTERESES4'];
    $multa = $_POST['MULTAS5'];
    $claseVehiculo = new Vehiculo($connection);

    $readSQL =  $claseVehiculo->read($patente);
    $stmt = $claseVehiculo->update($patente, $vehiculo, $valorPermiso, $id, $intereses, $multa);
    header("Refresh:0; url=index.php");
}
?>