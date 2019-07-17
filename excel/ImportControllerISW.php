<?php
	namespace excel;
	use Illuminate\Database\Capsule\Manager as DB;

	class ImportController {
		
		private $sheet;
		private $profile;

		public function __construct($profile, $sheet){
			$this->sheet = $sheet;
			$this->profile = $profile;
		}

		public function execute() {
			$table = $this->profile->table;
			$skypFirstRow = $this->profile->skip_first_row;
			$fields = (array) json_decode($this->profile->fields);
			$rowsToInsert = array();
			$rowsToInsertTotal = array();
			$maxRows = $this->sheet->getHighestRow();
			$maxRows = 12422;

			// print_r($maxRows);
			// exit();
			$rowsCount = 0;
			for ($row = 1; $row <= $maxRows; $row++) {
				if( $row == 1 && $skypFirstRow ) continue;
				if($rowsCount == 20){
					$rowsCount = 0;
					$res = DB::table($table)->insert($rowsToInsert);
					if($res) $rowsToInsertTotal = array_merge($rowsToInsertTotal, $rowsToInsert);
					$rowsToInsert = array();
				}
				$rowValue = array();
				foreach ($fields as $i => $value) {
					$column = $i+1;
					$cell = $this->sheet->getCellByColumnAndRow($column, $row);
					$cellValue = $cell->getCalculatedValue();
					$insertValue = empty($cellValue) ? '' : $cellValue;
					$rowValue[$value] = $insertValue;
				}
				array_push($rowsToInsert, $rowValue);
				$rowsCount++;
			}
			$res = DB::table($table)->insert($rowsToInsert);
			if($res) $rowsToInsertTotal = array_merge($rowsToInsertTotal, $rowsToInsert);
			return ["inserted" => $rowsToInsertTotal, "result" => $res];
			// return $rowsToInsert;
		}
	}