$(document).ready(function(){
    $('.banner').slick({
        arrows: false,
        dots:true
    });
    $(".btnMobile").click(function(){    
        $(".menu-toogle").toggleClass("open");
    });

    $('.styled-file-select input[type=file]').change(function(e){
        $(this).parent('.styled-file-select').find('input[type=text]').val($(this).val().replace(/.*(\/|\\)/, ''));
    });
   
    if($("#tipo_pessoa").val() == 'juridica'){
        $(".juridica-box").css('display','flex');
        $(".fisica-box").css('display','none');
        $( ".fisica-box input" ).prop( "required", false );

    }else{
        $(".fisica-box").css('display','flex');
        $(".juridica-box").css('display','none');
        $( ".juridica-box input" ).prop( "required", false );
    }

});

function enviarFormularioFooter(){    
  //$body = $("#formFooter").serializeArray();
  var body = {};
  $("#formFooter").serializeArray().map(function(x){body[x.name] = x.value;});

  $action = $("#formFooter").data('action');

  $.ajax({
      method: "POST",
      url: $action,
      data: { body: body },
      beforeSend: function() {        
        $(".sabichao-help-box .overlay").addClass('show');
      },
      success: function(data) { 
        $(".sabichao-help-box .overlay").removeClass('show');
        $(".sabichao-help-box .search").empty();
        $(".sabichao-help-box .search").prepend("Sua mensagem foi enviada com sucesso!");
      }
  });   
  return false;
}


function enviarFormularioPadrao(){    
    $body = $("#formSend").serializeArray();
    $action = $("#formSend").data('action');


    $.ajax({
        method: "POST",
        url: $action,
        data: { body: $body },
        beforeSend: function() {           
        },
        success: function(data) { 
          
            const obj = JSON.parse(data);                      
            sendAlert(obj.alert,obj.message);
            setTimeout(function(){
               location.reload();
            },
            2000);                  
        }
    });   
    return false;
}

function enviarFormularioNewsletter(){    

    $body = $("#formSendNews").serializeArray();
    $action = $("#formSendNews").data('action');
   
    $.ajax({
        method: "POST",
        url: $action,
        data: { body: $body },
        beforeSend: function() {           
        },
        success: function(data) { 
            const obj = JSON.parse(data);                      
            sendAlert(obj.alert,obj.message);
            setTimeout(function(){
               location.reload();
            },
            2000);                  
        }
    });
    
    return false;
}

$('.galeria').slick({
    centerMode: true,  
    slidesToShow: 5,
    arrows:true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,         
          slidesToShow: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,         
          slidesToShow: 1
        }
      }
    ]
});


function sendAlert(tipo,mensagem) {
    $('#alertaReturn').addClass(tipo);
    $('#alertaReturn').prepend(mensagem);
    $('#alertaReturn').addClass("show");
    setTimeout(function() { 
        $('#alertaReturn').removeClass("show");
        $('#alertaReturn').removeClass(tipo);
        $('#alertaReturn').empty();
    }, 5000);
 }

 function buscaCep(cep) {

    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
        if (!("erro" in dados)) {
            $(".logradouro input").val(dados.logradouro );
            $(".bairro input").val(dados.bairro );
            $(".cidade input").val(dados.localidade);
            $(".uf input").val(dados.uf);
        } 
    });
}

$('.cep input[type="text"]').on('focusout',function(){
    buscaCep($(this).val());
});

jQuery('.telefone input[type="tel"]').on('focus', function() {

jQuery('.telefone input[type="tel"]').mask(maskBehavior, options);

});

jQuery('.telefone input[type="text"]').on('focus', function() {

jQuery('.telefone input[type="text"]').mask(maskBehavior, options);

});

jQuery('.data-nasc input[type="text"]').on('focus', function() {

    jQuery('.data-nasc input[type="text"]').mask('00/00');
    
});

jQuery('.cpf input[type="text"]').on('focus', function() {

    jQuery('.cpf input[type="text"]').mask('000.000.000-00');
    
});

jQuery('.cnpj input[type="text"]').on('focus', function() {

    jQuery('.cnpj input[type="text"]').mask('00.000.000/0000-00');
    
});

jQuery('.cep input[type="text"]').on('focus', function() {

jQuery('.cep input[type="text"]').mask('00000-000');

});

