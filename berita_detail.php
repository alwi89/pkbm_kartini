
<ol class="breadcrumb custom-breadcrumb">
    <li><a href="javascript:history.go(-1);">Berita</a></li>
    <li class="active">Detail Berita</li>
</ol>
<div class="konten">
	<?php 
    query("update berita set dilihat=dilihat+1 where id_berita='$_GET[id]'");
    $x = query("select * from berita where id_berita='$_GET[id]' order by id_berita desc");
    $y = mysqli_fetch_array($x);
    ?>
    <a href="?h=berita_detail&id=<?php echo $y['id_berita']; ?>"><span style="color: blue;"><?php echo $y['judul']; ?></span></a><br />
    <a href="?h=<?php echo $y['kategori']; ?>"><span style="color: #4CAF50;font-size: 10px;"><i><?php echo $y['kategori']; ?></i></span> |</a>
    <span style="color: red;font-size: 10px;"><i><?php echo date("d/m/Y H:i:s", strtotime($y['tgl_post'])); ?></i></span> |
    <span style="color: #4CAF50;font-size: 10px;"><i>dilihat <?php echo $y['dilihat']; ?> kali</i></span><br />
    <?php echo $y['isi']; ?><br />
    <?php echo $y['sumber']!=''?'sumber : '.$y['sumber']:''; ?>
    <div style="clear: both;">&nbsp;</div>
</div>

	

