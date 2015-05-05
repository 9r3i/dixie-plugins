<?php
/* Plugin for Dixie CMS
 * Name     : Website Contact
 * Creator  : Luthfie
 * Email    : Luthfie@y7mail.com
 * Filename : content.php
 */


function web_contact_print_content($content){
  global $post;
  if(isset($post['url'])&&get_plugin_option('web-contact','form')==$post['url'].'.html'){
?>
<img width="150" height="150" src="<?php print(WWW); ?>plugins/web-contact/contact-red-150x150.png" class="web-contact-logo" title="Website Contact" />
<br />

<p>Silahkan tulis pesan yang ingin anda sampaikan kepada kami. Dan anda wajib menyertakan Nama Lengkap, Alamat Email dan Nomor Telpon untuk kami hubungi.</p>

<form class="formulir" method="post" action="sending-contact.html">
<h3>Form Contact</h3>
<table class="jorok">
<tbody>
<tr>
<td class="buruk">  Sapaan</td>
<td><select class="sapaan" name="sapaan">
  <option value="Bapak">Bapak</option>
  <option value="Ibu">Ibu</option>
</select></td>
</tr>
<tr>
<td class="buruk">  Nama lengkap</td>
<td><input class="berak" type="text" name="nama" /></td>
</tr>
<tr>
<td class="buruk">  Alamat email</td>
<td><input class="berak" type="text" name="from" /></td>
</tr>
<tr>
<td class="buruk">  Nomor handphone</td>
<td><input class="berak" type="text" name="hp" /></td>
</tr>
<tr>
<td class="buruk" style="vertical-align:top;">  Pesan</td>
<td><textarea class="borok" name="message"></textarea></td>
</tr>
<tr>
<td class="buruk"></td>
<td><input type="checkbox" name="cc" id="cc" value="false" /> <label for="cc" style="font-size:13px;">Kirim CC ke email anda?</label></td>
</tr>
<tr>
<td class="buruk"></td>
<td class="tom"><input class="tombol" type="submit" value="  Kirim  " /></td>
</tr>
</tbody>
</table>
</form>

<script type="text/javascript" src="<?php print(WWW); ?>plugins/web-contact/jquery.1.10.2.js"></script>
<script type="text/javascript">
$(".formulir").prepend('<div id="keterangan"></div>');
$("input[name='nama']").change(function(){$(this).attr({"style":"border:1px solid #999;"});});
$("input[name='from']").change(function(){$(this).attr({"style":"border:1px solid #999;"});});
$("input[name='hp']").change(function(){$(this).attr({"style":"border:1px solid #999;"});});
$("textarea[name='message']").change(function(){$(this).attr({"style":"border:1px solid #999;"});});
$("input.tombol").click(function(tombol){
  tombol.preventDefault();
    function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if( !emailReg.test( $email ) ) {return false;} else {return true;}
    }
    function validateHP($hp) {
      var hpReg = /^(\+?[\d\s\-]+)?$/;
      if(!hpReg.test($hp)){return false;}else{return true;}
    }
  var sapaan = $("select[name='sapaan']").val();
  var nama = $("input[name='nama']").val();
  var from = $("input[name='from']").val();
  var hp = $("input[name='hp']").val();
  var message = $("textarea[name='message']").val();
  var cc = $("input[name='cds']").val();
  if(nama==""){
	$("#keterangan").html('<span style="color:red;">Mohon isi nama lengkap dengan benar.</span>');
	$("input[name='nama']").attr({"style":"border:2px solid red;"});
  }
  else if(from==""||!validateEmail(from)){
	$("#keterangan").html('<span style="color:red;">Mohon isi alamat email dengan benar.</span>');
	$("input[name='from']").attr({"style":"border:2px solid red;"});
  }
  else if(hp==""||!validateHP(hp)){
	$("#keterangan").html('<span style="color:red;">Mohon isi nomor handphone dengan benar.</span>');
	$("input[name='hp']").attr({"style":"border:2px solid red;"});
  }
  else if(message==""){
	$("#keterangan").html('<span style="color:red;">Mohon isi pesan dengan benar.</span>');
	$("textarea[name='message']").attr({"style":"border:2px solid red;"});
  }
  else{
    $(".formulir").html('<h2>Mengirim...</h2>');
    var aw=0;
    var puterkeun = setInterval(function(){aw+=3;$(".web-contact-logo").attr({"style":"-moz-transform:rotate(-"+aw+"deg);-webkit-transform:rotate(-"+aw+"deg);-khtml-transform:rotate(-"+aw+"deg);box-transform:rotate(-"+aw+"deg);"});},10);
    $.post("<?php print(WWW.get_plugin_option('web-contact','page')); ?>",{
      sapaan:sapaan,from_name:nama,from_email:from,hp:hp,message:message,cc:cc,web_contact:true
      },function(hasil){
        if(hasil.status=='OK'){
	      $(".formulir").html('<h2>Pesan terkirim!</h2>');
        }else if(hasil.status=='error'){
	      $(".formulir").html('<h2>'+hasil.message+'!</h2>');
        }else{
	      $(".formulir").html('<h2>Unknown error!</h2>');
        }
	    clearInterval(puterkeun);
	    $(".web-contact-logo").attr({"style":"-moz-transform:rotate(0deg);-webkit-transform:rotate(0deg);-khtml-transform:rotate(0deg);box-transform:rotate(0deg);"});
    });
  }
});
$("input[name='cc']").change(function(){
  if($(this).val()=='false'){
    $(this).val('true');
  }else{
    $(this).val('false');
  }
});
</script>

<style type="text/css">
.web-contact-logo{float:right;}
.formulir {margin:0px;padding:0px;}
.jorok {padding: 5px;margin: 2px;width: 500px;}
.berak {height:24px;width:310px;padding: 2px;border:1px solid #999;font-size: 14px;}
.borok {height:150px;width:310px;max-width:310px;min-width:310px;padding: 2px;font-family: Tahoma,Segoe UI;border:1px solid #999;font-size: 14px;}
.tombol {height:30px;width:100px;padding: 2px;vertical-align:middle;font-weight:bold;cursor:pointer;background-color: #ffffff; border-radius: 7px 0px;box-shadow: 0px 0px 9px #ccc;border:1px solid #999;}
.tom {text-align:left;}
.sapaan {height:24px;width:100px;padding: 2px;border:1px solid #999;font-size: 14px;}
.buruk {height:24px;width:150px;padding: 2px;}

@media screen and (max-width:909px){
  .jorok{width:450px;}
  .buruk{width:110px;}
  .berak{width:300px;}
  .borok{width:300px;max-width:300px;min-width:300px;}
}
@media screen and (max-width:709px){
  .jorok{width:390px;}
  .buruk{width:110px;}
  .berak{width:240px;}
  .borok{width:240px;max-width:240px;min-width:240px;}
}
@media screen and (max-width:429px){
  .jorok{width:280px;}
  .buruk{width:80px;}
  .berak{width:150px;}
  .borok{width:150px;max-width:150px;min-width:150px;}
}

</style>
<?php
  }else{
    return $content;
  }
}

// *** Plugin registry into post *** //
plugin_registry('web_contact_print_content',array('post'),11,'content');









