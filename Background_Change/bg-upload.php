<?php
/* Plugin for Dixie CMS
 * Name     : Background Change
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : bg-upload.php
 */

global $plugin_name;
$url = WWW.'admin/plugin-option/?name='.$plugin_name.'&bg-upload';

if(isset($_FILES['file'])){
  $files = rearrange_files($_FILES['file']);
  foreach($files as $file){
    if($file['error']==0){
      @move_uploaded_file($file['tmp_name'],get_plugin_option($plugin_name,'directory').'/'.$file['name']);
    }
  }
  header('location: '.$url.'&status=success-uploaded');
  exit;
}
  if(isset($_GET['status'])&&$_GET['status']=='success-uploaded'){
    $write_status = 'Uploaded!'; 
  }elseif(isset($_GET['status'])&&$_GET['status']=='success-failed'){
    $write_status = 'Failed!';
  }
?>
<div>
  <div style="margin:5px;color:red;"><?php echo (isset($write_status))?$write_status:''; ?></div>
  <form action="" method="post" enctype="multipart/form-data">
    <div><div class="label-input">Files</div><input type="file" name="file[]" class="content-input input-two" multiple="true" accept="image/*" /></div>
    <div><input type="submit" value="Upload" class="input-submit" /></div>
  </form>
</div>