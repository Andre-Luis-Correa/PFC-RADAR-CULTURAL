<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateComment.php");

$table = 'tb_comentario';

$errors = array();

$id = "";
$conteudo = "";
$publicacao_id = "";

$users= selectAll('tb_usuario');
$posts= selectAll('tb_publicacao');

$comments = selectAll($table);


//delete

if (isset($_GET['delete_id'])) {
	adminOnly();
	$count = deleteComment($table, $_GET['delete_id']);
	$_SESSION['message'] = "Comentário deletada com sucesso";
	$_SESSION['type'] = "success";

	header("location: " . BASE_URL . "/admin/comments/index.php");
	exit();
}

