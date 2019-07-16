<?php
	require_once 'ImportControllerISW.php';
	// namespace ImportIsw;

	// use Illuminate\Database\Capsule\Manager as DB;
	// use PhpOffice\PhpSpreadsheet\IOFactory;

	// function printJson($object) {
	// 	print_r( json_encode( $object ) );
	// 	// exit();
	// }

	/*
		$profile = [
			"table" => "sis_paci",
			"skipFirstRow" => false,
			"profileName" => "pacientes",
			"fields" => ['primer_nom', 'segundo_nom', 'primer_ape', 'segundo_ape', 'tipo_id', 'num_id', 'sexo']
		]
	 */
	/*function dumpSheetToModel($profile, $sheet){
		$table = $profile['table'];
		$skypFirstRow = $profile['skypFirstRow'];
		$fields = $profile['fields'];
		$valueModel = array();

		$maxRows = $sheet->getHighestRow();
		for ($row = 1; $row <= $maxRows; $row++) {
			if( $row == 1 && $skypFirstRow ) continue;
			$rowValue = array();
			foreach ($fields as $i => $value) {
				$column = $i+1;
				$cell = $sheet->getCellByColumnAndRow($column, $row);
				$cellValue = $cell->getCalculatedValue();
				$insertValue = empty($cellValue) ? '' : $cellValue;
				$rowValue[$value] = $insertValue;
			}
			array_push($valueModel, $rowValue);
		}
		DB::table($table)->insert($valueModel);
		return $valueModel;
	}*/

	/*$document = IOFactory::load('pacientes.xlsx');
	$sheets = $document->getAllSheets();
	foreach ($sheets as $sheet) {
		$profile = [
			'table' => 'sis_paci',
			'skypFirstRow' => false,
			'fields' => ['tipo_id', 'num_id', 'primer_ape', 'segundo_ape', 'primer_nom', 'segundo_nom', 'sexo', 'telefono', 'email']
		];
		$value = dumpSheetToModel($profile, $sheet, null, Pacientes::class);
		printJson($value);
		exit();
	}*/