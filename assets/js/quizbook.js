(function($){
  $('#quizbook ul li .respuesta').on('click', function(){
    $(this).siblings().removeClass('seleccionada');
    $(this).addClass('seleccionada');

    $(this).siblings().removeAttr('data-seleccionada');
    $(this).attr('data-seleccionada', true);
  });

  $('#quizbook_enviar').on('submit', function(e){
    e.preventDefault();

    $('#quizbook_resultado').removeClass('aprobado desaprobado warning');

    var respuestas = $('[data-seleccionada]');
    var respuestas_ids = [];
    var total_preguntas = $('#quizbook ul li').length;

    $.each(respuestas, function(k, v){
      respuestas_ids.push(v.id);
    });

    if(respuestas_ids < total_preguntas){
      $('#quizbook_resultado').addClass('warning');
      $('#quizbook_resultado').html('Debes contestar todas las preguntas');
    }else{
      var datos = {
        action: 'quizbook_resultados',
        data: respuestas_ids
      };
  
      $.ajax({
        url: admin_url.ajax_url,
        type: 'post',
        data: datos
      })
      .done(function(response){
        var resultado_clase;
        if(response.puntaje > 60){
          resultado_clase = 'aprobado';
        }else{
          resultado_clase = 'desaprobado';
        }
  
        $('#quizbook_resultado').addClass(resultado_clase);
        $('#quizbook_resultado').html("Total: " + response.puntaje);
        $('#quizbook_btn_submit').remove();
      });
    }    
  });
})(jQuery);