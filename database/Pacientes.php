<?php
namespace database;
use Illuminate\Database\Eloquent\Model;
class Pacientes extends Model {
	protected $table = 'sis_paci';
	protected $fillable = ['tipo_id', 'num_id', 'primer_ape', 'segundo_ape', 'primer_nom', 'segundo_nom', 'sexo', 'telefono', 'email'];
}
