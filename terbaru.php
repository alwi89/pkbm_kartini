<script type="text/javascript">
	$(function() {
	    $('#konten').easyPaginate({
	        paginateElement: 'section',
	        elementsPerPage: 5,
	        effect: 'climb'
	    });
	});
</script>
<ol class="breadcrumb custom-breadcrumb">
    <li class="active">Terbaru</li>
</ol>
<div class="konten">
	<div id="konten">
	<?php 
    $x = query("select * from berita order by tgl_post desc");
    while($y = mysqli_fetch_array($x)){
    ?>
    <section class="konten-isi">
    	<a href="?h=berita_detail&id=<?php echo $y['id_berita']; ?>"><span style="color: blue;"><?php echo $y['judul']; ?></span></a><br />
    	<a href="?h=<?php echo $y['kategori']; ?>"><span style="color: #4CAF50;font-size: 10px;"><i><?php echo $y['kategori']; ?></i></span> |</a>
        <span style="color: red;font-size: 10px;"><i><?php echo date("d/m/Y H:i:s", strtotime($y['tgl_post'])); ?></i></span><br />
        <?php echo $y['cover']!=''?"<img src=\"admin/berita/$y[cover]\" width=\"100\" height=\"100\" align=\"left\" />":'no image'; ?>
        <?php echo substr(strip_tags($y['isi']), 0, 600).'....'; ?>
        <a href="?h=berita_detail&id=<?php echo $y['id_berita']; ?>">selengkapnya</a>
        <div style="clear: both;">&nbsp;</div>
    </section>
    <?php } ?>
    </div>
</div>

	

