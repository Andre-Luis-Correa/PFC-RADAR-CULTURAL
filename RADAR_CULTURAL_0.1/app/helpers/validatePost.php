<?php

function validatePost($post)
{

	$errors = array();

   if (empty($post['titulo']))
   {
   		array_push($errors, 'Título obrigatório');
   }

   if (empty($post['resumo']))
   {
   		array_push($errors, 'Resumo obrigatório');
   }

   if (empty($post['conteudo']))
   {
   		array_push($errors, 'Conteúdo obrigatório');
   }

   if (empty($post['fk_id_categoria']))
   {
   		array_push($errors, 'Por favor, selecione a categoria');
   }

   $existingPost = selectOne('tb_publicacao', ['titulo' => $post['titulo']]);
   if ($existingPost) {
      
      if (isset($post['update-post']) && $existingPost['id_publicacao'] != $post['id_publicacao']) {
         array_push($errors, 'Publicação já existente com esse título');
      }

      if (isset($post['add-post'])) {
         array_push($errors, 'Publicação já existente com esse título');
      }
      
   }

   return $errors;
}
