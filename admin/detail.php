<?php 
$koneksi = new mysqli ('localhost','root','','penjualan_elektronik');
?>
<h2><center>DETAIL PEMBELIAN</center></h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail=$ambil->fetch_assoc(); 
?>
<!-- <pre><?php print_r($detail); ?></pre>
 -->
  <style>
      .table > tbody > tr > td {
     vertical-align: middle;
     text-align: center;
}
  </style>
<br>
<div class="row">
	<div class="col-md-4">
		<h3><strong>Pembelian</strong></h3>
		<strong>No. Pembelian :</strong> <?php echo $detail['id_pembelian']; ?><br>
		<strong>Tanggal :</strong> <?php echo date("d F Y",strtotime($detail['tanggal_pembelian'])); ?><br>
		<strong>Total : Rp.</strong> <?php echo number_format($detail['total_pembelian']) ;?><br>	
	</div>
	<div class="col-md-4">
		<h3><strong>Pelanggan</strong></h3>
		<strong>Nama Pelanggan :</strong> <?php echo $detail['nama_pelanggan']; ?><br>
		<strong>No. Telp :</strong> <?php echo $detail['telepon_pelanggan']; ?><br>
		<strong>Email :</strong> <?php echo $detail['email_pelanggan'] ;?><br>	
	</div>
	<div class="col-md-4">
		<h3><strong>Pengiriman</strong></h3>
		<strong>Alamat :</strong> <?php echo $detail['tipe'];?> <?php echo 	$detail['distrik'] ;?> <?php echo $detail['provinsi']; ?><br>
		<strong>Ekspedisi : </strong> <?php echo $detail['ekspedisi'] ;?> <?php echo $detail['paket'] ?> <?php echo $detail['estimasi'] ?><br>
		<strong>Alamat :</strong>  <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>
<br> 




<br>
<table class="table table-bordered ">
	<thead>
		<tr>
			<th><center>NO</center></th>
			<th><center>NAMA PRODUK</center></th>
			<th><center>HARGA</center></th>
			<th><center>JUMLAH</center></th>
			<th><center>SUBTOTAL</center></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php $nomor=1 ; ?>
			<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON 
				pembelian_produk.id_produk=produk.id_produk 
				WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
				<?php while ($pecah=$ambil->fetch_assoc()) { ?>
					<td><?php echo $nomor ; ?></td>
					<td><?php echo $pecah['nama_produk']; ?></td>
					<td>Rp.<?php echo number_format($pecah['harga_produk']) ; ?></td>	
					<td><?php echo $pecah['jumlah']; ?></td>
					<td>Rp.<?php echo number_format($pecah['harga_produk']*$pecah['jumlah']) ; ?></td>
				</tr>
				<?php $nomor++ ?>
			<?php } ?>
		</tbody>
	</table>
<a href="index.php?halaman=pembelian" class="btn btn-danger">KEMBALI</a>