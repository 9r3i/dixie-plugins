<?php
$option_file = str_replace('\\','/',dirname(__FILE__)).'/options.txt';
if(isset($_POST['ram_url'])&&isset($_POST['url_to_image'])&&isset($_POST['ram_tags'])&&isset($_POST['ram_split_words'])&&isset($_POST['ram_split_words_length'])){
  $content = array();
  foreach($_POST as $key=>$value){
    $content[] = $key.'==='.$value;
  }
  $content_write = implode(PHP_EOL,$content);
  $write = file_write($option_file,$content_write,'w+');
  if($write){
    header('location: '.WWW.'admin/plugin-option/?name=ram&status=success-update');
    exit;
  }else{
    header('location: '.WWW.'admin/plugin-option/?name=ram&status=success-failed');
    exit;
  }
}
  if(isset($_GET['status'])&&$_GET['status']=='success-update'){
    $write_status = 'Done!'; 
  }elseif(isset($_GET['status'])&&$_GET['status']=='success-failed'){
    $write_status = 'Failed!';
  }
?>
<style type="text/css">
.label-input{width:150px;display:inline-block;padding:5px;margin:5px 0px;}
.content-input{width:400px;display:inline-block;padding:5px;margin:5px 0px;border:1px solid #bbb;}
.input-two{margin:5px;width:390px;}
.input-submit{border:0px none;margin:10px;padding:5px 7px;background-color:#bb3;cursor:pointer;margin-left:165px;color:#333;font-weight:bold;}
.input-submit:hover{background-color:#880;color:#fff;}
.input-submit:focus{background-color:#550;color:#fff;}
</style>
<div>
  <div style="margin:5px;color:red;"><?php echo (isset($write_status))?$write_status:''; ?></div>
  <form action="" method="post">
    <div><div class="label-input">Ram URL</div>
	  <select id="sector" name="ram_url" class="content-input">
        <option value="yes">Yes</option><option value="no"<?php echo (ram_get_option('ram_url')!=='yes')?' selected="1"':''; ?>>No</option>
	  </select>
	</div>
    <div><div class="label-input">Convert URL to Image</div>
	  <select id="sector" name="url_to_image" class="content-input">
        <option value="yes">Yes</option><option value="no"<?php echo (ram_get_option('url_to_image')!=='yes')?' selected="1"':''; ?>>No</option>
	  </select>
	</div>
    <div><div class="label-input">Ram Tags</div>
	  <select id="sector" name="ram_tags" class="content-input">
        <option value="yes">Yes</option><option value="no"<?php echo (ram_get_option('ram_tags')!=='yes')?' selected="1"':''; ?>>No</option>
	  </select>
	</div>
    <div><div class="label-input">Use Tag URL</div>
	  <select id="sector" name="use_tag_url" class="content-input">
        <option value="yes">Yes</option><option value="no"<?php echo (ram_get_option('use_tag_url')!=='yes')?' selected="1"':''; ?>>No</option>
	  </select>
	</div>
    <div><div class="label-input">Ram Tags URL</div><input type="text" name="ram_tags_url" class="content-input input-two" value="<?php print(ram_get_option('ram_tags_url')); ?>" /></div>
    <div><div class="label-input">Ram Split Words</div>
	  <select id="sector" name="ram_split_words" class="content-input">
        <option value="yes">Yes</option><option value="no"<?php echo (ram_get_option('ram_split_words')!=='yes')?' selected="1"':''; ?>>No</option>
	  </select>
	</div>
    <div><div class="label-input">Ram Split Words Length</div><input type="text" name="ram_split_words_length" class="content-input input-two" value="<?php print(ram_get_option('ram_split_words_length')); ?>" /></div>
    <div><input type="submit" value="Save" class="input-submit" /></div>
  </form>
</div>
<?php
function ram_get_option($key=false){
  $option_file = str_replace('\\','/',dirname(__FILE__)).'/options.txt';
  $file = @file($option_file);
  $hasil = array();
  foreach($file as $fi){
    $exp = explode('===',trim($fi));
    if(isset($exp[1])){
      $hasil[$exp[0]] = $exp[1];
    }
  }
  if(isset($hasil[$key])&&key!==false){
    return $hasil[$key];
  }else{
    return false;
  }
}