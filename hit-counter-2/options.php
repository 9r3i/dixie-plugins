<?php
/* Plugin for Dixie CMS
 * Name     : Hit Counter 2
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : options.php
 */

global $plugin_name,$ldb;
$plugin_name = (isset($_GET['name']))?$_GET['name']:'hit-counter-2';
ldb();

  if(isset($_POST['include'])){
    $write = set_plugin_option($plugin_name,$_POST);
    $redirect_url = WWW.'admin/plugin-option/?name='.$plugin_name.'&status='.(($write)?'success':'failed');
    print('<meta http-equiv="refresh" content="0; url='.$url.'" />');
  }
  if(isset($_GET['status'])&&$_GET['status']=='success'){
    $write_status = 'Done!'; 
  }elseif(isset($_GET['status'])&&$_GET['status']=='failed'){
    $write_status = 'Failed!';
  }
?>
<style type="text/css">
.label-input{width:150px;display:inline-block;padding:5px;margin:5px 0px;}
.content-input{width:400px;display:inline-block;padding:5px;margin:5px 0px;border:1px solid #bbb;}
.input-two{margin:5px;width:390px;}
.input-submit{border:0px none;margin:10px;padding:5px 7px;background-color:#777;cursor:pointer;margin-left:165px;color:#fff;font-weight:bold;display:inline-block;}
.input-submit:hover{background-color:#666;color:#fff;}
.input-submit:focus{background-color:#555;color:#fff;}

.visitors{background-color:#fff;padding:10px;margin:10px 0px;}
.visitors h3{padding:10px;margin:5px 0px 15px;text-align:center;background-color:#f88;color:#fff;}
.visitors h5{padding:0px;margin:5px 0px 10px;}
.visitor-each{padding:10px 0px;font-size:small;border-top:1px solid #999;overflow:hidden;white-space:pre;}
.visitor-each-label{display:inline-block;width:70px;}
</style>
<div>
  <div style="margin:5px;color:red;"><?php echo (isset($write_status))?$write_status:''; ?></div>
  <form action="" method="post">
    <div><div class="label-input">Target Sending</div><input type="text" name="target" class="content-input input-two" value="" /></div>
    <div><div class="label-input">Include admin</div>
	  <select id="sector" name="include" class="content-input">
        <option value="no">No, Public visitor only</option>
        <option value="yes" <?php echo (get_plugin_option($plugin_name,'include')=='yes')?'selected="true"':''; ?>>Yes, Including admin</option>
	  </select>
	</div>
    <div><input type="submit" value="Save" class="input-submit" /></div>
  </form>
</div>