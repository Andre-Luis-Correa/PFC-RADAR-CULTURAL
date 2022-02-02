<?php

function validatePost($post)
{

	$errors = array();

   if (empty($post['titulo']))
   {
   		array_push($errors, 'Título obrigatório');
   }

   if (!empty($post['titulo']) && strlen($post['titulo']) < 10){
      array_push($errors, 'Título muito curto');
   }

   if (!empty($post['titulo']) &&  strlen($post['titulo']) > 100){
      array_push($errors, 'Título muito longo');
   }

   if (empty($post['resumo']))
   {
   		array_push($errors, 'Resumo obrigatório');
   }

   if (!empty($post['resumo']) && strlen($post['resumo']) < 20){
      array_push($errors, 'Resumo muito curto');
   }

   if (!empty($post['resumo']) && strlen($post['resumo']) > 255){
      array_push($errors, 'Resumo muito longo');
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
