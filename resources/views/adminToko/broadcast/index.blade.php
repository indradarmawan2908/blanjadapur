@extends('adminToko.base')

@section('main')
<?php session_start(); $_SESSION["izin_admin_toko"] = "iya_deh"; $_SESSION["toko_folder"]=$seo_toko ?>
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Broadcast</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="{{ route('broadcast.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="judul">Judul <span style="color: red">*</span></label>
								<input type="text" name="judul" id="judul" class="form-control" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="pesan">Pesan <span style="color: red">*</span></label>
								<textarea type="text" name="pesan" id="pesan" class="form-control" required> </textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="link">Link (Kosongkan Jika Tidak Ada)</label>
								<input type="text" name="link" id="link" class="form-control">
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="foto">Pilih Foto (Kosongkan Jika Tidak Ada)</label>
								<div class="input-append">
  								  <input id="foto" type="hidden" name="foto" class="form-control col-md-6" style="display: inline;">
								  <button data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn btn-sm btn-default" type="button">Select</button>
								  <button id="hapus_foto" href="javascript:;" onclick="hapus();" class="fade btn btn-sm btn-warning" type="button">Hapus Foto</button>
								  <img id="foto_src" class="fade col-md-6" style="margin-top: 10px; display: block;" src="">
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-sm btn-success">Siarkan</button>
					</form>

					<div class="modal fade" id="myModal" style="width:100%; padding:0px 0px 0px 0px !important; padding-left: 17px; ">
					<div class="modal-dialog" style="max-width: 90%;">
					  <div class="modal-content">
					    <div class="modal-header">
					    	<h4 class="modal-title">File Manager</h4>
					      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					    </div>
					    <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">
					      <iframe width="700" height="400" src="../filemanager/dialog.php?type=2&field_id=foto" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; width: 100%; "></iframe>
					    </div>
					  </div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->

					<script type="text/javascript">
						function hapus(){
							$("#foto_src").addClass("fade");
							$("#foto_src").hide();
							$("#hapus_foto").addClass("fade");
							$("#foto_src").removeAttr("src");
							$("#foto").removeAttr("name");
						}

						function responsive_filemanager_callback(field_id){
							var url=jQuery('#'+field_id).val();
							$('#foto_src').attr('src',url);
							$("#foto_src").removeClass( "fade" );
							$("#foto_src").show();
							$("#hapus_foto").removeClass( "fade" );
						}
					</script>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection