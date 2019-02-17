<?php
if(!defined('ABSPATH')) exit;

/**
 * Procesamiento AJAX para validar respuestas
 */
function quizbook_resultados(){
  if(isset($_POST["data"])){
    $respuestas = $_POST["data"];
    $correctas = 0;

    foreach($respuestas as $r){
      list($pregunta_id, $respuesta_seleccionada) = explode(":", $r);

      $correcta = get_post_meta($pregunta_id, 'quizbook_correcta', true);
      $respuesta_correcta = end(explode(":", $correcta));

      if($respuesta_seleccionada === $respuesta_correcta){
        $correctas++;
      }
    }

    $puntaje = $correctas / count($respuestas) * 100;
  }

  $respuesta = array(
    'puntaje' => $puntaje
  );

  header('Content-type: application-json');
  echo json_encode($respuesta);
  die();
}
add_action('wp_ajax_nopriv_quizbook_resultados', 'quizbook_resultados');  // Habilito para deslogueados
add_action('wp_ajax_quizbook_resultados', 'quizbook_resultados');         // Habilito para logueados