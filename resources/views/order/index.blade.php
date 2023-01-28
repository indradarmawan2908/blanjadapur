@extends('base')

@section('main')
<div class="wrapperTab" style="min-height: 500px;">
	<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="now-tab" data-toggle="tab" href="#now" role="tab" aria-controls="now" aria-selected="true">Saat ini</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Selesai</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="reject-tab" data-toggle="tab" href="#reject" role="tab" aria-controls="reject" aria-selected="false">Batal</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="now" role="tabpanel" aria-labelledby="now-tab">
			<ul class="list-group bg-white mb-3">
			@forelse($order->filter(function($order){ return strstr($order->status,'proses') || strstr($order->status,'pending'); })->sortByDesc('created_at') as $item)
				<li class="list-group-item rounded-0">
					<a href="{{ route('order.show',$item->id_order) }}" class="bg-white mb-3" style="display: block;">
						{{ ucfirst($item->status) }} <br>
						{{ nopesan(Auth::user()->id_toko,$item->id_order,$item->created_at) }} <br>
						{{ tgl_indo($item->created_at) }}
					</a>
				</li>
			@empty
			<li class="list-group-item rounded-0">Tidak ada orderan saat ini.</li>
			@endforelse
			</ul>
		</div>
		<div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
			<ul class="list-group bg-white mb-3">
			@forelse($order->where('status','sukses')->sortByDesc('created_at') as $item)
				<li class="list-group-item rounded-0">
					<a href="{{ route('order.show',$item->id_order) }}" class="bg-white mb-3" style="display: block;">
						{{ ucfirst($item->status) }} <br>
						{{ nopesan(Auth::user()->id_toko,$item->id_order,$item->created_at) }} <br>
						{{ tgl_indo($item->created_at) }}
					</a>
				</li>
			@empty
				<li class="list-group-item rounded-0">Tidak ada orderan yang berhasil.</li>
			@endforelse
			</ul>
		</div>
		<div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="reject-tab">
			<ul class="list-group bg-white mb-3">
			@forelse($order->where('status','batal')->sortByDesc('created_at') as $item)
				<li class="list-group-item rounded-0">
					<a href="{{ route('order.show',$item->id_order) }}" class="bg-white mb-3" style="display: block;">
						{{ ucfirst($item->status) }} <br>
						{{ nopesan(Auth::user()->id_toko,$item->id_order,$item->created_at) }} <br>
						{{ tgl_indo($item->created_at) }}
					</a>
				</li>
			@empty
				<li class="list-group-item rounded-0">Tidak ada orderan yang dibatalkan.</li>
			@endforelse
			</ul>
		</div>
	</div>
</div>

@endsection