<?php
/* Plugin for Dixie CMS
 * Name     : Custom Menu
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : custom-menu.php
 */

$context = file_get_contents('plugins/custom-menu/style.css');
?>
<form action="" method="post">
<div style="padding-right:15px;">
  <textarea name="css-content" class="form-textarea"><?php print(htmlspecialchars($context)); ?></textarea>
</div>
<input type="hidden" value="true" name="custom-menu-action" />
<input type="hidden" value="edit-css" name="action" />
<input type="submit" value="Save" class="button" />
</form>
