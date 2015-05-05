<?php
/* Plugin Ram URL for Katya CMS
 * Created by Luthfie
 * luthfie@y7mail.com
 * Version 1.0
 */

/* Function ram_url to detect url inside the content
 * then return into anchor and blank target
 * @param str = free string
 */
function ram_url($str){
  global $ram_str;
  $ram_str = $str;
  $hasil = preg_replace_callback('/((((ftps?|https?):\/\/)|www\.)(www\.)?[a-zA-Z0-9\-]+\.[a-zA-Z]{2,4}(\.[a-z]{2})?\/?([^\s#\'\<]+)?)/i',function($akur){
    global $ram_str;
    $url = (preg_match('/http/i',$akur[0]))?$akur[0]:'http://'.$akur[0];
    if(preg_match('/\.(jpg|png|gif)/i',$akur[0])&&ram_get_option('url_to_image')=='yes'){
      return '<a href="'.$url.'" rel="ram_url" title="'.$akur[0].'" target="_blank" id="plugin_ram_url"><img src="'.$url.'" id="plugin_ram_url_image" /></a>';
      return '';
    }else{
      if(!preg_match('/((\=\"|\=\')'.substr($akur[0],0,4).')/i',$ram_str)){
        return '<a href="'.$url.'" rel="ram_url" title="'.$akur[0].'" target="_blank" id="plugin_ram_url">'.$akur[0].'</a>';
      }else{
        return $akur[0];
      }
    }
  },$str);
  return $hasil;
}

/* Function ram_split_words
 * @param str = free string
 * @param long = (optional) default 39 words
 */
function ram_split_words($str,$long=39){
  $long = (ram_get_option('ram_split_words_length'))?ram_get_option('ram_split_words_length'):$long;
  $split = @explode(' ',$str);
  $hasil = array();
  $distance = (count($split)>=$long)?$long:count($split);
  for($r=0;$r<$distance;$r++){
    $hasil[] = $split[$r];
  }
  $new_str = @implode(' ',$hasil);
  $dots = (count($split)>$long)?'...':'';
  $split_baris = @explode(PHP_EOL,$new_str);
  $new_baris = array();
  if(is_array($split_baris)&&count($split_baris)>5){ // filter by 5 rows
    for($r=0;$r<5;$r++){$new_baris[] = $split_baris[$r];}
    return @implode(PHP_EOL,$new_baris).'...';
  }else{
    return $new_str.$dots;
  }
}

/* Function ram_tags
 * find tag word match to /#[a-zA-Z0-9_]+/i
 * @param $str = free string
 * @param $url = redirect link by creating the anchor in the match ones, default false
 */
function ram_tags($str,$url=false){
  $hasil = preg_replace_callback('/#[a-zA-Z0-9_]+/i',function($akur){
    $slug = str_replace('#','',$akur[0]);
    $url = (ram_get_option('use_tag_url')!=='yes')?$akur[0]:ram_get_option('ram_tags_url').create_slug($slug);
    return '<a href="'.$url.'" rel="tag" title="#'.$slug.'" id="plugin_ram_tags">'.$akur[0].'</a>';
  },$str);
  return $hasil;
}

// *** Plugin registry into index, tags and post *** //
if(ram_get_option('ram_url')=='yes'){
  plugin_registry('ram_url',array('index','post','tags'),10);
}
// *** Plugin registry into index and tags *** //
if(ram_get_option('ram_split_words')=='yes'){
  plugin_registry('ram_split_words',array('index','tags'),10);
}
// *** Plugin registry into index, post and tags *** //
if(ram_get_option('ram_tags')=='yes'){
  plugin_registry('ram_tags',array('index','post','tags'),11);
}


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
  if(isset($hasil[$key])&&$key!==false){
    return $hasil[$key];
  }else{
    return false;
  }
}








