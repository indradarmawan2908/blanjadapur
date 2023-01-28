<!DOCTYPE html>
<html lang="en">
    <?php Header("Cache-Control: no-transform"); ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $title }}</title>
    <meta name="keywords" content="belanja dapur">
    
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="icon" href="{{ asset('img/toko/'.$toko->logo_toko) }}" type="image/x-icon" />

    <style type="text/css">
    a:active,a:hover,a:visited{
    	text-decoration: none;
    }
    .lt{
        text-decoration: line-through;
    }
    .kotak{
        position:relative;
    }
    .diskon{
        position: absolute;
        background-color: #ae0000;
        color: #fff;
        padding: 5px;
        right: 0px;
    }
    @if(empty($toko->header))
    .header{
    	background-color: #343a40!important;
    }
    .header a{
    	color: #fff!important;
    }
    @else
    .header{
    	background-color: {{ $toko->header }}!important;
    }
    .header a{
    	color: #fff!important;
    }
    @endif
    @if(empty($toko->icon))
    footer .nav .nav-item .nav-link{
    	color: #3490dc;
    }
    @else
    footer .nav .nav-item .nav-link{
    	color: {{ $toko->icon  }};
    }
    @endif
    @if(empty($toko->tombol))
    .tombol{
    	color: #fff;
    	background-color: #38c172;
    	border: none;
    }
    @else
    .tombol{
    	color: #fff;
    	background-color: {{ $toko->tombol }};
    	border: none;
    }
    @endif
    @if(!empty($toko->nama_produk))    
   	.namaProduk{
    	color: {{ $toko->nama_produk }}!important;
    }
    @endif
    @if(!empty($toko->harga_produk))
    .harga,.harga:visited,.harga:active,.harga:hover{
    	color: {{ $toko->harga_produk }}!important;
    }
    @endif
    </style>
</head>
<body class="mobile" style="padding-top: 56.84px;padding-bottom: 62px;">

	<header>
		<nav class="navbar header">
		    <a class="navbar-brand" href="{{ route('index') }}">
		    	@if(empty($toko->logo_toko))
		    	<img src="https://via.placeholder.com/30x30.png?text={{ substr($toko->nm_toko,0,3) }}" width="120" alt="">
		    	@else
		    	<img src="{{ asset('img/toko/'.$toko->logo_toko) }}" width="120" alt="">
		    	@endif
		    </a>
		    @guest
		    @else
		    <a href="{{ route('keranjang.index') }}" class="float-right"><i class="fa fa-shopping-cart"></i> {{ $duitKeranjang }}</a>
		    @endguest
		</nav>
	</header>

	@yield('main')

	<footer>
		<div class="container">
			<ul class="nav nav-justified">
			  <li class="nav-item"><a class="nav-link" href="{{ route('index') }}"><i class="fa fa-home" style="font-size: 18px;"></i><br>Home</a></li>
			  <!--<li class="nav-item"><a class="nav-link" href="{{ route('ktg.index') }}"><i class="fa fa-th-large" style="font-size: 18px;"></i><br>Kategori</a></li>-->
			  <li class="nav-item"><a class="nav-link" href="{{ route('order.index') }}"><i class="fa fa-calendar-check" style="font-size: 18px;"></i><br>Pesanan</a></li>
			  <li class="nav-item"><a class="nav-link" href="{{ route('member.index') }}"><i class="fa fa-user" style="font-size: 18px;"></i><br>Akun</a></li>
			</ul>
		</div>
	</footer>

	

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  	<script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

  	<script type="text/javascript">
  		$(document).ready(function () {
			//initialize swiper when document ready
			var mySwiper = new Swiper ('.slide', {
			  // Optional parameters
              autoplay: {
                delay: 5000,
                disableOnInteraction: false,
              },
			  roundLengths: true,
			  loop: false
			});

			var mySwiper2 = new Swiper ('.slide2', {
			  // Optional parameters
			  roundLengths: true,
			  slidesPerView: 2.5,
			  spaceBetween: 10,
			  freeMode: true
			});
		});

		$(document).on('click','.tmbPM',function(e){
			var tipe = $(this).data('pm');
			var jumlah = $('#jumlah').val();
			var max = $('#jumlah').attr('max');
			var min = 1;
			var harga = $('#jumlah').data('harga');
			if(tipe=="plus"){
				jumlah = parseInt(jumlah)+1;
				if(jumlah > max){
					jumlah = jumlah - 1;
				}
			}else{
				jumlah = parseInt(jumlah)-1;
				if(jumlah < 1){
					jumlah = 1;
				}
			}
			harga = jumlah * harga;
			$('#jumlah').val(jumlah);
			$('#total').val(harga);
		});

		$(".wrapperTab").swipe( {
     swipeLeft:function(event, direction, distance, duration, fingerCount) {
          $(".nav-tabs li a.active").parent().next('li').find('a').tab('show');
        },
     swipeRight:function(event, direction, distance, duration, fingerCount) {
          $(".nav-tabs li a.active").parent().prev('li').find('a').tab('show');
        },
  });
        var baseUrl = "{{ route('tongkir.index') }}";
        var url = "{{ route('index') }}";
        var token = "{{ csrf_token() }}";
  	</script>
    <script type="text/javascript" src="{{ asset('js/toko.js') }}"></script>
    
</body>
</html>