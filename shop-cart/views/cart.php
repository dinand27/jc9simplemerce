<?php if(!$this->cart->contents()):
	echo 'Keranjang belanja masih kosong mas brow...!!!';
else:
?>

<?php echo form_open('cart/update_cart'); ?>
<table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #999;" border="1">
	<thead>
		<tr>
			<td>Banyak Barang</td>
			<td>Nama Barang</td>
			<td>Harga Barang per Satuan</td>
			<td>Sub Total Harga</td>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach($this->cart->contents() as $items): ?>
		
		<?php echo form_hidden('rowid[]', $items['rowid']); ?>
		<tr <?php if($i&1){ echo 'class="alt"'; }?>>
	  		<td>
	  			<?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '2', 'size' => '1')); ?>
	  		</td>
	  		
	  		<td><?php echo $items['name']; ?></td>
	  		
	  		<td>Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
	  		<td>Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
	  	</tr>
	  	
	  	<?php $i++; ?>
		<?php endforeach; ?>
		
		<tr>
 		 	<td colspan="3"><strong>Total</strong></td>
 		 	<td>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></td>
		</tr>
	</tbody>
</table>

<p><?php echo "<input type='submit' class='kirim' value='Update Keranjang'>"; echo anchor('cart/empty_cart', 'Kosongkan Keranjang');?></p>
<?php 
echo form_close(); 
endif;
?>



