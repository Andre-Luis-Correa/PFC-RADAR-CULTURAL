<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");

$table = 'tb_usuario';

$admin_users = selectAll($table, ['tipo_usuario' => 1]);
$read_users = selectAll($table, ['tipo_usuario' => 0]);

$errors = array();
$nome_completo = '';
$nome_usuario = '';
$email = '';
$senha = '';
$senhaConf = '';
$table = 'tb_usuario';

function loginUser($user)
{
	$_SESSION['id_usuario'] = $user['id_usuario'];

	$_SESSION['nome_usuario'] = $user['nome_usuario'];

	$_SESSION['tipo_usuario'] = $user['tipo_usuario'];

	$_SESSION['message'] = 'Você está logado';

	$_SESSION['type'] = 'success';

	if ($_SESSION['tipo_usuario'] == 1) {
			header('location: ' . BASE_URL . '/admin/dashboard.php');	
	} else{
			header('location: ' . BASE_URL . '/index.php');
	}

	exit();
}


//registro

if(isset($_POST['register-btn']) || isset($_POST['create-admin'])){

    $errors = validateUser($_POST);

    //

    if (!empty($_FILES['foto_perfil']['name'])) {
    	$imagem_nome = time() . '_' . $_FILES['foto_perfil']['name'];
    	$destino = ROOT_PATH . "/assets/images/" . $imagem_nome;

    	$result = move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino);

    	if ($result) {
    		$_POST['foto_perfil'] = $imagem_nome;
    	} else {
    		array_push($errors, "Falha ao adicionar imagem");
    	}
    	

    } /*else {
    	array_push($errors, "Imagem de capa obrigatória");
    }*/

    //

   if (count($errors) == 0) 
   {
   	   unset($_POST['register-btn'], $_POST['senhaConf'], $_POST['create-admin']);
	   $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

	   if (isset($_POST['tipo_usuario'])) {
	   		$_POST['tipo_usuario'] = 1;
	   		$user_id = create($table, $_POST);
	   		$_SESSION['message'] = "Colaborador criado com sucesso";
	   		$_SESSION['type'] = "success";
	   		header('location: ' . BASE_URL . '/admin/users/index.php');
	   		exit();
	   } else {
	   		$_POST['tipo_usuario'] = 0;
	   		$user_id = create($table, $_POST);
	   		$user = selectOne($table, ['id_usuario' => $user_id]);
	   		
	   		// log user in
	   		loginUser($user);
	   }

   } else {
   		$nome_completo = $_POST['nome_completo'];
   		$nome_usuario = $_POST['nome_usuario'];
   		$email = $_POST['email'];
   		$senha = $_POST['senha'];
   		$senhaConf = $_POST['senhaConf'];
   }
   
}


//login

if (isset($_POST['login-btn'])) {
	$errors = validateLogin($_POST);

	if (count($errors) === 0) {
		$user = selectOne($table, ['nome_usuario' => $_POST['nome_usuario']] );

		if ($user && password_verify($_POST['senha'], $user['senha'])) {
			
			loginUser($user);

		} else {
			array_push($errors, 'Credenciais incorretas');
		}
	}

	$nome_usuario = $_POST['nome_usuario'];
	$senha = $_POST['senha'];
}


if (isset($_GET['delete_id_colaborador'])) {
	$count = deleteUser($table, $_GET['delete_id_colaborador']);

	$_SESSION['message'] = "Colaborador deletado com sucesso";
	$_SESSION['type'] = "success";
	header('location: ' . BASE_URL . '/admin/users/index.php');
	exit();
}

if (isset($_GET['delete_id_leitor'])) {
	$count = deleteUser($table, $_GET['delete_id_leitor']);

	$_SESSION['message'] = "Leitor deletado com sucesso";
	$_SESSION['type'] = "success";
	header('location: ' . BASE_URL . '/admin/users/index.php');
	exit();
}


