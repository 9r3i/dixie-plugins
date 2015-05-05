<?php
/* Plugin for Dixie CMS
 * Name     : Custom Menu
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : admin-action.php
 */

require_once('extension/functions.php');

if(function_exists('admin_registry')){
  admin_registry('custom-menu','custom-menu','Custom Menu',28,16,true,false);
}

/* Admin registry function
 * To register a plugin menu and page into admin page (backend)
 * @name: string -> Plugin name or actually the slug uri of the plugin directory
 * @slug: string -> The file slug to the content file
 * @title: string -> The title and the written text
 * @priority: integer -> default 10
 * @privilege: integer -> according to sdp -> default 16 as admin
 * 32 = master only
 * 16 = admin only
 * 8 = admin and editor
 * 4 = admin, editor and author
 * 2 = admin, editor, author and member 
 *
 * @regside: bool -> register to sidebar -> default true
 * @editor: bool -> register to editor pages -> default false
 *
 * Sample:
 * admin_registry($name,$slug,$title,$priority=10,$privilege=16,$regside=true,$editor=false)
 */

if(isset($_POST['custom-menu-action'])){
  $table = 'custom_menu';
  if($_POST['action']=='create'){
    $insert = custom_menu_insert_data_menu($table,$_POST);
    if($insert){
      header('location: '.WWW.'admin/custom-menu/?status=success-insert');
      exit;
    }
  }elseif($_POST['action']=='update'){
    $update = custom_menu_update_data_menu($table,$_POST,$_POST['id']);
    if($update){
      header('location: '.WWW.'admin/custom-menu/?status=success-update');
      exit;
    }
  }elseif($_POST['action']=='edit-css'){
    $update = file_write('plugins/custom-menu/style.css',$_POST['css-content']);
    if($update){
      header('location: '.WWW.'admin/custom-menu/?part=CSS&status=success-update');
      exit;
    }
  }
}