<?php
	require_once 'init.php';

	use database\ImportProfile;
	use excel\ImportController;
	use PhpOffice\PhpSpreadsheet\IOFactory;

	// exit();
	
	// Catching file upload
	if(empty($_FILES['document']['name'])){
		echo "No se encontro el documento.";
		exit();
	}

	$to = './'.$_FILES['document']['name'];
	rename($_FILES['document']['tmp_name'], $to);
	// print_r( json_encode($_FILES) );
	// exit();

	$pacientesProfile = ImportProfile::find($_POST['profile_id']);
	if(empty($pacientesProfile)){
		echo "No se encontro el perfil.";
		exit();
	}
	
	// print_r( json_encode($pacientesProfile) );
	// exit();

	$document = IOFactory::load($to);
	$sheets = $document->getAllSheets();
	$sheetPacientes = $sheets[0];

	// print_r( json_encode( get_class_methods($sheetPacientes) ) );
	// exit();

	$importer = new ImportController($pacientesProfile, $sheetPacientes);
	$result = $importer->execute();

	print_r( json_encode($result) );
	