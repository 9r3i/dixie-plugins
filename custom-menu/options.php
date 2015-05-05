<?php
/* Plugin for Dixie CMS
 * Name     : Hit Counter
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : options.php
 */

global $plugin_name,$ldb;
$plugin_name = (isset($_GET['name']))?$_GET['name']:'hit-counter';
ldb();
?>
<style type="text/css">
.label-input{width:150px;display:inline-block;padding:5px;margin:5px 0px;}
.content-input{width:400px;display:inline-block;padding:5px;margin:5px 0px;border:1px solid #bbb;}
.input-two{margin:5px;width:390px;}
.input-submit{border:0px none;margin:10px;padding:5px 7px;background-color:#f88;cursor:pointer;margin-left:165px;color:#333;font-weight:bold;display:inline-block;}
.input-submit:hover{background-color:#d66;color:#fff;}
.input-submit:focus{background-color:#b44;color:#fff;}

.visitors{background-color:#fff;padding:10px;margin:10px 0px;}
.visitors h3{padding:10px;margin:5px 0px 15px;text-align:center;background-color:#f88;color:#fff;}
.visitors h5{padding:0px;margin:5px 0px 10px;}
.visitor-each{padding:10px 0px;font-size:small;border-top:1px solid #999;overflow:hidden;white-space:pre;}
.visitor-each-label{display:inline-block;width:70px;}
</style>
<?php
  if(isset($_POST['target'])&&isset($_POST['output'])){
    $write = set_plugin_option($plugin_name,$_POST);
    $redirect_url = WWW.'admin/plugin-option/?name='.$plugin_name.'&status='.(($write)?'success':'failed');
    print('<meta http-equiv="refresh" content="0; url='.$url.'" />');
  }
  if(isset($_GET['status'])&&$_GET['status']=='success'){
    $write_status = 'Done!'; 
  }elseif(isset($_GET['status'])&&$_GET['status']=='failed'){
    $write_status = 'Failed!';
  }

$hit_table = 'hit_counter';
$select = $ldb->select($hit_table,'type=hit_counter');
$count = (isset($select[0]['count']))?$select[0]['count']:0;
$count = number_format($count,0,'.',',');;
$visitor_table = 'visitor';
$visitors = $ldb->select($visitor_table);
?>
<div class="visitors">
  <h3>Visitor Statistic</h3>
  <h5>Total Hit: <?php print($count); ?></h5>
  <h5>Visitors (<?php print(count($visitors)); ?>)</h5>
  <div style="border-bottom:1px solid #999;">
<?php
  $r=0;
  foreach(array_reverse($visitors) as $visitor){
    echo '<div class="visitor-each">';
    echo '<div><div class="visitor-each-label">IP</div>: '.$visitor['ip'].'</div>';
    echo '<div><div class="visitor-each-label">User Agent</div>: '.$visitor['user_agent'].'</div>';
    echo '<div><div class="visitor-each-label">URI</div>: '.$visitor['request_uri'];
    echo '</div><div><div class="visitor-each-label">Time</div>: '.date('l, F jS, Y - H:i',$visitor['time']).'</div></div>';
    $r++;
    if($r>=10){
      break;
    }
  }
?>
  </div>
</div>

<!--
<div>
  <div style="margin:5px;color:red;"><?php echo (isset($write_status))?$write_status:''; ?></div>
  <form action="" method="post">
    <div><div class="label-input">Target Sending</div><input type="text" name="target" class="content-input input-two" value="<?php print(get_plugin_option($plugin_name,'target')); ?>" /></div>
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
</div>-->