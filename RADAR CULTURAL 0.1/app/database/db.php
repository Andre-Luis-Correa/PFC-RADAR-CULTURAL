<?php

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
	$values = array_values($data);
	$types = str_repeat('s', count($values));
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
	foreach ($conditions as $key => $value) {

		if ($i === 0) {
			$sql = $sql . " $key=?";
		} else {
			$sql = $sql . " $key=?";
		}
		$i++;
	}
}



$conditions = [
	'id_usuario' => 1,
	'nome_usuario' => 'andre_luis'
];

$usuarios = selectOne('tb_usuario', $conditions);
dd($usuarios);
