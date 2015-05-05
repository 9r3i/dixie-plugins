<?php
/* Plugin for Dixie CMS
 * Name     : Facebook Share
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : content.php
 */

function facebook_share_button($content){
  if(get_post_detail('url',false)!==''){
  $content .= '<div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=840986119244731&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
    }(document,\'script\', \'facebook-jssdk\'));
    </script>
    <div class="fb-share-button" data-href="'.WWW.get_post_detail('url',false).'.html" data-layout="button"></div>';
  }
  return $content;
}

// *** Plugin registry into post and type templates *** //
plugin_registry('facebook_share_button',array('post','type'),11);