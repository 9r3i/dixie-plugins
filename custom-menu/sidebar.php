<?php
/* Plugin for Dixie CMS
 * Name     : Custom Menu
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : sidebar.php
 */


require_once('extension/functions.php');

/* Plugin registry into all templates */
plugin_registry('custom_menu_sidebar_print',array('post','index','search','404','type'),11,'sidebar');
