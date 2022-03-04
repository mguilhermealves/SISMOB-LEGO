var iframe = jQuery('#videoSingle');
var player = new Vimeo.Player(iframe);

const progress = document.getElementById("progress");
//button = document.getElementById("botaoVideoSingle");
const videointerna = player;
var vdo_play = false;




$(function(){
    player.getDuration().then(function(duration) {
        var currenttimeuser = localStorage.getItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso'));
       
        if ($('.complete').val() || currenttimeuser >= duration) {            
            player.setCurrentTime(0);
            if($('.complete').val()){
                progress.style.width = "100%";
                progress.innerText =  "100%";
                localStorage.removeItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso'));
            }
        } else {
            
                player.setCurrentTime(localStorage.getItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso')));
                progress.style.width = Math.round((currenttimeuser / duration) * 100)+"%";
                progress.innerText =  Math.round((currenttimeuser / duration) * 100)+"%";            
        }
    });
});

player.on('play', function() {

    player.getDuration().then(function(duration) {
        var currenttimeuser = localStorage.getItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso'));
        if ($('.complete').val() || currenttimeuser >= duration) {          
            player.setCurrentTime(0);
        } else {
            player.setCurrentTime(localStorage.getItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso')));
        }
    });

    if (vdo_play) { clearInterval(vdo_play); }
    vdo_play = setInterval(function() {

        player.getCurrentTime().then(function(seconds) {
            player.getDuration().then(function(duration) {
                if($('.complete').val()){}else{
                progress.style.width = Math.round((seconds / duration) * 100)+"%";
                progress.innerText =  Math.round((seconds / duration) * 100)+"%";
                localStorage.setItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso'), seconds);                
                }
            });
        });

        player.on('ended', function() {
            clearInterval(vdo_play);              
        });

        player.on('pause', function() {
            clearInterval(vdo_play);               
        });
    });
});

player.on('pause', function() {
    saveProgress(player);
});

player.on('ended', function() {  
    saveProgress(player);          
});

function progressLoop(ponto) {
    const interval = setInterval(function() {
        player.getCurrentTime().then(function(seconds) {         
        });
        progress.value = Math.round((player.getCurrentTime() / player.getDuration()) * 100);  
        progress.style.width = Math.round((seconds / duration) * 100)+"%";   
        progress.innerText =  Math.round((seconds / duration) * 100)+"%";   
        localStorage.setItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso'), player.getCurrentTime());
    });
}

function playPause() {
    if (player.paused) {
        var currenttimeuser = localStorage.getItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso'));
        if (player.duration == currenttimeuser) {
            player.setCurrentTime(0);
        } else {
            player.setCurrentTime(localStorage.getItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso')));
        }
        player.play();
    } else {
        player.pause();
        saveProgress(player);
    }
}


function onclosemodal() {
    player.pause();
    saveProgress(player);
}

function exitFullScreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    }
}

function toggleFullScreen() {
    //var player = document.getElementById("player");

    if (player.requestFullscreen)
        if (document.fullScreenElement) {
            document.cancelFullScreen();
        } else {
            player.requestFullscreen();
        }
    else if (player.msRequestFullscreen)
        if (document.msFullscreenElement) {
            document.msExitFullscreen();
        } else {
            player.msRequestFullscreen();
        }
    else if (player.mozRequestFullScreen)
        if (document.mozFullScreenElement) {
            document.mozCancelFullScreen();
        } else {
            player.mozRequestFullScreen();
        }
    else if (player.webkitRequestFullscreen)
        if (document.webkitFullscreenElement) {
            document.webkitCancelFullScreen();
        } else {
            player.webkitRequestFullscreen();
        }
    else {
        alert("Fullscreen API is not supported");
    }
}


save_play = setInterval(function() { 
    player.getPaused().then(function(paused) {
        if(!paused){
            saveProgress(player);
        }
    });  
},15000);

function saveProgress(player) {     
    player.getDuration().then(function(seconds) {
        var duration = seconds;
        var currenttimeuser = localStorage.getItem('solarisprogressVideoEmbed_' + jQuery('#videoSingle').data('idcurso'));    
        var valor =  Math.round((currenttimeuser / duration) * 100);   
        if(!$('.complete').val()){    
            $.ajax({
                method: "POST",
                url: '/salvar-progresso',
                data: {valor:valor, currenttimeuser : currenttimeuser, user_id: $('.user_id').val(), object_id: $('.object_id').val(),type:$('.type').val() },
                beforeSend: function() {},
                success: function(data) {      
                    
                }
            });
        }
    });     
}

// volumeBar.addEventListener("change", function(evt) {
//     videointerna.volume = evt.target.value;
// });