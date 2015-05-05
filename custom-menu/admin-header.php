<?php
/* Plugin for Dixie CMS
 * Name     : Custom Menu
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : admin-header.php
 */

require_once('extension/functions.php');

/* Plugin registry into admin templates */
if(defined('Q')&&Q=='custom-menu'){
  plugin_registry('custom_menu_print_data_header',array('admin'),11,'admin-header');
}