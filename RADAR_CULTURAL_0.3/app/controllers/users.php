<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");

$table = 'tb_usuario';

$admin_users = selectAll($table, ['tipo_usuario' => 1]);
$read_users = selectAll($table, ['tipo_usuario' => 0]);


$errors = array();
$id = '';
$nome_completo = '';
$nome_usuario = '';
$colaborador = '';
$email = '';
$senha = '';
$senhaConf = '';
$table = 'tb_usuario';
$verificar_criacao = '';

function loginUser($user)
{
	$_SESSION['id_usuario'] = $user['id_usuario'];

	$_SESSION['email'] = $user['email'];

	$_SESSION['nome_usuario'] = $user['nome_usuario'];

	$_SESSION['tipo_usuario'] = $user['tipo_usuario'];

	$_SESSION['message'] = 'Você está logado';

	$_SESSION['type'] = 'success';

	if ($_SESSION['tipo_usuario']) {
			header('location: ' . BASE_URL . '/admin/dashboard.php');	
	} else{
			header('location: ' . BASE_URL . '/index.php');
	}

	exit();
}


//registro e criação

if(isset($_POST['register-btn']) || isset($_POST['create-admin'])){

    $errors = validateUser($_POST);

    //

    if (!empty($_FILES['foto_perfil']['name']) && strlen($_FILES['foto_perfil']['name']) < 256) {
    	$imagem_nome = time() . '_' . $_FILES['foto_perfil']['name'];
    	$destino = ROOT_PATH . "/assets/images/" . $imagem_nome;

    	$result = move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino);

    	if ($result) {
    		$_POST['foto_perfil'] = $imagem_nome;
    	} else {
    		array_push($errors, "Falha ao adicionar imagem");
    	}
    	

    } else {
    	if (strlen($_FILES['foto_perfil']['name']) > 255) {
			array_push($errors, "Nome da imagem muito longo");
		}
    }


   if (count($errors) === 0) {

   		if (isset($_POST['create-admin'])) {
   			$verificar_criacao = $_POST['create-admin'];
   		} 

   		$verificar_criacao = $_POST['create-admin'];
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
	   		
	   		//redirecionamento de acordo com a forma de criação do usuário
	   		// se o usuário está se registrando, após o registro, o mesmo é enviado para a página inicial
	   		// se o usuário está sendo adicionado pelo administrador ou um dos colboradores, o administrador ou um dos colboradores serão redirecionados para o index da pasta admin
	   		
	   		if (!isset($verificar_criacao)) {
	   			// log user in
	   			loginUser($user);
	   		} else {
	   			$_SESSION['message'] = "Usuário criado com sucesso";
	   			$_SESSION['type'] = "success";
	   			header('location: ' . BASE_URL . '/admin/users/index.php');
	   			exit();
	   		}
	   		//
	   		
	   }

   } else {
   		$nome_completo = $_POST['nome_completo'];
   		$nome_usuario = $_POST['nome_usuario'];
   		$colaborador = isset($_POST['tipo_usuario']) ? 1 : 0;
   		$email = $_POST['email'];
   		$senha = $_POST['senha'];
   		$senhaConf = $_POST['senhaConf'];
   }
   
}


//update


if (isset($_POST['update-user'])) {
		adminOnly();
	    $errors = validateUser($_POST);

	    //

	    if (!empty($_FILES['foto_perfil']['name']) && strlen($_FILES['foto_perfil']['name']) < 256) {
	    	$imagem_nome = time() . '_' . $_FILES['foto_perfil']['name'];
	    	$destino = ROOT_PATH . "/assets/images/" . $imagem_nome;

	    	$result = move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino);

	    	if ($result) {
	    		$_POST['foto_perfil'] = $imagem_nome;
	    	} else {
	    		array_push($errors, "Falha ao adicionar imagem");
	    	}
	    	

	    } else {
	    	if (strlen($_FILES['foto_perfil']['name']) > 255) {
			array_push($errors, "Nome da imagem muito longo");
			}
	    }

	   if (count($errors) === 0) {
	   	   $id = $_POST['id_usuario'];
	   	   unset($_POST['senhaConf'], $_POST['update-user'], $_POST['id_usuario']);
		   $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

		   	$_POST['tipo_usuario'] = isset($_POST['tipo_usuario']) ? 1 : 0;
		   	$count = updateUser($table, $id, $_POST);
		   	$_SESSION['message'] = "Usuário editado com sucesso";
		   	$_SESSION['type'] = "success";
		   	header('location: ' . BASE_URL . '/admin/users/index.php');
		   	exit();

	   } else {
	   		$id = $_POST['id_usuario'];
	   		$nome_completo = $_POST['nome_completo'];
	   		$nome_usuario = $_POST['nome_usuario'];
	   		$colaborador = isset($_POST['tipo_usuario']) ? 1 : 0;
	   		$email = $_POST['email'];
	   		$senha = $_POST['senha'];
	   		$senhaConf = $_POST['senhaConf'];
	   }
}


