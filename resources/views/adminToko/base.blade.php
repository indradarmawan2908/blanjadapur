<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $title }}</title>
    
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css">
	@if(isset($datatable))
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
	@endif

	@if(isset($news))
	<link rel="stylesheet" type="text/css" href="{{ asset('css/newsticker.css') }}">
	@endif

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body style="padding-top: 0px !important;">

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">{{ Auth::guard('toko')->user()->nm_toko }}</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}">Home</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="produkDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produk</a>
						<div class="dropdown-menu" aria-labelledby="produkDropdown">
							<a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori</a>
							<a class="dropdown-item" href="{{ route('produk.index') }}">Produk</a>
						</div>
					</li>
					<li class="nav-item"><a class="nav-link" href="{{ route('orderan.index') }}">Order</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ route('memberku.index') }}">Member</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ route('slide.index') }}">Slide</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}">News</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ route('bank.index') }}">Bank</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ route('broadcast.index') }}">Broadcast</a></li>
				</ul>
				<form class="form-inline my-2 my-lg-0" action="{{ route('cari.show','q') }}">
					<input class="form-control mr-sm-2" type="search" placeholder="Cari..." aria-label="Search" name="cari">
				</form>
				<ul class="navbar-nav navbar-right">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::guard('toko')->user()->nm_toko }}</a>
						<div class="dropdown-menu" aria-labelledby="profilDropdown">
							<a class="dropdown-item" href="{{ route('profil.index') }}">Profil Toko</a>
							<a class="dropdown-item" href="{{ route('profil.index') }}">Bantuan</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('tokoku.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
							<form id="logout-form" action="{{ route('tokoku.logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	@if(Auth::guard('toko')->user()->logo_toko=="" || Auth::guard('toko')->user()->jadwal_buka=="")
	<div class="alert alert-danger">
		Data toko belum lengkap. Silahkan lengkapi profilmu <a href="{{ route('profil.index') }}">disini</a>
	</div>
	@endif

	@if($news->count() > 0)
	<div class="container">
		<div class="breakingNews" id="bn1">
	    	<div class="bn-title"><h2>Pengumuman</h2><span></span></div>
	        <ul>
	        @foreach($news as $item)
				<li><a href="#" class="modalNews" data-judul="{{ $item->judul }}" data-isi="{{ $item->isi }}">{{ $item->judul }}</a></li>
			@endforeach
	        </ul>
	        <div class="bn-navi">
	        	<span></span>
	            <span></span>
	        </div>
	    </div>
	</div>
	@endif

	@if(session()->get('error'))
	<div class="container">
		<div class="alert alert-danger">
		{{ session()->get('error') }}  
		</div>
	</div>
    @endif
    @if(session()->get('success'))
	<div class="container">
		<div class="alert alert-success">
		{{ session()->get('success') }}  
		</div>
	</div>
	@endif

	@yield('main')

	<!-- Modal -->
	<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body"></div>
	    </div>
	  </div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

	@if(isset($datatable))
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$('.datatableBiasa').DataTable({
	        dom: 'Bfrtip',
	        buttons: [
	            'copyHtml5',
	            'excelHtml5',
	            'csvHtml5',
	            'pdfHtml5'
	        ]
	    });

	    $('.datatable').DataTable();
	    $('.datatableO').DataTable({
	    	"order": [[ 2, "desc" ]]
	    });
	    $('.datatableO2').DataTable({
	    	"order": [[ 1, "desc" ]]
	    });
	});
	</script>
	@endif

	@yield('scripts')

	@if(isset($news))
	<script type="text/javascript" src="{{ asset('js/newsticker.js') }}"></script>
	<script type="text/javascript">
	$(function(){
		$("#bn1").breakingNews({
			effect		:"slide-h",
			autoplay	:true,
			timer		:2000,
			color		:"red"
		});

		$('.modalNews').on('click', function (e) {
			e.preventDefault();
			var judul = $(this).data('judul');
			var isi = $(this).data('isi');
			$('#newsModal').modal('show');
			$('#newsModal .modal-title').text(judul);
			$('#newsModal .modal-body').html(isi);
		})
	});
	</script>
	@endif
	<script type="text/javascript">
		$(function() {
	        $('.cPicker').colorpicker();
	        $('[data-toggle="tooltip"]').tooltip();
	        $('.summernote').summernote({ tabsize: 2, height: 100, toolbar: [
	        	// [groupName, [list of button]]
			    ['style', ['bold', 'italic', 'underline', 'clear']],
			    ['font', ['strikethrough', 'superscript', 'subscript']],
			    ['fontsize', ['fontsize']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['height', ['height']]
			  ]
			});
		});
	</script>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	<script type="text/javascript">
		var baseUrl = "{{ route('rajaongkir.index') }}";

		$(document).ready(function(e){
			$.ajax({
			  method: "GET",
			  url: baseUrl,
			  dataType: "json",
			  complete: function(xhr, status){

			  },success: function(result, xhr, status){
			  	$.each(result, function (i, item) {
				    $('.provinsi').append($('<option>', { 
				        value: item.province_id,
				        text : item.province 
				    }));
				});
			  },error: function(xhr,status,error){
			  	console.log(error);
			  }
			});
		});

		$(document).on('change', '.provinsi', function(e){
			var prov = $(this).val();
			if(prov.length > 0){
				$.ajax({
				  method: "GET",
				  url: baseUrl+'/'+prov,
				  dataType: "json",
				  complete: function(xhr, status){

				  },success: function(result, xhr, status){
				  	$('.kota').children('option:not(:first)').remove();
				  	$.each(result, function (i, item) {
					    $('.kota').append($('<option>', { 
					        value: item.city_id,
					        text : item.type+" "+item.city_name
					    }));
					});
				  },error: function(xhr,status,error){
				  	console.log(error);
				  }
				});
			}
		});

		$(document).on('click', '#checkAll', function(e){
			$('input:checkbox').not(this).prop('checked', this.checked);
		});
	</script>
</body>
</html>