<?php
	$action = "modules/act_peserta.php";
	$act = @$_GET['act'];
	switch ($act) {
		case 'view':
			if (isset($_GET['idlokasi'])) {
				//query untuk menampilkan nama lokasi
				$query = mysql_query("SELECT * FROM tb_lokasi 
								WHERE id_lok = '$_GET[idlokasi]'") or die(mysql_error());
				$lokasi = mysql_fetch_assoc($query);
				
				//Query untuk menampilkan data peserta
				$query2 = mysql_query("SELECT * FROM tb_peserta 
								WHERE id_lokasi = '$_GET[idlokasi]'") or die(mysql_error());
				$jumlah = mysql_num_rows($query2);
				echo "<h1>Jumlah Peserta Dari <u style=\"color:#FF851B;\">".$lokasi['tuk']."</u> : ".$jumlah." Orang</h1>";
				echo"<ul>";
					while ($b = mysql_fetch_assoc($query2)) {
						echo"<li>".$b['nama']."</li>";
					}
					
				echo"</ul>";
				echo"<p align='center'>
					Kembali ke halaman depan : <a href=\"javascript:void(0);\" onclick=\"window.history.back()\" class='link'>Kembali</a>
				</p>";
			} elseif (isset($_GET['idskema'])) {
				//query untuk menampilkan nama lokasi
				$query = mysql_query("SELECT * FROM tb_skema 
								WHERE id_skema = '$_GET[idskema]'") or die(mysql_error());
				$skema = mysql_fetch_assoc($query);
				
				//Query untuk menampilkan data peserta
				$query2 = mysql_query("SELECT * FROM tb_peserta 
								WHERE id_skema = '$_GET[idskema]'") or die(mysql_error());
				$jumlah = mysql_num_rows($query2);
				echo "<h1>Jumlah Peserta Dari <u style=\"color:#FF851B;\">".$skema['nama_skema']."</u> : ".$jumlah." Orang</h1>";
				echo"<ul>";
					while ($b = mysql_fetch_assoc($query2)) {
						echo"<li>".$b['nama']."</li>";
					}
					
				echo"</ul>";
				echo"<p align='center'>
					Kembali ke halaman depan : <a href=\"javascript:void(0);\" onclick=\"window.history.back()\" class='link'>Kembali</a>
				</p>";
			}
			else {
				echo"<script>
					alert('Data peserta tidak ditemukan...');
					window.location=('index.php')
				</script>";
			}
			break;
		case 'form':
			if (isset($_GET['id'])) {
				$query = mysql_query("SELECT * FROM tb_peserta WHERE id = '$_GET[id]'") or die(mysql_error());
				$temukan = mysql_num_rows($query);
				if ($temukan > 0) {
					$a = mysql_fetch_assoc($query);
					$aksiq = $action . "?mod=peserta&act=edit";
				} else {
					echo"<script>
						alert('Data peserta tidak ditemukan...');
						window.location=('index.php')
					</script>";
				}
			} else {
				$aksiq = $action . "?mod=peserta&act=simpan";
			}
			echo"<form action='".$aksiq."' class='form' method='post'>
				<input type='hidden' name='id' value='"?><?php echo isset($a['id']) ? $a['id'] : '';?><?php echo"'>
				<table width='100%'>
					<tr>
						<td width='190px'>NIK</td>
						<td width='10px'>:</td>
						<td><input type='text' name='nik' placeholder='nik...' value='"?><?php echo isset($a['nik']) ? $a['nik'] : '';?><?php echo"' required></td>
					</tr>
					<tr>
						<td>NAMA</td>
						<td>:</td>
						<td><input type='text' name='nama' placeholder='nama...' value='"?><?php echo isset($a['nama']) ? $a['nama'] : '';?><?php echo"' required></td>
					</tr>
					<tr>
						<td>ALAMAT</td>
						<td>:</td>
						<td><input type='text' name='alamat' placeholder='alamat...' value='"?><?php echo isset($a['alamat']) ? $a['alamat'] : '';?><?php echo"' required></td>
					</tr>
					<tr>
						<td>TGL. LAHIR</td>
						<td>:</td>
						<td><input type='date' name='tgl_lahir' id='datepicker' placeholder='99/99/1999' value='"?><?php echo isset($a['tgl_lahir']) ? $a['tgl_lahir'] : '';?><?php echo"' required></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type='email' name='email' placeholder='email...' value='"?><?php echo isset($a['email']) ? $a['email'] : '';?><?php echo"' required></td>
					</tr>
					<tr>
						<td>HP</td>
						<td>:</td>
						<td><input type='text' name='hp' placeholder='nomor handphone...' value='"?><?php echo isset($a['hp']) ? $a['hp'] : '';?><?php echo"' required></td>
					</tr>
					<tr>
						<td>Organisasi</td>
						<td>:</td>
						<td><input type='text' name='organisasi' value='"?><?php echo isset($a['organisasi']) ? $a['organisasi'] : '';?><?php echo"' placeholder='Orgnisasi...' required></td>
					</tr>
					<tr>
						<td>Lokasi</td>
						<td>:</td>
						<td>
							<select name='lokasi'>";
							$query=mysql_query("SELECT * FROM tb_lokasi");
							while($ab=mysql_fetch_assoc($query)) {
								if ($ab['id_lok'] == @$a['id_lokasi']) {
									echo "<option value='".$ab['id_lok']."' selected>".$ab['tuk']."</<option>";
								} else {
									echo "<option value='".$ab['id_lok']."'>".$ab['tuk']."</<option>";
								}
								
							}
							echo"</select>
						</td>
					</tr>
					<tr>
						<td>Skema Sertifikasi</td>
						<td>:</td>
						<td>
							<select name='skema'>";
							$query2=mysql_query("SELECT * FROM tb_skema");
							while($b = mysql_fetch_assoc($query2)) {
								if ($b['id_skema'] == @$a['id_skema']) {
									echo "<option value='".$b['id_skema']."' selected>".$b['nama_skema']."</<option>";
								} else {
									echo "<option value='".$b['id_skema']."'>".$b['nama_skema']."</<option>";
								}
								
							}
							echo"</select>
						</td>
					</tr>
					<tr>
						<td>Lokasi</td>
						<td>:</td>
						<td>
							<select name='rekomendasi'>
								<option value='BERKOMPETENSI' "?><?php echo (isset($a['rekomendasi']) AND ($a['rekomendasi'] == 'BERKOMPETENSI')) ? 'selected' : '';?><?php echo">BERKOMPETENSI</option>
								<option value='BELUM BERKOMPETENSI' "?><?php echo (isset($a['rekomendasi']) AND ($a['rekomendasi'] == 'BELUM BERKOMPETENSI')) ? 'selected' : '';?><?php echo">BELUM BERKOMPETENSI</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tgl. Terbit Sertifikat</td>
						<td>:</td>
						<td><input type='date' name='tgl_terbit' id='datepicker' placeholder='99/99/1999' value='"?><?php echo isset($a['tgl_terbit']) ? $a['tgl_terbit'] : '';?><?php echo"' required></td>
					</tr>
					<tr>
						<td colspan='3'>
							<input type='submit' value='Simpan'>
							<input type='button' value='Batal' onclick=self.history.back()>
						</td>
					</tr>
				</table>
			</form>";
			break;
		default:
			echo"<table class='table'>
				<tr>
					<th>#</th>
					<th>NIK</th>
					<th>NAMA</th>
					<th>ALAMAT</th>
					<th>TGL. LAHIR</th>
					<th>NO. HP</th>
					<th>EMAIL</th>
					<th>ORGANISASI</th>
					<th>REKOMENDASI</th>
					<th>TGL. TERBIT S.</th>
					<th>AKSI</th>
				</tr>";
				$query = "SELECT a.*, b.tuk, c.nama_skema FROM tb_peserta a 
							LEFT JOIN tb_lokasi b ON a.id_lokasi = b.id_lok 
							LEFT JOIN tb_skema c ON a.id_skema = c.id_skema 
							ORDER BY a.tgl_lahir ASC";
				$result = mysql_query($query) or die(mysql_error());
				$temukan = mysql_num_rows($result);
				if ($temukan > 0) {
					$no = 1;
					while ($data = mysql_fetch_assoc($result)) {
						echo"<tr>
							<td>".$no."</td>
							<td><b>".$data['nik']."</b></td>
							<td>".$data['nama']."<br>
								<small><a href='formser.php?mod=peserta&act=view&idskema=".$data['id_skema']."' class='link'>".$data['nama_skema']." </a> - <a href='formser.php?mod=peserta&act=view&idlokasi=".$data['id_lokasi']."' class='link'>".$data['tuk']." </a></small></td>
							<td>".$data['alamat']."</td>
							<td>".$data['tgl_lahir']."</td>
							<td>".$data['hp']."</td>
							<td>".$data['email']."</td>
							<td>".$data['organisasi']."</td>
							<td>".$data['rekomendasi']."</td>
							<td>".$data['tgl_terbit']."</td>
							<td width='50px' align='center'><a href='formser.php?mod=peserta&act=form&id=".$data['id']."'>Ubah</a> 
								<a href='".$action."?mod=peserta&act=hapus&id=".$data['id']."' onclick=\"return confirm('Yakin ingin menghapus data?');\">Hapus</a></td>
						</tr>";
						$no++;
					}
				}
			echo"</table>";
			echo"<p>Jumlah Peserta Tedaftar : <b>".$temukan."</b> Orang</p>";
			break;
	}
?>