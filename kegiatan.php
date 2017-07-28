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
				nama: {
	                validators: {
	                    notEmpty: {
	                        message: 'Nama Kegiatan harus diisi'
	                    },
	                }
	            },
	            tgl_kegiatan: {
	                validators: {
	                    notEmpty: {
	                        message: 'Tgl Kegiatan harus diisi'
	                    },
	                }
	            }
	        }
	    });
	    $("#tgl_kegiatan").datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy',
			todayHighlight: true
		})
		.on('changeDate', function(e) {
	        $('#form-input').bootstrapValidator('revalidateField', $(this).prop('name'));
	    });
});
</script>
<ol class="breadcrumb custom-breadcrumb">
    <li class="active">Kegiatan</li>
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
	Data Kegiatan<br />
	<?php
    if(isset($_GET['id'])){
        $a = query("select * from kegiatan where id_kegiatan='$_GET[id]'");
        $b = mysqli_fetch_array($a);
    }
    ?>
	<form class="form-horizontal" id="form-input" method="post" action="kegiatan_proses.php" enctype="multipart/form-data">
		<input type="hidden" name="aksi" value="<?php echo isset($b)?'edit':'tambah'; ?>" />
		<input type="hidden" name="kode_lama" value="<?php echo isset($b)?$b['id_kegiatan']:''; ?>" />
		<div class="form-group">
			<label class="col-md-3 control-label">Nama Kegiatan</label>
			<div class="col-md-9">
				<input type="text" name="nama" class="form-control" placeholder="input nama kegiatan" value="<?php echo isset($b)?$b['nama_kegiatan']:''; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Tgl Kegiatan</label>
			<div class="col-md-9">
				<input type="text" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" placeholder="dd/mm/yyyy" value="<?php echo isset($b)?date('d/m/Y', strtotime($b['tgl_kegiatan'])):''; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Gambar</label>
			<div class="col-md-4">
				<input type="file" name="gambar">
				<?php
				if(isset($b)&&$b['gambar']!=''){
				?>
					<br /><img src="kegiatan/<?php echo $b['gambar']; ?>" width="50" height="50">
				<?php } ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-9">
				<input type="submit" value="Simpan" class="btn btn-success">
				<a href="?h=kegiatan"><input type="button" value="Batal" class="btn btn-danger"></a>
			</div>
		</div>
	</form>
	<table id="data" class="table table-bordered table-hover" cellspacing="0" width="100%">
                	<thead>
                        <tr>
                            <th>Id Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Tgl Upload</th>
                            <th>Tgl Kegiatan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                        $x = query("select * from kegiatan order by id_kegiatan desc");
                        while($y = mysqli_fetch_array($x)){
                        ?>
                        <tr>
                            <td><?php echo $y['id_kegiatan']; ?></td>
                            <td><?php echo $y['nama_kegiatan']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($y['tgl_upload'])); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($y['tgl_kegiatan'])); ?></td>
                            <td><?php echo $y['gambar']!=''?"<img src=\"kegiatan/$y[gambar]\" width=\"50\" height=\"50\" />":'no image'; ?></td>
                            <td align="center">
                            	<a href="?h=kegiatan&id=<?php echo $y['id_kegiatan']; ?>" title="edit"><img src="images/edit.png" width="20" height="20" /></a>
                                <a href="kegiatan_proses.php?id=<?php echo $y['id_kegiatan']; ?>" title="hapus" onclick="return confirm('yakin menghapus?')"><img src="images/remove.png" width="20" height="20" /></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
</div>
	

