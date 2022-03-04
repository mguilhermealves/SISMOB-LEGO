<?php
print('<script>'."\n");
print('jQuery("#select_paginage").bind("change",function(){'."\n");
print('    jQuery("#frm_filter input[name=\'sr\']").val( 0 ) ;'."\n");
print('    jQuery("#frm_filter input[name=\'paginate\']").val( jQuery("option:selected",this).val() ) ;'."\n");
print('    jQuery("#frm_filter").submit();'."\n");
print('})'."\n");

if( $info["sr"] > 0 ){
  print('jQuery("#btn_sr_first").bind("click", function(){ '."\n");
  print('    jQuery("#frm_filter input[name=\'sr\']").val( 0 ) ;'."\n");
  print('    jQuery("#frm_filter").submit();'."\n");
  print('})'."\n");
}
else{
  print('jQuery("#btn_sr_first").remove()'."\n");
}
if( $info["sr"] > 0 ){
  print('jQuery("#btn_sr_previus").bind("click", function(){ '."\n");
  print('    jQuery("#frm_filter input[name=\'sr\']").val( ' . ( $info["sr"] - $paginate ) . ' ) ;'."\n");
  print('    jQuery("#frm_filter").submit();'."\n");
  print('})'."\n");
}
else{
  print('jQuery("#btn_sr_previus").remove()'."\n");
}
if( $total  > $info["sr"] + $paginate ){
  print('jQuery("#btn_sr_next").bind("click", function(){ '."\n");
  print('    jQuery("#frm_filter input[name=\'sr\']").val( ' . ( $info["sr"] + $paginate ) . ' ) ;'."\n");
  print('    jQuery("#frm_filter").submit();'."\n");
  print('})'."\n");
}
else{
  print('jQuery("#btn_sr_next").remove()'."\n");
}
if( $info["sr"] < $total  - $paginate ){
  print('jQuery("#btn_sr_last").bind("click", function(){ '."\n");
  print('    jQuery("#frm_filter input[name=\'sr\']").val( ' . ( $total  - $paginate ) . ' ) ;'."\n");
  print('    jQuery("#frm_filter").submit();'."\n");
  print('})'."\n");
}
else{
  print('jQuery("#btn_sr_last").remove()'."\n");
}
print('jQuery("a[id^=\'btn_remove_\']").bind("click", function(){ '."\n");
print('  var target = jQuery(this);'."\n");
print('  if( confirm("Confirma a exclusão do item ?") ){'."\n");
print('      $.ajax({'."\n");
print('          type: "POST",'."\n");
print('          url:jQuery(target).attr("href")'."\n");
print('          , data: { "btn_remove": "yes" } '."\n");
print('          , success: function(){'."\n");
print('            jQuery(jQuery(target).closest("tr")).remove()'."\n");
print('          }'."\n");
print('      })'."\n");
print('  }'."\n");
print('  return false;'."\n");
print('})'."\n");
print('</script>'."\n");
?>