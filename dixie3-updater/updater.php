<?php
/* Plugin for Dixie CMS
 * Name     : Dixie3 Updater
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : updater.php
 */


$update = dixie3_check_update();
if($update){
  echo '<div class="update-info">Update version '.$update['update_version'].' is available. <a href="'.WWW.'admin/updater?data=update-dixie&update-uri='.urlencode($update['update_uri']).'" title="Update to version '.$update['update_version'].'"><button class="update-button">Update Now</button></a></div>';
}else{
?>
<div class="update-info">
  <?php __locale('Dixie is up to date',true); ?>.
</div>
<?php
}
//echo '<pre>'.print_r($update,true).'</pre>';






/* Dixie check update */
function dixie3_check_update(){
  $url = 'http://dixie.hol.es/update.php';
  $data = array(
    'dixie_client'=>'free_3c45d9df52f76f69d1130e12db10fe59',
    'dixie_version'=>DIXIE_VERSION,
  );
  $get_content = form_post($url,$data);
  $update = json_decode($get_content,true);
  if(isset($update['update_needed'])){
    return $update;
  }else{
    return false;
  }
}