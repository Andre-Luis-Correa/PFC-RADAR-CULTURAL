<?php

include("app/database/db.php");
include("app/helpers/validateUser.php");

$errors = array();
$nome_completo = '';
$nome_usuario = '';
$email = '';
$senha = '';
$senhaConf = '';

if(isset($_POST['register-btn'])){

	$errors = validateUser($_POST);

   if (count($errors) == 0) 
   {
   	   unset($_POST['register-btn'], $_POST['senhaConf']);
	   $_POST['tipo_usuario'] = 0;

	   $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

	   $user_id = create('tb_usuario', $_POST);
	   $user = selectOne('tb_usuario', ['id_usuario' => $user_id]);
	   
	   // log user in
	   
   } else {
   		$nome_completo = $_POST['nome_completo'];
   		$nome_usuario = $_POST['nome_usuario'];
   		$email = $_POST['email'];
   		$senha = $_POST['senha'];
   		$senhaConf = $_POST['senhaConf'];
   }

   
}



