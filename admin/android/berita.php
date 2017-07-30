<?php
require_once("../koneksi.php");
//$_POST['aksi'] = 'semua';
if(isset($_POST['aksi'])){
	$aksi = escape($_POST['aksi']);
	if($aksi=='hot news'){
		$query = query("select * from berita order by id_berita desc limit 5");
		$jml = mysqli_num_rows($query);
		if($jml==0){
			$data[] = null;
		}else{
			while($result = mysqli_fetch_array($query)){
				$data[] = array('id_berita' => $result['id_berita'], 'judul' => $result['judul'], 'tgl_post' => date('d/m/Y H:i:s', strtotime($result['tgl_post'])), 'isi' => substr(strip_tags($result['isi']), 0, 60).'....', 'cover' => $result['cover']);
			}
		}
		echo json_encode($data);
	}else if($aksi=='semua'){
		$query = query("select * from berita order by id_berita desc");
		$jml = mysqli_num_rows($query);
		if($jml==0){
			$data[] = null;
		}else{
			while($result = mysqli_fetch_array($query)){
				$data[] = array('id_berita' => $result['id_berita'], 'judul' => $result['judul'], 'tgl_post' => date('d/m/Y H:i:s', strtotime($result['tgl_post'])), 'isi' => substr(strip_tags($result['isi']), 0, 60).'....', 'cover' => $result['cover']);
			}
		}
		echo json_encode($data);
	}else if($aksi=='detail'){
		$id_berita = escape($_POST['id_berita']);
		query("update berita set dilihat=dilihat+1 where id_berita='$id_berita'");
		$query = query("select * from berita where id_berita='$id_berita'");
		$jml = mysqli_num_rows($query);
		if($jml==0){
			$data[] = null;
		}else{
			while($result = mysqli_fetch_array($query)){
				$isi = "<br /><font color='#5D53A9'>dilihat : ".$result['dilihat'].' kali</font>';
				$isi .= "&nbsp; , &nbsp; kategori : <font color='red'>".$result['kategori'].'</font><br />';
				$isi .= $result['isi'];
				$isi .= "<font color='red'>sumber : ".$result['sumber'].'</font>';
				$data[] = array('id_berita' => $result['id_berita'], 'judul' => $result['judul'], 'tgl_post' => date('d/m/Y H:i:s', strtotime($result['tgl_post'])), 'isi' => $isi, 'cover' => $result['cover']);
			}
		}
		echo json_encode($data);
	}
}
?>