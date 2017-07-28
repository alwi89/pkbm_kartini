<script type="text/javascript" src="jquery/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	$(function(){
		
		$('#data').DataTable({
			"ordering": false
		});
		
		tinymce.init({
		    selector: '#isi_berita',
		    paste_data_images: true,
		    plugins: [
		      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
		      'save table contextmenu directionality emoticons template paste textcolor'
		    ],
		    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview fullpage | forecolor backcolor emoticons',
		    image_advtab: true,
		    /*
		    images_upload_url: 'jquery/tinymce/tiny_image_uploader.php',
		    images_upload_credentials: true,
		    images_upload_base_path: '../../upload',
		    */
		    file_picker_callback: function(callback, value, meta) {
		      if (meta.filetype == 'image') {
		        $('#upload').trigger('click');
		        $('#upload').on('change', function() {
		          var file = this.files[0];
		          var reader = new FileReader();
		          reader.onload = function(e) {
		            callback(e.target.result, {
		              alt: ''
		            });
		          };
		          reader.readAsDataURL(file);
		        });
		      }
		    },
		 });
		/*
		tinymce.activeEditor.uploadImages(function(success) {
		  $.post('jquery/tinymce/tiny_image_uploader.php', tinymce.activeEditor.getContent()).done(function() {
		    console.log("Uploaded images and posted content as an ajax request.");
		  });
		});
		*/

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
	                        message: 'Judul harus diisi'
	                    },
	                }
	            }
	        }
	    });
});
</script>
<ol class="breadcrumb custom-breadcrumb">
    <li class="active">KEBUDAYAAN</li>
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
	Data KEBUDAYAAN<br />
	<?php
    if(isset($_GET['id'])){
        $a = query("select * from berita where id_berita='$_GET[id]'");
        $b = mysqli_fetch_array($a);
    }
    ?>
	<form class="form-horizontal" id="form-input" method="post" action="berita_proses.php" enctype="multipart/form-data">
		<input type="hidden" name="aksi" value="<?php echo isset($b)?'edit':'tambah'; ?>" />
		<input type="hidden" name="kategori" value="kebudayaan" />
		<input type="hidden" name="kode_lama" value="<?php echo isset($b)?$b['id_berita']:''; ?>" />
		<div class="form-group">
			<label class="col-md-3 control-label">Judul</label>
			<div class="col-md-9">
				<input type="text" name="judul" class="form-control" placeholder="input judul berita" value="<?php echo isset($b)?$b['judul']:''; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Cover</label>
			<div class="col-md-4">
				<input type="file" name="cover">
				<?php
				if(isset($b)&&$b['cover']!=''){
				?>
					<br /><img src="berita/<?php echo $b['cover']; ?>" width="50" height="50">
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Sumber</label>
			<div class="col-md-9">
				<input type="text" name="sumber" class="form-control" placeholder="input sumber" value="<?php echo isset($b)?$b['sumber']:''; ?>">
			</div>
		</div>
		<div class="form-group">
			<textarea name="isi" id="isi_berita"><?php echo isset($b)?$b['isi']:'isi berita....'; ?></textarea>
			<input name="image" type="file" id="upload" style="display: none;" onchange="">
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-9">
				<input type="submit" value="Simpan" class="btn btn-success">
				<a href="?h=kebudayaan"><input type="button" value="Batal" class="btn btn-danger"></a>
			</div>
		</div>
	</form>
	<table id="data" class="table table-bordered table-hover" cellspacing="0" width="100%">
                	<thead>
                        <tr>
                            <th>Id Berita</th>
                            <th>Judul</th>
                            <th>Tgl Post</th>
                            <th>Sumber</th>
                            <th>Isi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                        $x = query("select * from berita where kategori='kebudayaan' order by id_berita desc");
                        while($y = mysqli_fetch_array($x)){
                        ?>
                        <tr>
                            <td><?php echo $y['id_berita']; ?></td>
                            <td><?php echo $y['judul']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($y['tgl_post'])); ?></td>
                            <td><?php echo $y['sumber']; ?></td>
                            <td><?php echo substr(strip_tags($y['isi']), 0, 100).'....'; ?></td>
                            <td><?php echo $y['cover']!=''?"<img src=\"berita/$y[cover]\" width=\"50\" height=\"50\" />":'no image'; ?></td>
                            <td align="center">
                            	<a href="?h=kebudayaan&id=<?php echo $y['id_berita']; ?>" title="edit"><img src="images/edit.png" width="20" height="20" /></a>
                                <a href="berita_proses.php?id=<?php echo $y['id_berita']; ?>&k=kebudayaan" title="hapus" onclick="return confirm('yakin menghapus?')"><img src="images/remove.png" width="20" height="20" /></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
</div>
	

