<?php

//Exibir todos os erros quando ocorrerem
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

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

//recuperação de senha

function recuperarSenha($table, $email, $data){
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

	$sql = $sql . " WHERE email=?";
	$data['email'] = $email;
	$stmt = executeQuery($sql, $data);
	return $stmt->affected_rows;
}


//user
function updateUser($table, $id, $data)
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

//topic
function updateTopic($table, $id, $data)
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

	$sql = $sql . " WHERE id_categoria=?";
	$data['id_categoria'] = $id;
	$stmt = executeQuery($sql, $data);
	return $stmt->affected_rows;

}

//post
function updatePost($table, $id, $data)
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

	$sql = $sql . " WHERE id_publicacao=?";
	$data['id_publicacao'] = $id;
	$stmt = executeQuery($sql, $data);
	return $stmt->affected_rows;

}

//comment
function updateComment($table, $id, $data)
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

	$sql = $sql . " WHERE id_comentario=?";
	$data['id_comentario'] = $id;
	$stmt = executeQuery($sql, $data);
	return $stmt->affected_rows;

}

function deleteUser($table, $id)
{
	global $conn;
	$sql = "DELETE FROM $table WHERE id_usuario=? ";

	$stmt = executeQuery($sql, ['id_usuario' => $id]);
	return $stmt->affected_rows;

}

function deleteTopic($table, $id)
{
	global $conn;
	$sql = "DELETE FROM $table WHERE id_categoria=? ";

	$stmt = executeQuery($sql, ['id_categoria' => $id]);
	return $stmt->affected_rows;

}

function deletePost($table, $id)
{
	global $conn;
	$sql = "DELETE FROM $table WHERE id_publicacao=? ";

	$stmt = executeQuery($sql, ['id_publicacao' => $id]);
	return $stmt->affected_rows;

}

function deleteComment($table, $id)
{
	global $conn;
	$sql = "DELETE FROM $table WHERE id_comentario=? ";

	$stmt = executeQuery($sql, ['id_comentario' => $id]);
	return $stmt->affected_rows;

}


function getPublishedPosts()
{
	global $conn;
	$sql = "SELECT p.*, u.nome_usuario FROM tb_publicacao AS p JOIN tb_usuario AS u ON p.fk_id_usuario = u.id_usuario WHERE p.publicado=?";

	$stmt = executeQuery($sql, ['publicado' => 1]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}

function getPostsByTopic($topic_id)
{
	global $conn;

	$sql = "SELECT p.*, u.nome_usuario FROM tb_publicacao AS p JOIN tb_usuario AS u ON p.fk_id_usuario = u.id_usuario WHERE p.publicado=? AND fk_id_categoria=?";

	$stmt = executeQuery($sql, ['publicado' => 1, 'id_categoria' => $topic_id]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}



function getCommentsByPost($post_id)
{
	global $conn;

	$sql = "SELECT c.* FROM tb_comentario AS c JOIN tb_publicacao AS p where c.fk_id_publicacao = p.id_publicacao AND fk_id_publicacao=?";

	$stmt = executeQuery($sql, ['id_publicacao' => $post_id]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}

//$comments = getCommentsByPost(44);
//dd($comments);



function searchPosts($term)
{
	$match = '%' . $term . '%';
	global $conn;
	$sql = "SELECT 
				p.*, u.nome_usuario 
			FROM tb_publicacao AS p 
			JOIN tb_usuario AS u 
			ON p.fk_id_usuario = u.id_usuario 
			WHERE p.publicado=?
			AND p.titulo LIKE ? OR p.conteudo LIKE ?";

	$stmt = executeQuery($sql, ['publicado' => 1, 'titulo' => $match, 'conteudo' => $match]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}