<?php

function validateTopic($topic)
{

	$errors = array();

   if (empty($topic['nome']))
   {
   		array_push($errors, 'Nome obrigatório');

   } 

   if (strlen($topic['nome']) > 100){
         array_push($errors, 'Nome muito longo');

   }


   $existingTopic = selectOne('tb_categoria', ['nome' => $topic['nome']]);

   if ($existingTopic) {
      
      if (isset($topic['update-topic']) && $existingTopic['id_categoria'] != $topic['id_categoria']) {
         array_push($errors, 'Nome de categoria já existente');
      }

      if (isset($topic['add-topic'])) {
         array_push($errors, 'Nome de categoria já existente');
      }
      
   }

   return $errors;
}