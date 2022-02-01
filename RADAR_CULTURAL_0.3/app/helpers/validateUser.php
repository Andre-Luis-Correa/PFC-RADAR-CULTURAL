<?php

function validateUser($user)
{

	$errors = array();

   if (empty($user['nome_completo']))
   {
   		array_push($errors, 'Nome completo obrigatório');
   }

   if (!empty($user['nome_completo']) && strlen($user['nome_completo']) < 6)
   {
         array_push($errors, 'Nome completo muito curto');
   }

   if (!empty($user['nome_completo']) && strlen($user['nome_completo']) > 255)
   {
         array_push($errors, 'Nome completo muito longo');
   }

   if (empty($user['nome_usuario']))
   {
   		array_push($errors, 'Nome de usuário obrigatório');
   }

   if (!empty($user['nome_usuario']) && strlen($user['nome_usuario']) < 6)
   {
         array_push($errors, 'Nome de usuário muito curto');
   }

   if (!empty($user['nome_usuario']) && strlen($user['nome_usuario']) > 20)
   {
         array_push($errors, 'Nome de usuário muito longo');
   }

   if (empty($user['email']))
   {
   		array_push($errors, 'Email obrigatório');
   }

   if (strlen($user['email']) > 255)
   {
         array_push($errors, 'Email muito longo');
   }

   if (empty($user['senha']))
   {
         array_push($errors, 'Senha obrigatória');
   }

   if (!empty($user['senha']) && strlen($user['senha']) < 6)
   {
         array_push($errors, 'Senha deve conter no mínimo 6 caracteres');
   }

   if (!empty($user['senha']) && strlen($user['senha']) > 255)
   {
         array_push($errors, 'Senha muito longa');
   }


   if ($user['senhaConf'] !== $user['senha'])
   {
   		array_push($errors, 'Senhas não se combinam');
   }


   $existingEmail = selectOne('tb_usuario', ['email' => $user['email']]);
   $existingUsername = selectOne('tb_usuario', ['nome_usuario' => $user['nome_usuario']]);

   if ($existingEmail || $existingUsername) {
      
      if (isset($user['update-user']) && isset($existingEmail['id_usuario'])) {
         if ($existingEmail['id_usuario'] != $user['id_usuario']) {
            array_push($errors, 'Email já existente');
         }
      }


      if (isset($user['update-user']) && isset($existingUsername['id_usuario'])) {
         if ($existingUsername['id_usuario'] != $user['id_usuario']) {
            array_push($errors, 'Nome de usuário já existente 1');
         }
      } 


      if (isset($user['create-admin']) || isset($user['register-btn'])) {
         if($existingEmail){
            array_push($errors, 'Email já existente');
         }
         if ($existingUsername) {
            array_push($errors, 'Nome de usuário já existente');
         }
      }
      
   }


   return $errors;
}


function validateLogin($user)
{

   $errors = array();

   if (empty($user['nome_usuario']))
   {
         array_push($errors, 'Nome de usuário obrigatório');
   }


   if (empty($user['senha']))
   {
         array_push($errors, 'Senha obrigatória');
   }

   return $errors;
}