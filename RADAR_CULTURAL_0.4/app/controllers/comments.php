<?php

include_once(ROOT_PATH . "/app/database/db.php");
include_once(ROOT_PATH . "/app/helpers/middleware.php");
include_once(ROOT_PATH . "/app/helpers/validateComment.php");

$table = 'tb_comentario';

$errors = array();

$id = "";
$conteudo_comment = "";
$publicacao_id = "";

$users= selectAll('tb_usuario');
$posts= selectAll('tb_publicacao');

$comments = selectAll($table);


//delete

if (isset($_GET['delete_id']) && $_SESSION['tipo_usuario'] == 1) {
	adminOnly();
	$count = deleteComment($table, $_GET['delete_id']);
	$_SESSION['message'] = "Comentário deletada com sucesso";
	$_SESSION['type'] = "success";

	if(isset($_GET['id_publicacao'])){
		header('location: ' . BASE_URL . '/single.php?id_publicacao=' . $_GET['id_publicacao']);
		exit();
	} else{
		header("location: " . BASE_URL . "/admin/comments/index.php");
		exit();
	}
}

if (isset($_GET['delete_id']) && $_SESSION['tipo_usuario'] == 0) {
	usersOnly();
	$count = deleteComment($table, $_GET['delete_id']);
	$_SESSION['message'] = "Comentário deletada com sucesso";
	$_SESSION['type'] = "success";

	if(isset($_GET['id_publicacao'])){
		header('location: ' . BASE_URL . '/single.php?id_publicacao=' . $_GET['id_publicacao']);
		exit();
	} else{
		header("location: " . BASE_URL . "/admin/comments/index.php");
		exit();
	}
}

//add comment

if (isset($_POST['add-comment'])) {
	usersOnly();

	$errors = validateComment($_POST);

	if (count($errors) === 0) {
		unset($_POST['add-comment']);
		$_POST['fk_id_usuario'] = $_SESSION['id_usuario'];
		$_POST['fk_id_publicacao'] = $_GET['id_publicacao'];

		$comment_id = create('tb_comentario', $_POST);
		$_SESSION['message'] = 'Comentário adicionado';
		$_SESSION['type'] = 'success';
		header('location: ' . BASE_URL . '/single.php?id_publicacao=' . $_GET['id_publicacao']);
		exit();
	} else {
		$conteudo_comment = $_POST['conteudo'];
	}

}

//update comment

