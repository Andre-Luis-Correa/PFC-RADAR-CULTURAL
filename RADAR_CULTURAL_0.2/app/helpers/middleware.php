<?php

function usersOnly($redirect = '/index.php'){
	if (empty($_SESSION['id_usuario'])) {
		$_SESSION['message'] = 'Necessário login para acessar';
		$_SESSION['type'] = 'error';
		header('location: ' . BASE_URL . $redirect);
		exit(0);
	}
}

function adminOnly($redirect = '/index.php'){
	if (empty($_SESSION['id_usuario']) || empty($_SESSION['tipo_usuario'])) {
		$_SESSION['message'] = 'Acesso não autorizado';
		$_SESSION['type'] = 'error';
		header('location: ' . BASE_URL . $redirect);
		exit(0);
	}
}

function guestsOnly($redirect = '/index.php'){
	if (isset($_SESSION['id_usuario'])) {
		header('location: ' . BASE_URL . $redirect);
		exit(0);
	}
}