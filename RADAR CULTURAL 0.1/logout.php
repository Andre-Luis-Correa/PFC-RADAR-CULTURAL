<?php

session_start();

unset($_SESSION['id_usuario']);

unset($_SESSION['nome_usuario']);

unset($_SESSION['tipo_usuario']);

unset($_SESSION['message']);

unset($_SESSION['type']);

session_destroy();

header('location: index.php');