<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validatePage.php");

$table = 'tb_pagina';
$errors = array();
$id = '';
$titulo = '';
$conteudo = '';

$pages = selectAll($table);


if (isset($_POST['add-page'])) {
	adminOnly();

	$errors = validatePage($_POST);

	if (count($errors) === 0) {
		unset($_POST['add-page']);
		$_POST['conteudo'] = htmlentities($_POST['conteudo']);
		$topic_id = create('tb_pagina', $_POST);
		$_SESSION['message'] = 'Página criada com sucesso';
		$_SESSION['type'] = 'success';
		header('location: ' . BASE_URL . '/admin/pages/index.php');
		exit();
	} else {
		$titulo = $_POST['titulo'];
		$conteudo = $_POST['conteudo'];
	}

}


if (isset($_GET['id_pagina'])) {
	$id = $_GET['id_pagina'];
	$page = selectOne($table, ['id_pagina' => $id]);
	$id = $page['id_pagina'];
	$titulo = $page['titulo'];
	$conteudo = $page['conteudo'];
}




if (isset($_POST['update-page'])) {
	adminOnly();
	$errors = validatePage($_POST);

	if (count($errors) === 0) {
		$id = $_POST['id_pagina'];
		$_POST['conteudo'] = htmlentities($_POST['conteudo']);

		unset($_POST['update-page'], $_POST['id_pagina']);

		$page_id = updatePage($table, $id, $_POST);

		$_SESSION['message'] = 'Página atualizada com sucesso';
		$_SESSION['type'] = 'success';
		header('location: ' . BASE_URL . '/admin/pages/index.php');
		exit();
	} else {
		$id = $_POST['id_pagina'];
		$titulo = $_POST['titulo'];
		$conteudo = $_POST['conteudo'];
	}
}