<?php
if(!defined('ABSPATH')) exit;

/**
 * Filtra consulta de metabox para no mostrar valores que no correspondan a los creados por nosotros
 */
function quizbook_filter_questions($key){
  return strpos($key, 'qb_');
}

/**
 * Dump preformateado
 */
function d($el){
  echo "<pre>"; print_r($el); echo "</pre>";
}