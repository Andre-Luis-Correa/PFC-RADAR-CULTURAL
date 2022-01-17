<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");

$table = 'tb_publicacao';

$topics = selectAll('tb_categoria');
$posts = selectAll($table);


$errors = array();
$titulo = "";
$resumo = "";
$conteudo = "";
$categoria = "";


if (isset($_POST['add-post'])) {
	$errors = validatePost($_POST);

	if (count($errors) == 0) {
		unset($_POST['add-post'], $_POST['id_categoria']);
		$_POST['fk_id_usuario'] = 1;
		$_POST['fk_id_tag'] = 1;
		$_POST['publicado'] = isset($_POST['publicado']) ? 1 : 0;
		$_POST['conteudo'] = htmlentities($_POST['conteudo']);

		$post = create($table, $_POST);
		$_SESSION['message'] = "Publicação criada com sucesso";
		$_SESSION['type'] = "success";

		header("location: " . BASE_URL . "/admin/posts/index.php");
	} else {
		$titulo = $_POST['titulo'];
		$resumo = $_POST['resumo'];
		$conteudo = $_POST['conteudo'];
		$categoria_id = $_POST['fk_id_categoria'];
	}
}