<script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'pt-br',
    initialView: 'dayGridMonth',

    eventClick: function(arg) {
        console.log(arg.event._def.publicId);   
        location.href='evento-agenda/'+arg.event._def.publicId;                     
    },
    
    events: [

        <?php foreach($agendas->data as $k=>$v){ ?>                
                {
                    id    : '<?php echo $v["slug"] ?>',
                    title  : '<?php echo $v["title"] ?>',
                    start  : '<?php echo date_format(new DateTime($v["date_event"]), 'Y-m-d'); ?>'
                },
        <?php } ?>
            
            
        ]
    });
    calendar.render();
    });

</script>