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

/**
 * Auxiliar para agregar columas personalizadas en el orden deseado
 */
function array_insert( $array, $index, $insert ) {
  return array_slice( $array, 0, $index, true ) + $insert +
  array_slice( $array, $index, count( $array ) - $index, true);
}