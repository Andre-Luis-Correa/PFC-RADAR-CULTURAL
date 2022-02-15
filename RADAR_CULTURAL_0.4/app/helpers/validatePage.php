<?php

function validatePage($page)
{

	$errors = array();

   if (empty($page['titulo']))
   {
   		array_push($errors, 'Título obrigatório');

   } 

   if (!empty($page['titulo']) && strlen($page['titulo']) < 2){
         array_push($errors, 'Título muito curto');

   }

   if (strlen($page['titulo']) > 20){
         array_push($errors, 'Título muito longo');

   }

   if (empty($page['conteudo']))
   {
         array_push($errors, 'Conteúdo obrigatório');
   }


   $existingPage = selectOne('tb_pagina', ['titulo' => $page['titulo']]);

   if ($existingPage) {
      
      if (isset($page['update-page']) && $existingPage['id_pagina'] != $page['id_pagina']) {
         array_push($errors, 'Página já existente com esse título');
      }

      if (isset($page['add-page'])) {
         array_push($errors, 'Página já existente com esse título');
      }
      
   }

   return $errors;
}