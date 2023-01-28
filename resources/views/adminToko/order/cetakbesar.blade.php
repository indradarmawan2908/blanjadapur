<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/invoice.css') }}">
</head>
<body onload="window.print()">
	<!--Author      : @arboshiki-->
	<div id="invoice">

	    <div class="toolbar hidden-print">
	    </div>
	    <div class="invoice overflow-auto">
	        <div style="min-width: 600px">
	            <main>
	                <div class="row contacts">
	                    <div class="col invoice-to">
	                        <div class="text-gray-light">TAGIHAN KEPADA:</div>
	                        <h2 class="to">{{ $order->nama }}</h2>
	                        <div class="address">{{ $order->alamat }}</div>
	                        <div class="email">{{ $order->nohp }}</div>
	                    </div>
	                    <div class="col invoice-details">
	                        <h1 class="invoice-id">TAGIHAN {{ nopesan(Auth::guard('toko')->id(),$order->id_order,$order->created_at) }}</h1>
	                        <div class="date">Tanggal Tagihan: {{ tgl_indo($order->created_at,'short') }}</div>
	                    </div>
	                </div>
	                <table border="0" cellspacing="0" cellpadding="0">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th class="text-left">NAMA PRODUK</th>
	                            <th class="text-right">HARGA</th>
	                            <th class="text-right">JUMLAH</th>
	                            <th class="text-right">TOTAL</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php $no=1; $total=$diskon=0; ?>
	                    @foreach($order->detail($order->id_order) as $item)
	                        <tr>
	                            <td class="no">{{ $no }}</td>
	                            <td class="text-left">{{ $item->nm_produk }}</td>
	                            <td class="unit">{{ rupiah($item->harga) }}</td>
	                            <td class="qty">{{ $item->jumlah }}</td>
	                            <td class="total">{{ rupiah($item->jumlah*$item->harga) }}</td>
	                            <?php $total = $total+($item->jumlah*$item->harga); $diskon=$diskon+($item->jumlah*$item->diskon); ?>
	                        </tr>
	                    <?php $no++; ?>
	                    @endforeach
	                    </tbody>
	                    <tfoot>
	                    	<tr>
	                            <td colspan="2"></td>
	                            <td colspan="2">Total Belanja</td>
	                            <td>{{ rupiah($total) }}</td>
	                        </tr>
	                        <tr>
	                            <td colspan="2"></td>
	                            <td colspan="2">Diskon</td>
	                            <td>-{{ rupiah($diskon) }}</td>
	                        </tr>
	                        <tr>
	                            <td colspan="2"></td>
	                            <td colspan="2">Ongkos Kirim</td>
	                            <td>{{ rupiah($order->total - ($total - $diskon)) }}</td>
	                        </tr>
	                        <tr>
	                            <td colspan="2"></td>
	                            <td colspan="2">Total Seluruhnya</td>
	                            <td>{{ rupiah($order->total) }}</td>
	                        </tr>
	                    </tfoot>
	                </table>
	            </main>
	            <footer>
	                Invoice dikeluarkan untuk orderan yang telah dibuat.
	            </footer>
	        </div>
	        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
	        <div></div>
	    </div>
	</div>
</body>
</html>