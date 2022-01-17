<?php

function validateTopic($topic)
{

	$errors = array();

   if (empty($topic['nome']))
   {
   		array_push($errors, 'Nome obrigatório');
   }


   $existingTopic = selectOne('tb_categoria', ['nome' => $topic['nome']]);
   if ($existingTopic) {
      array_push($errors, 'Nome de categoria já existente');
   }

   return $errors;
}