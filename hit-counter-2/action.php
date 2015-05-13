<?php
/* Plugin for Dixie CMS
 * Name     : Hit Counter 2
 * Author   : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : action.php
 */

function hit_counter2_action_get_data($globals){
  global $ldb;
  $the_table = 'visitor2';
  $hit_table = 'hit_counter2';
  $write = (is_login())?false:true;
  $write = (get_plugin_option('hit-counter-2','include')=='yes')?true:false;
  if(ldb()&&isset($globals['_SERVER']['HTTP_USER_AGENT'],$globals['_SERVER']['REMOTE_ADDR'])&&$write==true){
    $user_agent = $globals['_SERVER']['HTTP_USER_AGENT'];
    $remote_addr = $globals['_SERVER']['REMOTE_ADDR'];
    $request_addr = WWW.P.(defined('Q')?'/'.Q:'');
    $tables = $ldb->show_tables();
    if(!in_array($the_table,$tables)){
      $ldb->create_table($the_table);
    }
    if(!in_array($hit_table,$tables)){
      $ldb->create_table($hit_table);
    }
    $data = array(
      'ip'=>$remote_addr,
      'user_agent'=>$user_agent,
      'request_uri'=>$request_addr,
    );
    $ldb->insert($the_table,$data);
    $hit_select = $ldb->select($hit_table,'type=hit_counter2');
    if(isset($hit_select[0])){
      $count = $hit_select[0]['count'];
      $count+=1; // to prevent double increasement
      $ldb->update($hit_table,'type=hit_counter2',array('count'=>$count));
    }else{
      $ldb->insert($hit_table,array('type'=>'hit_counter2','count'=>'1'));
    }
  }
  return $globals;
}

// *** Plugin registry into all templates *** //
plugin_registry('hit_counter2_action_get_data',array('post','index','search','404','type'),11,'action');