//////// update gerenciamento de perfil

if (isset($_POST['update-user-profile'])) {
		usersOnly();
	    $errors = validateUser($_POST);

	    //// imagem de perfil

	    if (!empty($_FILES['foto_perfil']['name']) && strlen($_FILES['foto_perfil']['name']) < 256) {
	    	$imagem_nome = time() . '_' . $_FILES['foto_perfil']['name'];
	    	$destino = ROOT_PATH . "/assets/images/" . $imagem_nome;

	    	$result = move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino);

	    	if ($result) {
	    		$_POST['foto_perfil'] = $imagem_nome;
	    	} else {
	    		array_push($errors, "Falha ao adicionar imagem");
	    	}
	    	

	    } else {
	    	if (strlen($_FILES['foto_perfil']['name']) > 255) {
			array_push($errors, "Nome da imagem muito longo");
			}
	    }

	   if (count($errors) === 0) {
	   	   $id = $_POST['id_usuario'];
	   	   unset($_POST['senhaConf'], $_POST['update-user-profile'], $_POST['id_usuario']);
		   $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

		   	$colaborador = $user['tipo_usuario'];
		   	$count = updateUser($table, $id, $_POST);

		   	$_SESSION['email'] = $_POST['email'];

		   	$_SESSION['nome_usuario'] = $_POST['nome_usuario'];

		   	$_SESSION['message'] = "Usuário editado com sucesso";

		   	$_SESSION['type'] = "success";

		   	header('location: ' . BASE_URL . '/user/index.php');
		   	exit();

	   } else {
	   		$id = $_POST['id_usuario'];
	   		$nome_completo = $_POST['nome_completo'];
	   		$nome_usuario = $_POST['nome_usuario'];
	   		$colaborador = $_SESSION['tipo_usuario'];
	   		$email = $_POST['email'];
	   		$senha = $_POST['senha'];
	   		$senhaConf = $_POST['senhaConf'];
	   }
}

/////

if (isset($_GET['edit_id_colaborador'])) {
	$user = selectOne($table, ['id_usuario' => $_GET['edit_id_colaborador']]);

	$id = $user['id_usuario'];
	$nome_completo = $user['nome_completo'];
	$nome_usuario = $user['nome_usuario'];
	$colaborador = $user['tipo_usuario'];
	$email = $user['email'];
}



if (isset($_GET['edit_id_leitor'])) {
	$user = selectOne($table, ['id_usuario' => $_GET['edit_id_leitor']]);

	$id = $user['id_usuario'];
	$nome_completo = $user['nome_completo'];
	$nome_usuario = $user['nome_usuario'];
	$colaborador = $user['tipo_usuario'];
	$email = $user['email'];
}


if (isset($_GET['edit_id_usuario'])) {
	$user = selectOne($table, ['id_usuario' => $_GET['edit_id_usuario']]);

	$id = $user['id_usuario'];
	$nome_completo = $user['nome_completo'];
	$nome_usuario = $user['nome_usuario'];
	$colaborador = $user['tipo_usuario'];
	$email = $user['email'];
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

//delete

if (isset($_GET['delete_id_colaborador'])) {
	adminOnly();
	$count = deleteUser($table, $_GET['delete_id_colaborador']);

	$_SESSION['message'] = "Colaborador deletado com sucesso";
	$_SESSION['type'] = "success";
	header('location: ' . BASE_URL . '/admin/users/index.php');
	exit();
}


if (isset($_GET['delete_id_leitor'])) {
	adminOnly();
	$count = deleteUser($table, $_GET['delete_id_leitor']);

	$_SESSION['message'] = "Leitor deletado com sucesso";
	$_SESSION['type'] = "success";
	header('location: ' . BASE_URL . '/admin/users/index.php');
	exit();
}


if (isset($_GET['delete_id_usuario']) &&  $_GET['delete_id_usuario'] == $_SESSION['id_usuario']) {
	usersOnly();
	$count = deleteUser($table, $_GET['delete_id_usuario']);

	$_SESSION['message'] = "Usuário deletado com sucesso";
	$_SESSION['type'] = "success";

	session_destroy();

	header('location: ' . BASE_URL . '/index.php');

	exit();

} elseif(isset($_GET['delete_id_usuario']) &&  $_GET['delete_id_usuario'] != $_SESSION['id_usuario']) {

	$_SESSION['message'] = 'Ação negada';
	$_SESSION['type'] = 'error';
	header('location: ' . BASE_URL . '/index.php');
	exit(0);

}



