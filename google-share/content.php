<?php
/* Plugin for Dixie CMS
 * Name     : Google Share
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : content.php
 */

function google_share_button($content){
  if(get_post_detail('url',false)!==''){
  $content .= '<script src="https://apis.google.com/js/platform.js" async defer></script>
    <div style="display:inline-block;margin:0px 10px 0px 70px;padding:0px 10px;position:absolute;">
      <div class="g-plus" data-action="share" data-annotation="none" data-height="23"></div>
    </div>'; //WWW.get_post_detail('url',false).'.html'
  }
  return $content;
}

// *** Plugin registry into post template *** //
plugin_registry('google_share_button',array('post'),12);
