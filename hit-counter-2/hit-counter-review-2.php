<?php
/* Plugin for Dixie CMS
 * Name     : Hit Counter 2
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : hit-counter-review-2.php
 */

global $plugin_name,$ldb;
$plugin_name = (isset($_GET['name']))?$_GET['name']:'hit-counter-2';
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
.visitors h3{padding:10px;margin:5px 0px 15px;text-align:center;background-color:#555;color:#fff;}
.visitors h5{padding:0px;margin:5px 0px 10px;}
.visitor-each{padding:10px 0px;font-size:small;border-top:1px solid #999;overflow:hidden;white-space:pre;}
.visitor-each-label{display:inline-block;width:70px;}
.visitor-each-next{text-align:center;padding:10px 0px;font-size:small;border-top:1px solid #999;}
.visitor-each-next:hover{background-color:#ddd;}
</style>
<?php
$hit_table = 'hit_counter2';
$select = $ldb->select($hit_table,'type=hit_counter2');
$count = (isset($select[0]['count']))?$select[0]['count']:0;
$count = number_format($count,0,'.',',');;
$visitor_table = 'visitor';
$visitors = $ldb->select($visitor_table);
$count_visitors = number_format(count($visitors),0,'.',',');
  $next = (isset($_GET['next']))?$_GET['next']:0;
  $limit = 10;
$current_view = (($next+$limit)<$count_visitors)?($next+$limit):$count_visitors;
?>
<div class="visitors">
  <h3>Visitor Statistic</h3>
  <h5>Total Hit: <?php print($count); ?></h5>
  <h5>Visitors (<?php print($current_view.'/'.$count_visitors); ?>)</h5>
  <div style="border-bottom:1px solid #999;">
<?php
  $r = 0;
  foreach(array_reverse($visitors) as $visitor){
    if($r>=$next){
      echo '<div class="visitor-each">';
      echo '<div><div class="visitor-each-label">IP</div>: '.$visitor['ip'].'</div>';
      echo '<div><div class="visitor-each-label">User Agent</div>: '.$visitor['user_agent'].'</div>';
      echo '<div><div class="visitor-each-label">URI</div>: <a href="'.$visitor['request_uri'].'" target="_blank">'.$visitor['request_uri'].'</a>';
      echo '</div><div><div class="visitor-each-label">Time</div>: '.date('l, F jS, Y - H:i',$visitor['time']).'</div></div>';
    }
    $r++;
    if($r>=($limit+$next)){
      echo '<a href="?next='.($limit+$next).'"><div class="visitor-each-next">';
      echo 'Next';
      echo '</div></a>';
      break;
    }
  }
?>
  </div>
</div>