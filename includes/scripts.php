<?php
if(!defined('ABSPATH')) exit;

function quizbook_frontend_scripts(){
  wp_enqueue_style('quibooks_css', plugins_url('../assets/css/quizbook.css', __FILE__));
  wp_enqueue_script('quizbook_js', plugins_url('../assets/js/quizbook.js', __FILE__), array('jquery'), '1.0.0', true);

  wp_localize_script('quizbook_js', 'admin_url', array(
    'ajax_url' => admin_url('admin-ajax.php')
  ));
}
add_action('wp_enqueue_scripts', 'quizbook_frontend_scripts');

function quizbook_backend_scripts($hook){
  global $post;

  if($hook == 'post-new.php' || $hook == 'post.php'){
    if($post->post_type == 'quizes'){
      wp_enqueue_style('quibooks_backend_css', plugins_url('../assets/css/backend-quizbook.css', __FILE__));
    }    
  }
}
add_action('admin_enqueue_scripts', 'quizbook_backend_scripts');