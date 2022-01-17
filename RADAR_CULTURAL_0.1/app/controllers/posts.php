<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");

$table = 'tb_publicacao';

$topics = selectAll('tb_categoria');
$posts = selectAll($table);


$errors = array();


if (isset($_POST['add-post'])) {
	unset($_POST['add-post'], $_POST['id_categoria']);
	$_POST['fk_id_usuario'] = 1;
	$_POST['fk_id_tag'] = 1;
	$_POST['publicado'] = 1;

	$post = create($table, $_POST);

	header("location: " . BASE_URL . "/admin/posts/index.php");
}