var maskBehavior = function(val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
options = {
    onKeyPress: function(val, e, field, options) {
        field.mask(maskBehavior.apply({}, arguments), options);
    }
};

$("#tipo_pessoa").change(function(){
    if($(this).val() == 'juridica'){
        $(".juridica-box").css('display','flex');
        $(".fisica-box").css('display','none');
        $( ".fisica-box input" ).prop( "required", false );
        
    }else{
        $(".fisica-box").css('display','flex');
        $(".juridica-box").css('display','none');    
        $( ".juridica-box input" ).prop( "required", false );   
    }
});

$("#qtde_responsaveis").change(function(){

    let qtde = $(this).val();
    $("#linhaInsertSocios").empty();

    var html = $("#linhaSocios").html();

    var margin = "<div class='row margin-bottom-30'></div>";

    for(i=0;i<qtde;i++){
        $("#linhaInsertSocios").append(html);
        $("#linhaInsertSocios").append(margin);
    }
});













// File Upload
// 
function ekUpload(){
    function Init() {
  
      console.log("Upload Initialised");
  
      var fileSelect    = document.getElementById('file-upload'),
          fileDrag      = document.getElementById('file-drag'),
          submitButton  = document.getElementById('submit-button');
  
      fileSelect.addEventListener('change', fileSelectHandler, false);
  
      // Is XHR2 available?
      var xhr = new XMLHttpRequest();
      if (xhr.upload) {
        // File Drop
        fileDrag.addEventListener('dragover', fileDragHover, false);
        fileDrag.addEventListener('dragleave', fileDragHover, false);
        fileDrag.addEventListener('drop', fileSelectHandler, false);
      }
    }
  
    function fileDragHover(e) {
      var fileDrag = document.getElementById('file-drag');
  
      e.stopPropagation();
      e.preventDefault();
  
      fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
    }
  
    function fileSelectHandler(e) {
      // Fetch FileList object
      var files = e.target.files || e.dataTransfer.files;
  
      // Cancel event and hover styling
      fileDragHover(e);
  
      // Process all File objects
      for (var i = 0, f; f = files[i]; i++) {
        parseFile(f);
        uploadFile(f);
      }
    }
  
    // Output
    function output(msg) {
      // Response
      var m = document.getElementById('messages');
      m.innerHTML = msg;
    }
  
    function parseFile(file) {
  
      console.log(file.name);
      output(
        '<strong>' + encodeURI(file.name) + '</strong>'
      );
      
      // var fileType = file.type;
      // console.log(fileType);
      var imageName = file.name;
  
      var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
      if (isGood) {
        document.getElementById('start').classList.add("hidden");
        document.getElementById('response').classList.remove("hidden");
        document.getElementById('notimage').classList.add("hidden");
        // Thumbnail Preview
        document.getElementById('file-image').classList.remove("hidden");
        document.getElementById('file-image').src = URL.createObjectURL(file);
      }
      else {
        document.getElementById('file-image').classList.add("hidden");
        document.getElementById('notimage').classList.remove("hidden");
        document.getElementById('start').classList.remove("hidden");
        document.getElementById('response').classList.add("hidden");
        document.getElementById("file-upload-form").reset();
      }
    }
  
    function setProgressMaxValue(e) {
      var pBar = document.getElementById('file-progress');
  
      if (e.lengthComputable) {
        pBar.max = e.total;
      }
    }
  
    function updateFileProgress(e) {
      var pBar = document.getElementById('file-progress');
  
      if (e.lengthComputable) {
        pBar.value = e.loaded;
      }
    }
  
    function uploadFile(file) {
  
      var xhr = new XMLHttpRequest(),
        fileInput = document.getElementById('class-roster-file'),
        pBar = document.getElementById('file-progress'),
        fileSizeLimit = 1024; // In MB
      if (xhr.upload) {
        // Check if file is less than x MB
        if (file.size <= fileSizeLimit * 1024 * 1024) {
          // Progress bar
          pBar.style.display = 'inline';
          xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
          xhr.upload.addEventListener('progress', updateFileProgress, false);
  
          // File received / failed
          xhr.onreadystatechange = function(e) {
            if (xhr.readyState == 4) {
              // Everything is good!
  
              // progress.className = (xhr.status == 200 ? "success" : "failure");
              // document.location.reload(true);
            }
          };
  
          // Start upload
        //   xhr.open('POST', document.getElementById('file-upload-form').action, true);
        //   xhr.setRequestHeader('X-File-Name', file.name);
        //   xhr.setRequestHeader('X-File-Size', file.size);
        //   xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        //   xhr.send(file);
        } else {
          output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
        }
      }
    }
  
    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
      Init();
    } else {
      document.getElementById('file-drag').style.display = 'none';
    }
}
  ekUpload();