@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Slide</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('slide.create') }}" class="btn btn-primary btn-sm mb-3">+ Slide Banner</a>
						<h6><font size="2">* Tambahkan gambar banner, untuk tampilan atas slide banner toko</font></h6>
						<h6><font size="2">* Jika akan upload banner lebih dari satu, ukuran tiap banner harus sama. Contoh semua banner harus : 820x312 dalam pixel </font></h6>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Gambar</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($slide as $item)
								<tr>
									<td>{{ $item->gambar }}</td>
									<td>
										<a href="{{ route('slide.destroy',$item->id_slide) }}" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
										<form action="{{ route('slide.destroy',$item->id_slide) }}" method="post">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					{{ $slide->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection