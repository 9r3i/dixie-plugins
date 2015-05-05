<?php
/* Plugin for Dixie CMS
 * Name     : Background Change
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : options.php
 */

global $plugin_name;
$plugin_name = (isset($_GET['name']))?$_GET['name']:'Background_Change';
?>
<style type="text/css">
.label-input{width:150px;display:inline-block;padding:5px;margin:5px 0px;}
.content-input{width:400px;display:inline-block;padding:5px;margin:5px 0px;border:1px solid #bbb;}
.input-two{margin:5px;width:390px;}
.input-submit{border:0px none;margin:10px;padding:5px 7px;background-color:#777;cursor:pointer;margin-left:165px;color:#fff;font-weight:bold;display:inline-block;}
.input-submit:hover{background-color:#666;color:#fff;}
.input-submit:focus{background-color:#555;color:#fff;}
</style>
<?php
if(isset($_GET['bg-upload'])){
  @include_once('bg-upload.php');
}else{
  if(isset($_POST['active'])&&isset($_POST['directory'])){
    $write = set_plugin_option($plugin_name,$_POST);
    if($write){
      $url = WWW.'admin/plugin-option/?name='.$plugin_name.'&status=success-update';
      print('<meta http-equiv="refresh" content="0; url='.$url.'" />');
    }else{
      $url = WWW.'admin/plugin-option/?name='.$plugin_name.'&status=success-failed';
      print('<meta http-equiv="refresh" content="0; url='.$url.'" />');
    }
  }
  if(isset($_GET['status'])&&$_GET['status']=='success-update'){
    $write_status = 'Done!'; 
  }elseif(isset($_GET['status'])&&$_GET['status']=='success-failed'){
    $write_status = 'Failed!';
  }
?>
<div>
  <div><a href="<?php print(WWW.'admin/plugin-option/?name='.$plugin_name); ?>&bg-upload"><div class="input-submit">Upload Picture</div></a></div>
  <div style="margin:5px;color:red;"><?php echo (isset($write_status))?$write_status:''; ?></div>
  <form action="" method="post">
    <div><div class="label-input">Active</div>
	  <select id="sector" name="active" class="content-input">
        <option value="yes">Yes</option><option value="no"<?php echo (get_plugin_option($plugin_name,'active')!=='yes')?' selected="1"':''; ?>>No</option>
	  </select>
	</div>
    <div><div class="label-input">Gallery Directory</div><input type="text" name="directory" class="content-input input-two" value="<?php print(get_plugin_option($plugin_name,'directory')); ?>" /></div>
    <div><div class="label-input">Shuffle</div>
	  <select id="sector" name="shuffle" class="content-input">
        <option value="yes">Yes</option><option value="no"<?php echo (get_plugin_option($plugin_name,'shuffle')!=='yes')?' selected="1"':''; ?>>No</option>
	  </select>
	</div>
    <div><input type="submit" value="Save" class="input-submit" /></div>
  </form>
</div>
<?php
}