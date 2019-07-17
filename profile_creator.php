<?php
	require_once 'init.php';
	use Illuminate\Database\Capsule\Manager as Capsule;	
	use database\ImportProfile;

	function json($data){
		print_r( json_encode($data) );
	}
	// listado de tablas
	$tables = Capsule::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' ORDER BY TABLE_NAME");

	if( !empty($_GET['profiles']) ){
		json( ImportProfile::all() );
		exit();
	}

	if( !empty($_POST['create_profile']) ){
		ImportProfile::create([
			'name' => $_POST['profile_name'],
			'table' => $_POST['table_name'],
			'fields' => $_POST['fields'],
			'skip_first_row' => '0'
		]);
		exit();
	}

	if( !empty($_POST['table_name']) ) {
		$fields = Capsule::select("SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, IS_NULLABLE, COLUMN_DEFAULT
									    FROM INFORMATION_SCHEMA.COLUMNS
									    WHERE TABLE_NAME = '{$_POST['table_name']}'");
		json($fields);
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Creacion de Perfiles</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- include VueJS first -->
	<script src="https://unpkg.com/vue@latest"></script>

	<!-- use the latest vue-select release -->
	<script src="https://unpkg.com/vue-select@latest"></script>
	<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

</head>
<body>
	
	<div class="container mt-5" id="app">
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="card mt-2">
					<div class="card-header">
						Creacion de Perfiles de Importación.
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Nombre del perfil</label>
							<input class="form-control" v-model="profileName"></input>
						</div>
						<div class="form-group">
							<label>Tabla</label>
							<select v-model="table" name="table_name" class="form-control" @change="sendTable">
								<option v-for="t in tablesList" :value="t">{{ t }}</option>
							</select>
						</div>
						<div class="form-group" v-if="fields.length > 0">
							<label>Columnas</label>
							<select v-model="fieldsSelected" class="form-control" multiple style="height: 250px;">
								<option v-for="f in fields" :value="f.COLUMN_NAME">{{ f.COLUMN_NAME }}</option>
							</select>
							<small class="form-text text-muted">Presione la tecla Ctrl para seleccionar varias opciones.</small>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" @click="createProfile" type="button">Guardar</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="card mt-2">
					<div class="card-header">Perfiles Creados</div>
					<div class="card-body">
						<table class="table table-striped table-sm">
							<thead>
								<tr>
									<th>Nombre del perfil</th>
									<th>Plantilla</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="p in profilesList">
									<td>{{ p.name }}</td>
									<td>
										<a href="#" class="btn btn-link">Descargar</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		Vue.component('v-select', VueSelect.VueSelect);
		const tables = <?php json($tables) ?>;
		new  Vue({
			el: '#app',
			data: {
				tables: tables,
				table: '<?php echo $_POST['table_name'] ?>',
				fields: [],
				fieldsSelected: [],
				profileName: '',
				profilesList: []
			},
			computed: {
				tablesList() {
					return this.tables.map(t => t.TABLE_NAME);
				}
			},
			methods: {
				sendTable(){
					const data = new FormData();
					data.append('table_name', this.table);
					fetch('profile_creator.php', {
						method: 'POST',
						body: data
					})
					.then(r => r.json())
					.then(res => {
						this.fields = res;
					});
				},
				createProfile(){
					const data = new FormData();
					data.append('table_name', this.table);
					data.append('profile_name', this.profileName);
					data.append('fields', JSON.stringify(this.fieldsSelected));
					data.append('create_profile', 1);
					fetch('profile_creator.php', {
						method: 'POST',
						body: data
					})
					.then(() => {
						this.table =  '';
						this.fields =  [];
						this.fieldsSelected =  [];
						this.profileName =  '';

						this.getProfilesList();
						alert('Perfil Creado.');
					});
				},
				getProfilesList(){
					fetch('profile_creator.php?profiles=true')
					.then(r => r.json())
					.then(res => {
						this.profilesList = res;
					});
				}
			},
			mounted(){
				this.getProfilesList();
			}
		});
	</script>
</body>
</html>