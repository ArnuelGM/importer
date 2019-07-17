<?php
namespace database;
use Illuminate\Database\Eloquent\Model;
class ImportProfile extends Model {
	protected $table = 'profiles_import';
	protected $fillable = ['name', 'table', 'skip_first_row', 'fields'];
	public $timestamps = false;
}

// ImportProfile::create([
// 	'name' => 'Diagnosticos',
// 	'table' => 'sis_diags',
// 	'skip_first_row' => 0,
// 	'fields' => '["codigo","descripcion","sexo","edadi","edadf"]'
// ]);
