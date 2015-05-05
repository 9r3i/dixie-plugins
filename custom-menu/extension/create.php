<?php
/* Plugin for Dixie CMS
 * Name     : Custom Menu
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : create.php // extension
 */

$table = 'custom_menu';
$get_menus = custom_menu_get_data_menu($table);
$data_input = array('name','title','uri');
?>
<form action="" method="post">
  <?php foreach($data_input as $menu){ ?>
  <div class="custom-menu-input-each">
    <div class="custom-menu-input-label"><?php print(ucwords($menu)); ?>:</div>
    <div class="custom-menu-input-point">
      <input type="text" name="<?php print($menu); ?>" class="custom-menu-input-input" placeholder="<?php print(ucwords($menu)); ?>" />
    </div>
  </div>
  <?php } ?>

  <div class="custom-menu-input-each">
    <div class="custom-menu-input-label">Target:</div>
    <div class="custom-menu-input-point">
      <select name="target" class="custom-menu-input-input">
        <option value="">none</option>
        <option value="_top">_top</option>
        <option value="_parent">_parent</option>
        <option value="_self">_self</option>
        <option value="_blank">_blank</option>
      </select>
    </div>
  </div>
  <div class="custom-menu-input-each">
    <div class="custom-menu-input-label">Parent:</div>
    <div class="custom-menu-input-point">
      <select name="parent" class="custom-menu-input-input">
        <option value="0">none</option>
        <?php foreach($get_menus as $id=>$menu){echo '<option value="'.$id.'">'.$menu['name'].'</option>';} ?>
      </select>
    </div>
  </div>
  <div class="custom-menu-input-each">
    <div class="custom-menu-input-label">Order:</div>
    <div class="custom-menu-input-point">
      <select name="order" class="custom-menu-input-input">
        <?php for($r=10;$r<100;$r++){echo '<option value="'.$r.'">'.$r.'</option>';} ?>
      </select>
    </div>
  </div>
  <div class="custom-menu-input-each">
    <div class="custom-menu-input-label"></div>
    <div class="custom-menu-input-point">
      <input type="submit" value="Create" class="button" />
      <input type="hidden" value="true" name="custom-menu-action" />
      <input type="hidden" value="create" name="action" />
    </div>
  </div>
</form>