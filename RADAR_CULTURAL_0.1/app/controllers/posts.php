<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");

$table = 'tb_publicacao';

$topics = selectAll('tb_categoria');

$posts = selectAll($table);


$errors = array();
$id = "";
$titulo = "";
$resumo = "";
$conteudo = "";
$categoria_id = "";
$publicado = "";

if (isset($_GET['id_publicacao'])) {
	$post = selectOne($table, ['id_publicacao' => $_GET['id_publicacao']]);

	$id = $post['id_publicacao'];
	$titulo = $post['titulo'];
	$resumo = $post['resumo'];
	$conteudo = $post['conteudo'];
	$categoria_id = $post['fk_id_categoria'];
	$publicado = $post['publicado'];
}

//delete

if (isset($_GET['delete_id'])) {
	$count = deletePost($table, $_GET['delete_id']);
	$_SESSION['message'] = "Publicação deletada com sucesso";
	$_SESSION['type'] = "success";

	header("location: " . BASE_URL . "/admin/posts/index.php");
	exit();
}

//publico ou não

if (isset($_GET['publicado']) && isset($_GET['p_id'])) {
	$publicado = $_GET['publicado'];
	$p_id = $_GET['p_id'];
	// ... atualizar o campo de público ou não
	$count = updatePost($table, $p_id, ['publicado' => $publicado]);

	$_SESSION['message'] = "Status de publicação atualizado";
	$_SESSION['type'] = "success";

	header("location: " . BASE_URL . "/admin/posts/index.php");
	exit();

}


//add

if (isset($_POST['add-post'])) {
	
	$errors = validatePost($_POST);

	if (!empty($_FILES['imagem_capa']['name'])) {
		$imagem_nome = time() . '_' . $_FILES['imagem_capa']['name'];
		$destino = ROOT_PATH . "/assets/images/" . $imagem_nome;

		$result = move_uploaded_file($_FILES['imagem_capa']['tmp_name'], $destino);

		if ($result) {
			$_POST['imagem_capa'] = $imagem_nome;
		} else {
			array_push($errors, "Falha ao adicionar imagem");
		}
		

	} else {
		array_push($errors, "Imagem de capa obrigatória");
	}
	

	if (count($errors) == 0) {
		unset($_POST['add-post']);
		$_POST['fk_id_usuario'] = 1;
		$_POST['fk_id_tag'] = 1;
		$_POST['publicado'] = isset($_POST['publicado']) ? 1 : 0;
		$_POST['conteudo'] = htmlentities($_POST['conteudo']);


		$post_id = create($table, $_POST);
		$_SESSION['message'] = "Publicação criada com sucesso";
		$_SESSION['type'] = "success";

		header("location: " . BASE_URL . "/admin/posts/index.php");
		exit();
	} else {
		$titulo = $_POST['titulo'];
		$resumo = $_POST['resumo'];
		$conteudo = $_POST['conteudo'];
		$categoria_id = $_POST['fk_id_categoria'];
		$publicado = isset($_POST['publicado']) ? 1 : 0;
	}
}

//update

if (isset($_POST['update-post'])) {
	$errors = validatePost($_POST);

	if (!empty($_FILES['imagem_capa']['name'])) {
		$imagem_nome = time() . '_' . $_FILES['imagem_capa']['name'];
		$destino = ROOT_PATH . "/assets/images/" . $imagem_nome;

		$result = move_uploaded_file($_FILES['imagem_capa']['tmp_name'], $destino);

		if ($result) {
			$_POST['imagem_capa'] = $imagem_nome;
		} else {
			array_push($errors, "Falha ao adicionar imagem");
		}
		

	} /*else {
		//
		$_POST['imagem_capa'] = $posts['imagem_capa'];
		
		//

		//array_push($errors, "Imagem de capa obrigatória");
	}*/



	if (count($errors) == 0) {
		$id = $_POST['id_publicacao'];
		unset($_POST['update-post'], $_POST['id_publicacao']);
		$_POST['fk_id_usuario'] = 1;
		$_POST['fk_id_tag'] = 1;
		$_POST['publicado'] = isset($_POST['publicado']) ? 1 : 0;
		$_POST['conteudo'] = htmlentities($_POST['conteudo']);


		$post_id = updatePost($table, $id, $_POST);
		$_SESSION['message'] = "Publicação atualizada com sucesso";
		$_SESSION['type'] = "success";

		header("location: " . BASE_URL . "/admin/posts/index.php");
		exit();
	} else {
		$id = $_POST['id_publicacao'];
		$titulo = $_POST['titulo'];
		$resumo = $_POST['resumo'];
		$conteudo = $_POST['conteudo'];
		$categoria_id = $_POST['fk_id_categoria'];
		$publicado = isset($_POST['publicado']) ? 1 : 0;
	}
}