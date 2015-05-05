<?php
/* Plugin for Dixie CMS
 * Name     : Website Contact
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : admin-header.php
 */

function web_contact_print_header($content){
  $content .= '<link href="'.WWW.'plugins/web-contact/style.css?v=1.0" type="text/css" rel="stylesheet" />';
  return $content;
}

/* Plugin registry into admin templates */
if(defined('Q')&&Q=='web-contact-review'){
  plugin_registry('web_contact_print_header',array('admin'),11,'admin-header');
}