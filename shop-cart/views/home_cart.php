<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CodeIgniter Shopping Cart</title>

<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/easy.notification.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
function loadCart()
{
	$('#jmlcart').load('<?php echo base_url(); ?>index.php/cart/total_cart/');
	$('#jmlcart2').load('<?php echo base_url(); ?>index.php/cart/show_cart/');
	$('#keranjang').load('<?php echo base_url(); ?>index.php/cart/show_cart/');
}
setInterval (loadCart, 5000);
</script>
<script type="text/javascript">
var status = "";
function tampilForm(frm){
	if(status=="")
	{
		$(frm).slideDown();
		status = "isi";
	}
	else
	{
		$(frm).slideUp();
		status = "";
	}
	
}
function tutupForm(frm){
    $(frm).slideUp();
	status = "";
}
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/web.css" media="screen" />
</head>

<body>
<div id="keranjang">

</div>
<div id="tombol-tampil"><div id="hasil"></div>KEDAI HOSTING MURAH | <span id="jmlcart">0 Item</span> | <a onclick="tampilForm('#keranjang')" style="cursor:pointer;">Tampilkan Keranjang</a></div>
<div id="barang">
<?php
$no = 1;
foreach($produk->result_array() as $h)
{
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myform-<?php echo $no; ?>").validate({
			debug: false,
			rules: {
				banyak: "required"
			},
			messages: {
				banyak: " error",
			},
			submitHandler: function(form) {
				// do other stuff for a valid form
				$.post('<?php echo base_url(); ?>index.php/cart/tambah', $("#myform-<?php echo $no; ?>").serialize(), function(data) {
					$('#hasil').html(data);
				});
			}
		});
	});
	</script>
<script type="text/javascript">
	$(function(){		   
		$('#clickable<?php echo $no; ?>').click(function(){ 
			$.easyNotification('Berhasil menambahkan <b><?php echo $h['nama_barang']; ?></b> ke dalam keranjang belanja | Total : <p id="jmlcart2"></p>'); 
		})
	});
</script>
<?php
	echo '<form method="post" action="" id="myform-'.$no.'" name="myform-'.$no.'">';
	echo '<div id="sub-barang"><h1>'.$h['nama_barang'].'</h1><div class="cleaner_h5"></div>'.$h['deskripsi'].'<div class="cleaner_h5"></div>
	Jumlah : <input type="text" name="banyak" maxlength="2" size="10" value="1">
	<input type="hidden" name="kode_barang" value="'.$h['kode_barang'].'">
	<h1><input type="submit" value="" class="submit" id="clickable'.$no.'"></h1></div>';
	echo '</form>';
	$no++;
}
?>
</div>
</body>
</html>
