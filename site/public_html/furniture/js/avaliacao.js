$("#llms_start_quiz_2").on('submit', function(e){

    e.preventDefault();
    var form = $(this).serialize();
   
    $.ajax({
        method: "POST",
        url: '/salvar-avaliacao',
        data: {valor:100, currenttimeuser : 0, user_id: $('.user_id').val(), object_id: $('.object_id').val(),type:$('.type').val(), form: form },
        beforeSend: function() {},
        success: function(data) {    
           var result = JSON.parse(data);    
        //    console.log(result);
           location.href='/conteudo-treinamento/'+result.course_slug+'/result/'+result.tests_id;        
        }
    });

});


$("#llms-quiz-attempt-select").on('change', function(){
     $.redirect($(this).data('url'), {
        attempt_select: $(this).val(),
     });
});