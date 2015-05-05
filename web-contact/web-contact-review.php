<?php
/* Plugin for Dixie CMS
 * Name     : Website Contact
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : web-contact-review.php
 */

global $ldb;
ldb();
$table = 'web_contact';
if(!in_array($table,$ldb->show_tables())){
  $ldb->create_table($table);
}
$select = $ldb->select($table);

?>
<div class="web-contact-review">
<?php
$next = (isset($_GET['next']))?$_GET['next']:0;
$r = 0; $limit = 10;
foreach(array_reverse($select) as $sel){
  if($r>=$next){
    echo '<div class="web-contact-review-each">';
    echo '<div>'.$sel['content'].'</div>';
    echo '<div class="web-contact-review-time">Sent on '.date('l, F jS, Y - H:i:s',$sel['time']).'</div>';
    echo '</div>';
  }
  $r++;
  if($r>=($next+$limit)){
    echo '<a href="?next='.($next+$limit).'" title="Next"><div class="web-contact-review-next">Next</div></a>';
    break;
  }
}
?>
</div>