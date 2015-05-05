<?php
/* Plugin for Dixie CMS
 * Name     : Website Contact
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : options.php
 */

global $plugin_name;
$plugin_name = (isset($_GET['name']))?$_GET['name']:'web-contact';
?>
<style type="text/css">
.label-input{width:150px;display:inline-block;padding:5px;margin:5px 0px;}
.content-input{width:400px;display:inline-block;padding:5px;margin:5px 0px;border:1px solid #bbb;}
.input-two{margin:5px;width:390px;}
.input-submit{border:0px none;margin:10px;padding:5px 7px;background-color:#f88;cursor:pointer;margin-left:165px;color:#333;font-weight:bold;display:inline-block;}
.input-submit:hover{background-color:#d66;color:#fff;}
.input-submit:focus{background-color:#b44;color:#fff;}
</style>
<?php
  if(isset($_POST['target'])&&isset($_POST['page'])){
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

global $posts;
get_posts('url','type=page&status=publish');
?>
<div>
  <div style="margin:5px;color:red;"><?php echo (isset($write_status))?$write_status:''; ?></div>
  <form action="" method="post">
    <div><div class="label-input">Target Sending</div><input type="text" name="target" class="content-input input-two" value="<?php print(get_plugin_option($plugin_name,'target')); ?>" /></div>
    <div><div class="label-input">Subject</div><input type="text" name="subject" class="content-input input-two" value="<?php print(get_plugin_option($plugin_name,'subject')); ?>" /></div>
    <div><div class="label-input">Action Page</div>
	  <select id="sector" name="page" class="content-input">
        <option value="">--- Page to send ---</option>
        <?php
          foreach($posts as $url=>$post){
            echo '<option value="'.$url.'.html" '.((get_plugin_option($plugin_name,'page')==$url.'.html')?' selected="true"':'').'>'.$post['title'].'</option>';
          }
        ?>
	  </select>
	</div>
    <div><div class="label-input">Form Page</div>
	  <select id="sector" name="form" class="content-input">
        <option value="">--- Page of form ---</option>
        <?php
          foreach($posts as $url=>$post){
            echo '<option value="'.$url.'.html" '.((get_plugin_option($plugin_name,'form')==$url.'.html')?' selected="true"':'').'>'.$post['title'].'</option>';
          }
        ?>
	  </select>
	</div>
    <div><div class="label-input" style="vertical-align: top;">Message Format</div>
      <textarea name="format" class="content-input" style="width:390px;height:120px;"><?php print(get_plugin_option($plugin_name,'format')); ?></textarea>
    </div>
    <div><div class="label-input">Output</div>
	  <select id="sector" name="output" class="content-input">
        <option value="">--- Output ---</option>
        <?php
          $output = array('json','array');
          foreach($output as $put){
            echo '<option value="'.$put.'" '.((get_plugin_option($plugin_name,'output')==$put)?' selected="true"':'').'>'.ucfirst($put).'</option>';
          }
        ?>
	  </select>
	</div>
    <div><input type="submit" value="Save" class="input-submit" /></div>
  </form>
</div>