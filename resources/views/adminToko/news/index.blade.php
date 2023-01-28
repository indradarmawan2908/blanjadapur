@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">News</li>
	  </ol>
	</nav>

	@if(session()->get('success'))
    <div class="alert alert-success">
    	{{ session()->get('success') }}  
	</div>
    @endif

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('news.create') }}" class="btn btn-primary btn-sm mb-3" data-toggle="tooltip" title="Tambah news baru">News Baru <i class="fa fa-plus"></i></a>
						<h6><font size="2">* Fitur notifikasi ke member, untuk menyampaikan news, promo, diskon dll.</font></h6>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Tanggal Dibuat</th>
									<th>Judul</th>
									<th>Tampil</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@forelse($newsToko as $item)
								<tr>
									<td>{{ tgl_indo($item->created_at) }}</td>
									<td>{{ $item->judul }}</td>
									@if($item->tampil > 0)
									<td><a href="{{ route('news.tampil',[$item->id_news, 0]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Sembunyikan news">Tampil</a></td>
									@else
									<td><a href="{{ route('news.tampil',[$item->id_news, 1]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Tampilkan news">Tidak</a></td>
									@endif
									<td>
										<a href="{{ route('news.show',$item->id_news) }}" data-toggle="tooltip" class="btn btn-info btn-sm" title="Detail news"><i class="fa fa-search"></i></a>
										<a href="{{ route('news.edit',$item->id_news) }}" data-toggle="tooltip" class="btn btn-primary btn-sm" title="Edit news"><i class="fa fa-edit"></i></a>
										<a href="{{ route('news.destroy',$item->id_news) }}" data-toggle="tooltip" class="btn btn-danger btn-sm btn-hapus" title="Hapus news"><i class="fa fa-trash"></i></a>
										<form action="{{ route('news.destroy',$item->id_news) }}" method="post" style="display: none;">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="4" align="center">Belum ada data</td>
								</tr>
							@endforelse
							</tbody>
						</table>
					</div>
					{{ $newsToko->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection