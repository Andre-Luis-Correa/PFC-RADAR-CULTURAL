<?php


/*
//Exibir todos os erros quando ocorrerem
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

require('connect.php');


function dd($value) //vai ser deletada, serve para teste
{
	echo "<pre>", print_r($value, true), "</pre>";
	die();
}


function executeQuery($sql, $data)
{
	global $conn;
	$stmt = $conn->prepare($sql);
	
	//obtem um array indexado a partir de um array associativo
	$values = array_values($data);
	
	//define todos os N campos como string
	$types = str_repeat('s', count($values));

	// ... operador SPLAT: extrai o array em N variáveis.
	/*
	function concatenate($transform, ...$strings) {
		$string = '';
		foreach($strings as $piece) {
			$string .= $piece;
		}
		return($transform($string));
	}

	echo concatenate("strtoupper", "I'd ", "like ", 4 + 2, " apples");
	// This would print:
	// I'D LIKE 6 APPLES
	*/
	$stmt->bind_param($types, ...$values);
	$stmt->execute();

	return $stmt;
}

function selectAll($table, $conditions = [])
{
	global $conn;
	$sql = "SELECT * FROM $table";

	if (empty($conditions)) {
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		return $records;
	} else{
		//retorna apenas os registros que satisfazem as condições

		$i = 0;
		foreach ($conditions as $key => $value) {

			if ($i === 0) {
				$sql = $sql . " WHERE $key=?";
			} else {
				$sql = $sql . " AND $key=?";
			}
			$i++;
		}

		$stmt = executeQuery($sql, $conditions);
		$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		return $records;
	}
	
}


function selectOne($table, $conditions)
{
	global $conn;
	$sql = "SELECT * FROM $table";

		$i = 0;
		foreach ($conditions as $key => $value) {

			if ($i === 0) {
				$sql = $sql . " WHERE $key=?";
			} else {
				$sql = $sql . " AND $key=?";
			}
			$i++;
		}

		$sql = $sql . " LIMIT 1";
		$stmt = executeQuery($sql, $conditions);
		$records = $stmt->get_result()->fetch_assoc();
		return $records;
}


function create($table, $data)
{
	global $conn;
	
	$sql = "INSERT INTO $table SET ";

	$i = 0;
	foreach ($data as $key => $value) {

		if ($i === 0) {
			$sql = $sql . " $key=?";
		} else {
			$sql = $sql . ", $key=?";
		}
		$i++;
	}
	$stmt = executeQuery($sql, $data);
	$id = $stmt->insert_id;
	return $id;

}

/*$data = [
	'nome_completo' => 'teste teste',
	'nome_usuario' => 'teste',
	 'senha' => '1',
	 'tipo_usuario' => 0,
	 'email' => 'teste teste',
	 'foto_perfil' => 'teste teste'

];

print_r($data);

$users = create('tb_usuario', $data);
dd($users);
*/

function update($table, $id, $data)
{
	global $conn;
	$sql = "UPDATE $table SET ";

	$i = 0;
	foreach ($data as $key => $value) {

		if ($i === 0) {
			$sql = $sql . " $key=?";
		} else {
			$sql = $sql . ", $key=?";
		}
		$i++;
	}

	$sql = $sql . " WHERE id_usuario=?";
	$data['id_usuario'] = $id;
	$stmt = executeQuery($sql, $data);
	return $stmt->affected_rows;

}


function delete($table, $id)
{
	global $conn;
	$sql = "DELETE FROM $table WHERE id_usuario=? ";

	$stmt = executeQuery($sql, ['id_usuario' => $id]);
	return $stmt->affected_rows;

}


