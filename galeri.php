<script type="text/javascript">
	$(function(){
		
		
		$('#data').DataTable({
			"ordering": false
		});

		$('#form-input').bootstrapValidator({
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
				judul: {
	                validators: {
	                    notEmpty: {
	                        message: 'Judul Galeri harus diisi'
	                    },
	                }
	            }
	        }
	    });
});
</script>
<ol class="breadcrumb custom-breadcrumb">
    <li class="active">Galeri</li>
</ol>
<?php 
if(isset($_COOKIE['berhasil'])){ 
?>
	<div class="panel panel-success">
    	<div class="panel-heading"><?php echo $_COOKIE['berhasil']; ?></div>
    </div>

<?php } ?>
<?php if(isset($_COOKIE['gagal'])){ ?>
    <div class="panel panel-danger">
    	<div class="panel-heading"><?php echo $_COOKIE['gagal']; ?></div>
    </div>
<?php } ?>
<div class="konten">
	Data Galeri<br />
	<?php
    if(isset($_GET['id'])){
        $a = query("select * from galeri where id_galeri='$_GET[id]'");
        $b = mysqli_fetch_array($a);
    }
    ?>
	<form class="form-horizontal" id="form-input" method="post" action="galeri_proses.php" enctype="multipart/form-data">
		<input type="hidden" name="aksi" value="<?php echo isset($b)?'edit':'tambah'; ?>" />
		<input type="hidden" name="kode_lama" value="<?php echo isset($b)?$b['id_galeri']:''; ?>" />
		<div class="form-group">
			<label class="col-md-3 control-label">Judul Galeri</label>
			<div class="col-md-9">
				<input type="text" name="judul" class="form-control" placeholder="input judul galeri" value="<?php echo isset($b)?$b['judul']:''; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Gambar</label>
			<div class="col-md-4">
				<input type="file" name="gambar">
				<?php
				if(isset($b)&&$b['gambar']!=''){
				?>
					<br /><img src="galeri/<?php echo $b['gambar']; ?>" width="50" height="50">
				<?php } ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-9">
				<input type="submit" value="Simpan" class="btn btn-success">
				<a href="?h=galeri"><input type="button" value="Batal" class="btn btn-danger"></a>
			</div>
		</div>
	</form>
	<table id="data" class="table table-bordered table-hover" cellspacing="0" width="100%">
                	<thead>
                        <tr>
                            <th>Id Galeri</th>
                            <th>Judul</th>
                            <th>Tgl Upload</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                        $x = query("select * from galeri order by id_galeri desc");
                        while($y = mysqli_fetch_array($x)){
                        ?>
                        <tr>
                            <td><?php echo $y['id_galeri']; ?></td>
                            <td><?php echo $y['judul']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($y['tgl_upload'])); ?></td>
                            <td><?php echo $y['gambar']!=''?"<img src=\"galeri/$y[gambar]\" width=\"50\" height=\"50\" />":'no image'; ?></td>
                            <td align="center">
                            	<a href="?h=galeri&id=<?php echo $y['id_galeri']; ?>" title="edit"><img src="images/edit.png" width="20" height="20" /></a>
                                <a href="galeri_proses.php?id=<?php echo $y['id_galeri']; ?>" title="hapus" onclick="return confirm('yakin menghapus?')"><img src="images/remove.png" width="20" height="20" /></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
</div>
	

