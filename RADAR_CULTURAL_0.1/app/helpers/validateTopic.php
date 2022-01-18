<?php

function validateTopic($topic)
{

	$errors = array();

   if (empty($topic['nome']))
   {
   		array_push($errors, 'Nome obrigatório');
   }


   //$existingTopic = selectOne('tb_categoria', ['nome' => $topic['nome']]);
   //if ($existingTopic) {
     // array_push($errors, 'Nome de categoria já existente');
   //}

   $existingTopic = selectOne('tb_categoria', ['nome' => $post['nome']]);
   if ($existingTopic) {
      
      if (isset($post['update-topic']) && $existingTopic['id_categoria'] != $post['id_categoria']) {
         array_push($errors, 'Nome de categoria já existente');
      }

      if (isset($post['add-topic'])) {
         array_push($errors, 'Nome de categoria já existente');
      }
      
   }

   return $errors;
}