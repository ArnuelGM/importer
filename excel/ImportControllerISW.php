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
			$valueModel = array();

			$maxRows = $this->sheet->getHighestRow();
			for ($row = 1; $row <= $maxRows; $row++) {
				if( $row == 1 && $skypFirstRow ) continue;
				$rowValue = array();
				foreach ($fields as $i => $value) {
					$column = $i+1;
					$cell = $this->sheet->getCellByColumnAndRow($column, $row);
					$cellValue = $cell->getCalculatedValue();
					$insertValue = empty($cellValue) ? '' : $cellValue;
					$rowValue[$value] = $insertValue;
				}
				array_push($valueModel, $rowValue);
			}
			$result = DB::table($table)->insert($valueModel);
			return ["data" => $valueModel, "result" => $result];
		}
	}