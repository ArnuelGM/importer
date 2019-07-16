<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="index.php" enctype="multipart/form-data">
		<label>Perfil: </label>
		<br>
		<select name="profile_id">
			<option value="">Seleccione el perfil</option>
			<option value="1">Pacientes</option>
		</select>
		<br>
		<br>
		<label>Archivo:</label>
		<br>
		<input type="file" name="document">
		<br>
		<br>
		<button type="submit">Guardar</button>
	</form>
</body>
</html>