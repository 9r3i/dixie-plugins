<?php
/* Plugin for Dixie CMS
 * Name     : Dixie3 Updater
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : admin-action.php
 */

if(function_exists('admin_registry')){
  admin_registry('dixie3-updater','updater','Update to v3',28,16,true,false,'fa-medkit');
}

if(defined('Q')&&Q=='updater'&&isset($_GET['data'],$_GET['update-uri'])){
  if(isset($_GET['update-uri'])){
    $file = json_decode(@file_get_contents($_GET['update-uri']),true);
    if(isset($file['filename'])&&isset($file['uri'])){
      $target = PUBDIR.'/temp/'.$file['filename'];
      $copy = @copy($file['uri'],$target);
      if($copy){
        $zip = new ZipArchive;
        if($zip->open($target)===true){
          if($zip->extractTo(DROOT)){
            $zip->close();
            @unlink($target);
            header('location: '.WWW.'admin/updater?status=success-update-dixie');
            exit;
          }
        }
      }else{
        header('content-type: text/plain;');
        exit('cannot get the update data');
      }
    }else{
      header('content-type: text/plain;');
      exit('cannot proceed the update, error data');
    }
  }else{
    header('content-type: text/plain;');
    exit('cannot proceed the update, update-uri is required');
  }
}