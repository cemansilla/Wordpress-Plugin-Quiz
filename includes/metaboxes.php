<?php
if(!defined('ABSPATH')) exit;

/**
 * Agrego metabox al CPT quizes
 */
function quizbook_add_metaboxes(){
  add_meta_box('quizbook_meta_box', 'Respuestas', 'quizbook_metaboxes', 'quizes', 'normal', 'high', null);
}
add_action('add_meta_boxes', 'quizbook_add_metaboxes');

/**
 * Contenido / formulario del CPT quizes
 */
function quizbook_metaboxes($post){
  wp_nonce_field(basename(__FILE__), 'quizbook_nonce');
  ?>
  <table class="form-table">
    <tr>
      <th class="row-title">
        <h2>Añade las respuestas aquí</h2>
      </th>
    </tr>
    <tr>
      <th class="row-title">
        <label for="respuesta_1">a)</label>
      </th>
      <td>
        <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_1', true)); ?>" type="text" name="qb_respuesta_1" id="respuesta_1" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th class="row-title">
        <label for="respuesta_2">b)</label>
      </th>
      <td>
        <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_2', true)); ?>" type="text" name="qb_respuesta_2" id="respuesta_2" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th class="row-title">
        <label for="respuesta_3">c)</label>
      </th>
      <td>
        <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_3', true)); ?>" type="text" name="qb_respuesta_3" id="respuesta_3" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th class="row-title">
        <label for="respuesta_4">d)</label>
      </th>
      <td>
        <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_4', true)); ?>" type="text" name="qb_respuesta_4" id="respuesta_4" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th class="row-title">
        <label for="respuesta_5">e)</label>
      </th>
      <td>
        <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_5', true)); ?>" type="text" name="qb_respuesta_5" id="respuesta_5" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th class="row-title">
        <label for="respuesta_correcta">Respuesta correcta</label>
      </th>
      <td>
        <?php $respuesta = esc_html(get_post_meta($post->ID, 'quizbook_correcta', true)); ?>
        <select name="quizbook_correcta" id="respuesta_correcta" class="postbox">
          <option value="">Elige la respuesta correcta</option>
          <option <?php selected($respuesta, 'qb_correcta:a'); ?> value="qb_correcta:a">a</option>
          <option <?php selected($respuesta, 'qb_correcta:b'); ?> value="qb_correcta:b">b</option>
          <option <?php selected($respuesta, 'qb_correcta:c'); ?> value="qb_correcta:c">c</option>
          <option <?php selected($respuesta, 'qb_correcta:d'); ?> value="qb_correcta:d">d</option>
          <option <?php selected($respuesta, 'qb_correcta:e'); ?> value="qb_correcta:e">e</option>
        </select>
      </td>
    </tr>
  </table>
  <?php
}

/**
 * Almacenamiento de metaboxes de quizes
 */
function quizbook_save_metaboxes($post_id, $post, $update){
  // Validación de seguridad con nonce
  if(!isset($_POST['quizbook_nonce']) || !wp_verify_nonce($_POST['quizbook_nonce'], basename(__FILE__))){
    return $post_id;
  }

  // Validación de seguridad con permisos de usuario
  if(!current_user_can('edit_post', $post_id)){
    return $post_id;
  }

  // Validación de seguridad evitando autoguardado
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
    return $post_id;
  }

  $respuesta_1 = $respuesta_2 = $respuesta_3 = $respuesta_4 = $respuesta_5 = $respuesta_correcta = '';

  if(isset($_POST['qb_respuesta_1'])){
    $respuesta_1 = sanitize_text_field($_POST['qb_respuesta_1']);
  }
  update_post_meta($post_id, 'qb_respuesta_1', $respuesta_1);

  if(isset($_POST['qb_respuesta_2'])){
    $respuesta_2 = sanitize_text_field($_POST['qb_respuesta_2']);
  }
  update_post_meta($post_id, 'qb_respuesta_2', $respuesta_2);

  if(isset($_POST['qb_respuesta_3'])){
    $respuesta_3 = sanitize_text_field($_POST['qb_respuesta_3']);
  }
  update_post_meta($post_id, 'qb_respuesta_3', $respuesta_3);

  if(isset($_POST['qb_respuesta_4'])){
    $respuesta_4 = sanitize_text_field($_POST['qb_respuesta_4']);
  }
  update_post_meta($post_id, 'qb_respuesta_4', $respuesta_4);

  if(isset($_POST['qb_respuesta_5'])){
    $respuesta_5 = sanitize_text_field($_POST['qb_respuesta_5']);
  }
  update_post_meta($post_id, 'qb_respuesta_5', $respuesta_5);

  if(isset($_POST['quizbook_correcta'])){
    $respuesta_correcta = sanitize_text_field($_POST['quizbook_correcta']);
  }
  update_post_meta($post_id, 'quizbook_correcta', $respuesta_correcta);
}
add_action('save_post', 'quizbook_save_metaboxes', 10, 3);