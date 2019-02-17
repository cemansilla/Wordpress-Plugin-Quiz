<?php
if(!defined('ABSPATH')) exit;

/**
 * Funcionalidad de shortcode
 * Modo de uso:  [quizbook cantidad="1" orden="rand"]
 */
function quizbook_shortcode( $atts ) {
  // Valores por defecto
  $posts_per_page = (isset($atts["cantidad"])) ? $atts["cantidad"] : 5;
  $orderby = (isset($atts["orden"])) ? $atts["orden"] : 'date';

  $args = array(
    "post_type" => "quizes",
    "posts_per_page" => $posts_per_page,
    "orderby" => $orderby
  );
  $quizbook = new WP_Query($args);

  ob_start();
  ?>
  <form name="quizbook_enviar" id="quizbook_enviar">
    <div id="quizbook" class="quizbook">
      <ul>
        <?php while($quizbook->have_posts()): $quizbook->the_post(); ?>
        <li>
          <?php the_title('<h2>', '</h2>'); ?>
          <?php the_content(); ?>
          <?php
          $opciones = get_post_meta(get_the_ID());
          foreach($opciones as $k => $v){
            if(quizbook_filter_questions($k) === 0){
              $numero = end(explode("_", $k));
              ?>
              <div id="<?php echo get_the_ID() . ":" . $numero; ?>">
                <?php echo $v[0]; ?>
              </div>
              <?php
            }
          }
          ?>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
      </ul>
    </div>
  </form>
  <?php
  $html = ob_get_contents();
  ob_end_clean();

  return $html;
}
add_shortcode( 'quizbook', 'quizbook_shortcode' );