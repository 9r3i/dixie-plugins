/* Plugin for Dixie CMS
 * Name     : Background Change
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : bg_change.js
 */

var bgcs;
var body = document.getElementsByTagName('body');
var r = 0;
body[0].style.backgroundImage="url('"+bgcs[0]+"')";
var timeset = setInterval(function(){
  r++;
  r = (r<bgcs.length)?r:0;
  var bg = bgcs[r];
  $.get(bg,function(hasil){
    body[0].style.backgroundImage="url('"+bg+"')";
  });
},30000);
