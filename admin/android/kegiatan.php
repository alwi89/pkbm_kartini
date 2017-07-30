<?php
require_once("../koneksi.php");
//$_POST['aksi'] = 'semua';
if(isset($_POST['aksi'])){
	$aksi = escape($_POST['aksi']);
	if($aksi=='semua'){
		$query = query("select * from kegiatan order by id_kegiatan desc");
		$jml = mysqli_num_rows($query);
		if($jml==0){
			$data[] = null;
		}else{
			while($result = mysqli_fetch_array($query)){
				$data[] = array('id_kegiatan' => $result['id_kegiatan'], 'nama_kegiatan' => $result['nama_kegiatan'], 'tgl_upload' => date('d/m/Y H:i:s', strtotime($result['tgl_upload'])), 'tgl_kegiatan' => date('d/m/Y', strtotime($result['tgl_kegiatan'])), 'gambar' => $result['gambar']);
			}
		}
		echo json_encode($data);
	}else if($aksi=='detail'){
		$id_kegiatan = escape($_POST['id_kegiatan']);
		$query = query("select * from kegiatan where id_kegiatan='$id_kegiatan'");
		$jml = mysqli_num_rows($query);
		if($jml==0){
			$data[] = null;
		}else{
			while($result = mysqli_fetch_array($query)){
				$data[] = array('id_kegiatan' => $result['id_kegiatan'], 'nama_kegiatan' => $result['nama_kegiatan'], 'tgl_upload' => date('d/m/Y H:i:s', strtotime($result['tgl_upload'])), 'tgl_kegiatan' => date('d/m/Y', strtotime($result['tgl_kegiatan'])), 'gambar' => $result['gambar']);
			}
		}
		echo json_encode($data);
	}
}
?>