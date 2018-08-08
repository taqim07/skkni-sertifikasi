<?php 
	include"../config/database.php";


	$mod = @$_GET['mod'];
	$act = @$_GET['act'];


	if ($mod == 'peserta' AND $act == 'simpan') {
if (!is_numeric($_POST['nik'])) {
			echo"<script>
				alert('NIK harus angka...');
				window.history.back()
			</script>";
		} elseif (!is_numeric($_POST['hp'])) {
			echo"<script>
				alert('Nomor hp angka...');
				window.history.back()
			</script>";
		} else {
		mysql_query("INSERT INTO tb_peserta(id, 
											nik, 
											id_skema, 
											id_lokasi, 
											nama,
											alamat, 
											tgl_lahir, 
											hp, 
											email, 
											organisasi, 
											rekomendasi,
											tgl_terbit)
									VALUES(NULL, 
											'".$_POST['nik']."', 
											'".$_POST['skema']."', 
											'".$_POST['lokasi']."', 
											'".$_POST['nama']."',
											'".$_POST['alamat']."', 
											'".$_POST['tgl_lahir']."', 
											'".$_POST['hp']."', 
											'".$_POST['email']."', 
											'".$_POST['organisasi']."', 
											'".$_POST['rekomendasi']."', 
											'".$_POST['tgl_terbit']."')") or die(mysql_error());
		echo"<script>
			alert('Berhasil melakukan input data peserta...');
			window.location=('../index.php')
		</script>";
		}
	} elseif ($mod == 'peserta' AND $act == 'edit') {
		mysql_query("UPDATE tb_peserta SET nik = '".$_POST['nik']."', 
											id_skema = '".$_POST['skema']."', 
											id_lokasi = '".$_POST['lokasi']."', 
											nama = '".$_POST['nama']."',
											alamat = '".$_POST['alamat']."', 
											tgl_lahir = '".$_POST['tgl_lahir']."', 
											hp = '".$_POST['hp']."', 
											email = '".$_POST['email']."', 
											organisasi = '".$_POST['organisasi']."', 
											rekomendasi = '".$_POST['rekomendasi']."', 
											tgl_terbit = '".$_POST['tgl_terbit']."' 
					WHERE id = '".$_POST['id']."'") or die(mysql_error());

		echo"<script>
			alert('Berhasil melakukan edit data peserta...');
			window.location=('../index.php')
		</script>";

	} elseif ($mod == 'peserta' AND $act == 'hapus') {
		mysql_query("DELETE FROM tb_peserta WHERE id = '".$_GET['id']."'") or die(mysql_error());

		echo"<script>
			alert('Berhasil melakukan hapus data peserta...');
			window.location=('../index.php')
		</script>";
	}
?>