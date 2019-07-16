<?php
namespace database;
use Illuminate\Database\Eloquent\Model;
class ImportProfile extends Model {
	protected $table = 'profiles_import';
	protected $fillable = ['name', 'table', 'skip_first_row', 'fields'];
	public $timestamps = false;
}

// ImportProfile::create([
// 	'name' => 'Pacientes',
// 	'table' => 'sis_paci',
// 	'skip_first_row' => 0,
// 	'fields' => '["tipo_id", "num_id", "primer_ape", "segundo_ape", "primer_nom", "segundo_nom", "sexo", "telefono", "email"]'
// ]);
