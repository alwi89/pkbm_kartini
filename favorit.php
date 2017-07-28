<ol class="breadcrumb custom-breadcrumb">
    <li class="active">Favorit</li>
</ol>
<div class="konten">
	Urutan Terfavorit<br />
	<table id="data" class="table table-bordered table-hover" cellspacing="0" width="100%">
                	<thead>
                        <tr>
                            <th>Id Berita</th>
                            <th>Judul</th>
                            <th>Tgl Post</th>
                            <th>Kategori</th>
                            <th>Sumber</th>
                            <th>Isi</th>
                            <th>Gambar</th>
                            <th>Dilihat</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                        $x = query("select * from berita order by dilihat desc");
                        while($y = mysqli_fetch_array($x)){
                        ?>
                        <tr>
                            <td><?php echo $y['id_berita']; ?></td>
                            <td><?php echo $y['judul']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($y['tgl_post'])); ?></td>
                            <td><?php echo $y['kategori']; ?></td>
                            <td><?php echo $y['sumber']; ?></td>
                            <td><?php echo substr(strip_tags($y['isi']), 0, 100).'....'; ?></td>
                            <td><?php echo $y['cover']!=''?"<img src=\"berita/$y[cover]\" width=\"50\" height=\"50\" />":'no image'; ?></td>
                            <td><?php echo $y['dilihat']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
</div>
	

