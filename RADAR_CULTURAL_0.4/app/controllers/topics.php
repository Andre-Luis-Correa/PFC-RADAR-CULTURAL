<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateTopic.php");

$table = 'tb_categoria';
$errors = array();
$id = '';
$nome = '';
$cor = '';

$topics = selectAll($table);


if (isset($_POST['add-topic'])) {
	adminOnly();
	$errors = validateTopic($_POST);

	if (count($errors) === 0) {
		unset($_POST['add-topic']);
		$topic_id = create('tb_categoria', $_POST);
		$_SESSION['message'] = 'Categoria criada com sucesso';
		$_SESSION['type'] = 'success';
		header('location: ' . BASE_URL . '/admin/topics/index.php');
		exit();
	} else {
		$nome = $_POST['nome'];
		$cor = $_POST['cor'];
	}

}

if (isset($_GET['id_categoria'])) {
	$id = $_GET['id_categoria'];
	$topic = selectOne($table, ['id_categoria' => $id]);
	$id = $topic['id_categoria'];
	$nome = $topic['nome'];
	$cor = $topic['cor'];

}

if (isset($_GET['del_id'])) {
	adminOnly();
	$id = $_GET['del_id'];
	$count = deleteTopic($table, $id);
	$_SESSION['message'] = 'Categoria deletada com sucesso';
	$_SESSION['type'] = 'success';
	header('location: ' . BASE_URL . '/admin/topics/index.php');
	exit();
}


if (isset($_POST['update-topic'])) {
	adminOnly();
	$errors = validateTopic($_POST);

	if (count($errors) === 0) {
		$id = $_POST['id_categoria'];
		unset($_POST['update-topic'], $_POST['id_categoria']);
		$topic_id = updateTopic($table, $id, $_POST);

		$_SESSION['message'] = 'Categoria atualizada com sucesso';
		$_SESSION['type'] = 'success';
		header('location: ' . BASE_URL . '/admin/topics/index.php');
		exit();
	} else {
		$id = $_POST['id_categoria'];
		$nome = $_POST['nome'];
		$cor = $_POST['cor'];
	}
}