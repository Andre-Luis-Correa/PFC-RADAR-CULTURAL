<?php

function validatePost($comment)
{

   $errors = array();

   if (empty($comment['conteudo']))
   {
         array_push($errors, 'Comentário vazio');
   }

   if (!empty($comment['conteudo']) && strlen($comment['conteudo']) > 255){
      array_push($errors, 'Comentário muito longo');
   }

   return $errors;
}
