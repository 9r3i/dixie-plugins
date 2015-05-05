<?php
/* Plugin for Dixie CMS
 * Name     : Background Change
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : footer.php
 */

/* function background change
 * @param : $string (free footer string)
 */
function background_change($string){
  $dir = get_plugin_option('Background_Change','directory');
  $explore = background_change_find_jpeg(dixie_explore('file',$dir));
  if(get_plugin_option('Background_Change','shuffle')=='yes'){
    shuffle($explore);
  }
  $json = '<script type="text/javascript">var bgcs = '.json_encode($explore).';</script>';
  $js = '<script src="'.WWW.'plugins/Background_Change/bg_change.js" type="text/javascript"></script>';
  return $string.$json.$js;
}

/*************** Plugin registry into template *********************/
if(get_plugin_option('Background_Change','active')=='yes'){
  plugin_registry('background_change',array('post','index','type'),10,'footer');
}


function background_change_find_jpeg($array){
  $hasil = array();
  if(is_array($array)){
    foreach($array as $ar){
      if(preg_match('/\.jpg|\.jpeg/i',$ar)){
        $hasil[] = $ar;
      }
    }
  }
  return $hasil;
}