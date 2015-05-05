<?php
/* Plugin for Dixie CMS
 * Name     : Custom Menu
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Type     : Extension files
 * Filename : functions.php
 */

global $custom_menu_structure;

function custom_menu_check_table($table){
  global $ldb;
  ldb();
  if(!in_array($table,$ldb->show_tables())){
    $ldb->create_table($table);
  }
  return true;
}

function custom_menu_get_data_menu($table){
  global $ldb;
  ldb();
  $hasil = array();
  $select = $ldb->select($table);
  $pre = array();
  foreach($select as $sel){
    $pre[$sel['priority'].'_'.$sel['aid']] = $sel;
  }
  ksort($pre);
  foreach($pre as $pr){
    $hasil[$pr['aid']] = $pr;
  }
  return $hasil;
}

function custom_menu_get_data_structure($table){
  global $custom_menu_structure;
  $data = custom_menu_get_data_menu($table);
  $custom_menu_structure = custom_menu_get_data_construct($data);
  return $custom_menu_structure;
}

function custom_menu_get_data_construct($data=array()){
  $hasil = array();
  if(is_array($data)){
    foreach($data as $sel){
      if($sel['parent']==0){
        $hasil[$sel['aid']] = $sel;
        $hasil[$sel['aid']]['child'] = array();
      }elseif($sel['parent']>0&&is_numeric($sel['parent'])){
        if($data[$sel['parent']]['parent']>0){
          if($data[$data[$sel['parent']]['parent']]['parent']==0){
            $hasil[$data[$sel['parent']]['parent']]['child'][$sel['parent']]['child'][$sel['aid']] = $sel;
          }
        }else{
          $hasil[$sel['parent']]['child'][$sel['aid']] = $sel;
        }
      }
    }
  }
  return $hasil;
}

function custom_menu_data_print($data=array(),$class='parent'){
  $hasil = array();
  if(is_array($data)&&count($data)>0){
    $hasil[] = '<ul id="custom_menu_'.str_replace('-','_',$class).'">';
    $index = get_index();
    $order_data = array();
    foreach($data as $id=>$value){
      $order_data[$value['order'].'_'.$value['aid']] = $value;
    } // for the function to arrage the recursive array, so i use this foreach :D
    $data = $order_data;
    ksort($data);
    foreach($data as $id=>$value){
      $hasil[] = '<li>';
      if($index=='admin'){
        $href = '?part=edit&id='.$value['aid'].'';
        $target = '';
      }else{
        $href = $value['uri'];
        $target = $value['target'];
      }
      $hasil[] = '<a href="'.$href.'" target="'.$target.'" title="'.$value['title'].'"><div class="custom-menu-'.$class.'">'.$value['name'];
      $hasil[] = '</div></a>';
      if(isset($value['child'])){
        $input_class = ($class=='parent')?'child':'grand-child';
        $hasil[] = custom_menu_data_print($value['child'],$input_class);
      }
      $hasil[] = '</li>';
    }
    $hasil[] = '</ul>';
  }
  return @implode('',$hasil);
}


function custom_menu_insert_data_menu($table,$data=array()){
  global $ldb;
  ldb();
  $menu = array('name','title','uri','target','parent','order');
  $hasil = array();
  if(is_array($data)){
    foreach($menu as $value){
      if(isset($data[$value])){
        $hasil[$value] = $data[$value];
      }else{
        $hasil[$value] = '';
      }
    }
    $insert = $ldb->insert($table,$hasil);
    if($insert){
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }
}
function custom_menu_update_data_menu($table,$data=array(),$id){
  global $ldb;
  ldb();
  $menu = array('name','title','uri','target','parent','order');
  $hasil = array();
  if(is_array($data)){
    foreach($menu as $value){
      if(isset($data[$value])){
        $hasil[$value] = $data[$value];
      }
    }
    $update = $ldb->update($table,'aid='.$id,$hasil);
    if($update){
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }
}


function custom_menu_print_data_header($content){
  $content .= '<script src="'.WWW.'plugins/custom-menu/jquery.1.10.2.js" type="text/javascript"></script>';
  $content .= '<link href="'.WWW.'plugins/custom-menu/style.css?v=1.0" type="text/css" rel="stylesheet" />';
  return $content;
}
function custom_menu_print_data_footer($content){
  $content .= '<script src="'.WWW.'plugins/custom-menu/custom.js?v=1.0" type="text/javascript"></script>';
  return $content;
}

function custom_menu_sidebar_print($content){
  return preg_replace_callback('/@\[custom_menu\]/i',function($akur){
    $table = 'custom_menu';
    $structure = custom_menu_get_data_structure($table);
    $hasil = '<div id="custom_menu">';
    $hasil .= custom_menu_data_print($structure);
    $hasil .= '</div>';
    return $hasil;
  },$content);
}













