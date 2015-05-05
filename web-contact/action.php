<?php
/* Plugin for Dixie CMS
 * Name     : Website Contact
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : action.php
 */


/* function web_contact_send_mail
 * @param : $data = array() -> require data[from_email], data[from_name] and data[message]
 * @param : $output = json (default)
 */
function web_contact_send_mail($data=array(),$output=null){
  global $ldb;
  ldb();
  $table = 'web_contact';
  if(!in_array($table,$ldb->show_tables())){
    $ldb->create_table($table);
  }
  $outlist = array('json','array');
  $output = (isset($output)&&in_array($output,$outlist))?$output:'json';
  $datalist = array('from','to','subject','');
  if(is_array($data)&&isset($data['from_email'])&&isset($data['from_name'])&&isset($data['message'])){
    /* Set email header */
    $headers = 'From: '.$data['from_name'].' <'.$data['from_email'].'>'."\r\n";
    $headers .= 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
    /* Check the Cc mail */
    if(isset($data['feed'])){
      $headers .= 'Cc: '.$data['from_name'].''."\r\n";
    }
    /* Get target sending the options file */
    $to = (get_plugin_option('web-contact','target')!=='')?get_plugin_option('web-contact','target'):'mail@'.$_SERVER['SERVER_NAME'];
    /* Get subject from the options file */
    $subject = (get_plugin_option('web-contact','subject')!=='')?get_plugin_option('web-contact','subject'):'Email from '.$_SERVER['SERVER_NAME'].'';
    /* Set email message */
    $message = '<!DOCTYPE html><html lang="en-US"><head><meta content="text/html; charset=utf-8" http-equiv="content-type" /><meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" /><meta content="width=device-width, initial-scale=1" name="viewport" /><title>'.$subject.' &#8213; Dixie</title><meta content="Dixie CMS from Black Apple Inc." name="description" /><meta content="Generator, CMS" name="keywords" /><meta content="Luthfie" name="developer" /><meta content="luthfie@y7mail.com" name="developer-email" /><meta content="Dixie" name="generator" /><style type="text/css">body{color:#333;font-family:Tahoma,Segoe UI,Arial;}</style></head><body><div style="color:#333;font-family:Tahoma,Segoe UI,Arial;">';
    //$message .= $data['message'];
    $format = get_plugin_option('web-contact','format');
    $message_format = web_contact_message_format($format,$data);
    $message .= $message_format;
    $message .= '<p></p><p></p><hr /><p>Sent on '.date('F, jS Y - H:i:s').' &middot; Website Contact Plugin for Dixie CMS</p><p>Dixie &#8213; Powered by <a href="http://black-apple.biz/" target="_blank" title="Black Apple Inc.">Black Apple Inc.</a></p>';
    $message .= '</div></body></html>';
    $ldb->insert($table,array('from_name'=>$data['from_name'],'from_email'=>$data['from_email'],'content'=>$message_format));
    /* Start sending email */
    $mail = @mail($to,$subject,$message,$headers);
    if($mail){
      $status = array(
        'status'=>'OK',
        'message'=>'Message has been sent',
        'data'=>array(
          'to'=>$to,
          'subject'=>$subject,
          'header'=>$headers,
          'content'=>$message,
          'data_request'=>$data,
        )
      );
      if($output=='json'){
        header('content-type: application/json');
        print(json_encode($status));
        exit;
      }else{
        return $status;
      }
    }else{
      $error = array('status'=>'error','message'=>'Error: Cannot send the email');
      if($output=='json'){
        header('content-type: application/json');
        print(json_encode($error));
        exit;
      }else{
        return $error;
      }
    }
  }else{
    $error = array(
      'status'=>'error',
      'message'=>'Error: Data is not array, require data[from_email], data[from_name] and data[message]',
    );
    if($output=='json'){
      header('content-type: application/json');
      print(json_encode($error));
      exit;
    }else{
      return $error;
    }
  }
}

/* function web_contact_message_format */
function web_contact_message_format($format,$data=array()){
  global $hasil;
  $hasil = $data;
  return preg_replace_callback('/(data\[[a-z0-9_-]+\])/i',function($akur){
    global $hasil;
    $key = str_replace('data[','',substr($akur[0],0,-1));
    return nl2br($hasil[$key]);
  },$format);
}

/* function web_contact_email_sender */
function web_contact_email_sender($globals){
  global $post;
  $page = get_plugin_option('web-contact','page');
  if(isset($_POST['web_contact'],$post['url'])&&$page==$post['url'].'.html'){
    $data = $_POST;
    unset($data['web_contact']);
    $output = get_plugin_option('web-contact','output');
    $send = web_contact_send_mail($data,$output);
    if($send){
      exit;
    }else{
      return $globals;
    }
  }else{
    return $globals;
  }
}


// *** Plugin registry into post *** //
$sender_page = get_plugin_option('web-contact','page');
if($sender_page!==''&&defined('P')&&P==$sender_page){
  plugin_registry('web_contact_email_sender',array('post'),11,'action');
}