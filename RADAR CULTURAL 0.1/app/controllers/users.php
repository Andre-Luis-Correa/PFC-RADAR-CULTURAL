<?php

include("app/database/db.php");

if(isset($_POST['register-btn'])){
   unset($_POST['register-btn'], $_POST['senhaConf']);
   $_POST['tipo_usuario'] = 0;

   $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

   //$user_id = create('tb_usuario', $_POST);
   //$user = selectOne('tb_usuario', ['id_usuario' => $user_id]);
   
   dd($_POST);

   //dd($_POST);
}



