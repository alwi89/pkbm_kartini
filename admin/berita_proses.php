<?php
session_start();
require_once("koneksi.php");
if(!isset($_POST['aksi'])){
	$id_berita = urldecode($_GET['id']);
	$a = query("delete from berita where id_berita='$id_berita'");
	if($a){
		setcookie("berhasil", "berhasil menghapus berita", time()+2);
	}else{
		setcookie("gagal", "gagal menghapus berita", time()+2);
	}
	header("location:index.php?h=berita");
}else if($_POST['aksi']=='tambah'){
	$judul = escape($_POST['judul']);
	$pesan_hasil = '';
	$sumber = escape($_POST['sumber']);
	$jenis_kategori = escape($_POST['jenis_kategori']);
	//jika kategori manual
	if($jenis_kategori=='manual'){
		$kategori = escape($_POST['kategori']);
		$pesan_hasil = 'kategori : '.$kategori;
	//jika kategori otomatis
	}else{
		//1. pisahkan tags untuk isi beritanya supaya mendapatkan teks murni tanpa format besar, warna, jenis font, dll
		$temp_isi = strip_tags($_POST['isi']);
		//2. pisahkan menjadi tiap kata dengan patokan spasi adalah pemisahnya dan jadikan sebuah array
		$kata = explode(" ", $temp_isi);
		//3. buat variabel inisialisasi kategori dimana masing2 kategori dianggap 0 persen terlebih dahulu peluangnya
		$pendidikan = 0;
		$olahraga = 0;
		$kebudayaan = 0;
		$iptek = 0;
		//4. cek tiap kata yang telah dipisah, cocokkan dengan tabel pengetahuan yaitu tabel kriteria, jika ketemu masukkan +1 sementera ke masing2 kategori
		for($i=0; $i<sizeof($kata); $i++){
			//5. pengecekan dengan kata_kunci ditabel kriteria
			$query_cek = query("select * from kriteria where kata_kunci ='$kata[$i]'");
			//6. cek apakah ketemu?, jika ketemu berarti ada baris data (tidak 0)
			$barus_cek = mysqli_num_rows($query_cek);
			if($barus_cek>0){
				//7. cek kategorinya apa di tabel kriteria
				$result_cek = mysqli_fetch_array($query_cek);
				$hasil_kategori = $result_cek['kategori'];
				//8. masukkan nilainya ke kategori yang cocok dengan menambahkan satu
				if($hasil_kategori=='pendidikan'){
					$pendidikan += 1;
				}else if($hasil_kategori=='olahraga'){
					$olahraga += 1;
				}else if($hasil_kategori=='kebudayaan'){
					$kebudayaan += 1;
				}else if($hasil_kategori=='iptek'){
					$iptek += 1;
				}
			}
		}
		//9. hitung presentase
		$total = $pendidikan+$olahraga+$kebudayaan+$iptek;
		$presentase_pendidikan = ($pendidikan/$total) * 100;
		$presentase_olahraga = ($olahraga/$total) * 100;
		$presentase_kebudayaan = ($kebudayaan/$total) * 100;
		$presentase_iptek = ($iptek/$total) * 100;
		$label_kategori = array('pendidikan' => $presentase_pendidikan, 'olahraga' => $presentase_olahraga,
									'kebudayaan' => $presentase_kebudayaan, 'iptek' => $presentase_iptek
								);
		$maxs = array_keys($label_kategori, max($label_kategori));
		$kategori = $maxs[0];
		$pesan_hasil = 'kategori terpilih : '.$kategori;
		$pesan_hasil .= '<br />presentase';
		foreach($label_kategori as $key=>$value){
		  //echo $key.' = '.$value.'<br />';
		  $pesan_hasil .= ', '.$key.' = '.$value.'%';
		}
	}
	$isi = $_POST['isi'];
	$gambar = str_replace(" ", "_", $_FILES['cover']['name']);
	$source = $_FILES['cover']['tmp_name'];
	$dest = "berita/$gambar";
	if(strlen($gambar)!=0){
		$a = query("insert into berita(judul, isi, cover, id_admin, kategori, sumber) values('$judul', '$isi', '$gambar', '$_SESSION[adm]', '$kategori', '$sumber')");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("insert into berita(judul, isi, id_admin, kategori, sumber) values('$judul', '$isi', '$_SESSION[adm]', '$kategori', '$sumber')");
	}
	if($a){
		setcookie("berhasil", "berhasil menambah berita<br />$pesan_hasil", time()+2);
	}else{
		setcookie("gagal", "gagal menambah berita, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=berita");
}else if($_POST['aksi']=='edit'){
	$kode_lama = escape($_POST['kode_lama']);
	$judul = escape($_POST['judul']);
	$pesan_hasil = '';
	$sumber = escape($_POST['sumber']);
	$jenis_kategori = escape($_POST['jenis_kategori']);
	//jika kategori manual
	if($jenis_kategori=='manual'){
		$kategori = escape($_POST['kategori']);
		$pesan_hasil = 'kategori : '.$kategori;
	//jika kategori otomatis
	}else{
		//1. pisahkan tags untuk isi beritanya supaya mendapatkan teks murni tanpa format besar, warna, jenis font, dll
		$temp_isi = strip_tags($_POST['isi']);
		//2. pisahkan menjadi tiap kata dengan patokan spasi adalah pemisahnya dan jadikan sebuah array
		$kata = explode(" ", $temp_isi);
		//3. buat variabel inisialisasi kategori dimana masing2 kategori dianggap 0 persen terlebih dahulu peluangnya
		$pendidikan = 0;
		$olahraga = 0;
		$kebudayaan = 0;
		$iptek = 0;
		//4. cek tiap kata yang telah dipisah, cocokkan dengan tabel pengetahuan yaitu tabel kriteria, jika ketemu masukkan +1 sementera ke masing2 kategori
		for($i=0; $i<sizeof($kata); $i++){
			//5. pengecekan dengan kata_kunci ditabel kriteria
			$query_cek = query("select * from kriteria where kata_kunci ='$kata[$i]'");
			//6. cek apakah ketemu?, jika ketemu berarti ada baris data (tidak 0)
			$barus_cek = mysqli_num_rows($query_cek);
			if($barus_cek>0){
				//7. cek kategorinya apa di tabel kriteria
				$result_cek = mysqli_fetch_array($query_cek);
				$hasil_kategori = $result_cek['kategori'];
				//8. masukkan nilainya ke kategori yang cocok dengan menambahkan satu
				if($hasil_kategori=='pendidikan'){
					$pendidikan += 1;
				}else if($hasil_kategori=='olahraga'){
					$olahraga += 1;
				}else if($hasil_kategori=='kebudayaan'){
					$kebudayaan += 1;
				}else if($hasil_kategori=='iptek'){
					$iptek += 1;
				}
			}
		}
		//9. hitung presentase
		$total = $pendidikan+$olahraga+$kebudayaan+$iptek;
		$presentase_pendidikan = ($pendidikan/$total) * 100;
		$presentase_olahraga = ($olahraga/$total) * 100;
		$presentase_kebudayaan = ($kebudayaan/$total) * 100;
		$presentase_iptek = ($iptek/$total) * 100;
		$label_kategori = array('pendidikan' => $presentase_pendidikan, 'olahraga' => $presentase_olahraga,
									'kebudayaan' => $presentase_kebudayaan, 'iptek' => $presentase_iptek
								);
		$maxs = array_keys($label_kategori, max($label_kategori));
		$kategori = $maxs[0];
		$pesan_hasil = 'kategori terpilih : '.$kategori;
		$pesan_hasil .= '<br />presentase';
		foreach($label_kategori as $key=>$value){
		  //echo $key.' = '.$value.'<br />';
		  $pesan_hasil .= ', '.$key.' = '.$value.'%';
		}
	}
	$isi = $_POST['isi'];
	$gambar = str_replace(" ", "_", $_FILES['cover']['name']);
	$source = $_FILES['cover']['tmp_name'];
	$dest = "berita/$gambar";
	if(strlen($gambar)!=0){
		$a = query("update berita set judul='$judul', isi='$isi', id_admin='$_SESSION[adm]', cover='$gambar', kategori='$kategori', sumber='$sumber' where id_berita='$kode_lama'");
		if($a){
			@copy($source, $dest);
		}
	}else{
		$a = query("update berita set judul='$judul', isi='$isi', id_admin='$_SESSION[adm]', kategori='$kategori', sumber='$sumber' where id_berita='$kode_lama'");
	}
	if($a){
		setcookie("berhasil", "berhasil mengedit berita<br />$pesan_hasil", time()+2);
	}else{
		setcookie("gagal", "gagal mengedit berita, ".mysqli_error(), time()+2);
	}
	header("location:index.php?h=berita");
}
?>