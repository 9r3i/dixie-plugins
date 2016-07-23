<?php
/* Plugin for Dixie CMS
 * Name     : Hit Counter 2
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : sidebar.php
 */

function hit_counter2_sidebar_print($content){
  return preg_replace_callback('/@\[hit_counter2\]/i',function($akur){
    global $ldb;
    $hit_table = 'hit_counter2';
    $hasil = '';
    if(ldb()){
      $select = $ldb->select($hit_table,'type=hit_counter2');
      if(isset($select[0])){
        $count = $select[0]['count'];
        $hasil = number_format($count,0,'.',',');
      }else{
        $hasil = 'data not found';
      }
    }else{
      $hasil = 'cannot connect into database';
    }
    $print = '<link href="'.WWW.'plugins/hit-counter-2/style.css?v=1.0" type="text/css" rel="stylesheet" />';
    $print .= '<div id="hit_counter_sidebar"><div style="clear:both;"></div>';
    $print .= '<div class="hit-counter-content" title="Total Hit: '.$hasil.'">';
    $print .= '<div class="hit-counter-label">Hit Counter:</div>';
    $print .= '<div class="hit-counter-digit">'.$hasil.'</div>';
    $print .= '</div><div style="clear:both;"></div></div>';
    return $print;
  },$content);
}

// *** Plugin registry into all templates *** //
plugin_registry('hit_counter2_sidebar_print',array('post','index','search','404','type'),11,'sidebar');