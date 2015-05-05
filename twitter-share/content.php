<?php
/* Plugin for Dixie CMS
 * Name     : Twitter Share
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : content.php
 */

function twitter_share_button($content){
  if(get_post_detail('url',false)!==''){
  $content .= '<div style="display:inline-block;margin:0px;padding:0px 10px;position:absolute;"><a class="twitter-share-button" href="https://twitter.com/share?url='.urlencode(WWW.get_post_detail('url',false).'.html').'" data-count="none">Tweet</a></div>
    <script type="text/javascript">
      window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
    </script>';
  }
  return $content;
}

// *** Plugin registry into post template *** //
plugin_registry('twitter_share_button',array('post'),11);