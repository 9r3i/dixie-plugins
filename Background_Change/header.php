<?php
/* Plugin for Dixie CMS
 * Name     : Background Change
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : header.php
 */

/* function background change head style
 * @param : $string (free header string)
 */
function background_change_head_style($string){
  $css = '<link href="'.WWW.'plugins/Background_Change/bg_change.css" type="text/css" rel="stylesheet" />';
  return $string.$css;
}

/*************** Plugin registry into template *********************/
plugin_registry('background_change_head_style',array('post','index','type'),10,'header');