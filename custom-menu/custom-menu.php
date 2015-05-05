<?php
/* Plugin for Dixie CMS
 * Name     : Custom Menu
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : custom-menu.php
 */

require_once('extension/functions.php');

$table = 'custom_menu';
custom_menu_check_table($table);

$get_menus = custom_menu_get_data_menu($table);

$part = (isset($_GET['part']))?$_GET['part']:'';

$menus = array('menus','create','CSS');

$structure = custom_menu_get_data_structure($table);


?>
<div class="custom-menu-menu">
<?php
foreach($menus as $menu){
  echo '<a href="?part='.$menu.'"><div class="custom-menu-menu-list">'.ucwords($menu).'</div></a>';
}
?>
</div>
<div class="custom-menu">
<?php
if($part=='create'){
  include_once('extension/create.php');
}elseif($part=='edit'){
  include_once('extension/edit.php');
}elseif($part=='CSS'){
  include_once('extension/css.php');
}else{
  echo (count($get_menus)>0)?'<div>Click menu to edit</div>':'<div>Doesn\'t have a menu yet</div>';
  echo '<div id="custom_menu" style="padding:15px 5px;width:auto;">';
  echo custom_menu_data_print($structure);
  echo '</div>';
}
?>
</div>

<!--<pre><?php print_r($structure); ?></pre>-->


























