$('a.add-toogle').click(function(){
    $($(this).data('target')).toggleClass('open');
});