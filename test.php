<?php
		require_once 'init.php';
		use Illuminate\Database\Capsule\Manager as Capsule;

		function json($data){
			print_r( json_encode($data) );
		}
		function methods($data){
			json( get_class_methods($data) );
		}

		// $list = Capsule::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' ORDER BY TABLE_NAME");
		// foreach ($list as $table) {
			$fields = Capsule::select("SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, IS_NULLABLE, COLUMN_DEFAULT
									    FROM INFORMATION_SCHEMA.COLUMNS
									    WHERE TABLE_NAME = 'sis_paci'");
		// }
		json( ($fields) );
