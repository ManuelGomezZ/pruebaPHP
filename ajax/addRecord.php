<?php

//print_r($_POST);die;
	if(isset($_POST['patente']) && isset($_POST['vehiculo']) && isset($_POST['valorPermiso']) && isset($_POST['multa']) && isset($_POST['intereses']))
	{

        include_once $_SERVER['DOCUMENT_ROOT']. '/testPHP/config/DBClass.php';
        include_once $_SERVER['DOCUMENT_ROOT']. '/testPHP/class/Vehiculo.php';

        $dbclass = new DBClass();
        $connection = $dbclass->getConnection();
		// get values 
		$patente = $_POST['patente'];
		$vehiculo = $_POST['vehiculo'];
		$valorPermiso = $_POST['valorPermiso'];
		$multa = $_POST['multa'];
		$intereses = $_POST['intereses'];

        $claseVehiculo = new Vehiculo($connection);


        $stmt = $claseVehiculo->create($patente,$vehiculo, 1, $valorPermiso, $multa, $intereses);




	}
?>