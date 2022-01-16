<?php

include("app/database/db.php");
include("app/helpers/validateUser.php");

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
			header('location: ../admin/dashboard.php');	
	} else{
			header('location: ../RADAR%20CULTURAL%200.1/index.php');
	}

	exit();
}

if(isset($_POST['register-btn'])){

	$errors = validateUser($_POST);

   if (count($errors) == 0) 
   {
   	   unset($_POST['register-btn'], $_POST['senhaConf']);
	   $_POST['tipo_usuario'] = 0;

	   $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

	   $user_id = create($table, $_POST);
	   $user = selectOne($table, ['id_usuario' => $user_id]);
	   
	   // log user in
	   loginUser($user);

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



