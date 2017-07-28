<?php
require_once("../koneksi.php");
//$_POST['aksi'] = 'semua';
if(isset($_POST['aksi'])){
	$aksi = escape($_POST['aksi']);
	if($aksi=='semua'){
		$query = query("select * from galeri order by id_galeri desc");
		$jml = mysqli_num_rows($query);
		if($jml==0){
			$data[] = null;
		}else{
			while($result = mysqli_fetch_array($query)){
				$data[] = array('id_galeri' => $result['id_galeri'], 'judul' => $result['judul'], 'tgl_upload' => date('d/m/Y H:i:s', strtotime($result['tgl_upload'])), 'gambar' => $result['gambar']);
			}
		}
		echo json_encode($data);
	}
}
?>