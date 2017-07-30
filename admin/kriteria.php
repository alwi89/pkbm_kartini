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
				kategori: {
	                validators: {
	                    notEmpty: {
	                        message: 'Kategori harus dipilih'
	                    },
	                }
	            },
	            katakunci: {
	                validators: {
	                    notEmpty: {
	                        message: 'Kata Kunci harus diisi'
	                    },
	                }
	            }
	        }
	    });
});
</script>
<ol class="breadcrumb custom-breadcrumb">
    <li class="active">Kriteria Kategori</li>
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
	Data Berita<br />
	<?php
    if(isset($_GET['id'])){
        $a = query("select * from kriteria where id_kriteria='$_GET[id]'");
        $b = mysqli_fetch_array($a);
    }
    ?>
	<form class="form-horizontal" id="form-input" method="post" action="kriteria_proses.php" enctype="multipart/form-data">
		<input type="hidden" name="aksi" value="<?php echo isset($b)?'edit':'tambah'; ?>" />
		<input type="hidden" name="kode_lama" value="<?php echo isset($b)?$b['id_kriteria']:''; ?>" />
		<div class="form-group">
			<label class="col-md-3 control-label">Kategori</label>
			<div class="col-md-9">
				<select name="kategori" class="form-control">
					<option value="pendidikan" <?php echo isset($b)&&$b['kategori']=='pendidikan'?'selected':''; ?>>pendidikan</option>
					<option value="olahraga" <?php echo isset($b)&&$b['kategori']=='olahraga'?'selected':''; ?>>olahraga</option>
					<option value="kebudayaan" <?php echo isset($b)&&$b['kategori']=='kebudayaan'?'selected':''; ?>>kebudayaan</option>
					<option value="iptek" <?php echo isset($b)&&$b['kategori']=='iptek'?'selected':''; ?>>iptek</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Kata Kunci</label>
			<div class="col-md-9">
				<input type="text" name="katakunci" class="form-control" value="<?php echo isset($b)?$b['kata_kunci']:''; ?>" placeholder="input kata kunci">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-9">
				<input type="submit" value="Simpan" class="btn btn-success">
				<a href="?h=berita"><input type="button" value="Batal" class="btn btn-danger"></a>
			</div>
		</div>
	</form>
	<table id="data" class="table table-bordered table-hover" cellspacing="0" width="100%">
                	<thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Kata Kunci</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                        $x = query("select * from kriteria order by kategori asc, kata_kunci asc");
                        while($y = mysqli_fetch_array($x)){
                        ?>
                        <tr>
                            <td><?php echo $y['kategori']; ?></td>
                            <td><?php echo $y['kata_kunci']; ?></td>
                            <td align="center">
                            	<a href="?h=kriteria&id=<?php echo $y['id_kriteria']; ?>" title="edit"><img src="images/edit.png" width="20" height="20" /></a>
                                <a href="kriteria_proses.php?id=<?php echo $y['id_kriteria']; ?>" title="hapus" onclick="return confirm('yakin menghapus?')"><img src="images/remove.png" width="20" height="20" /></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
</div>
	

