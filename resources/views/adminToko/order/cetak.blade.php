<style>
  body {
    font-family : “Lucida Console”, Monaco, monospace
  }
</style>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>{{ $title }}</title>

	
</head>
<body onload="window.print()">
	<!--Author      : @arboshiki-->
	<div id="invoice">

	    <div class="toolbar hidden-print">
	    </div>
	    <div>
	        <div>
	            <main>
	                <div class="row contacts">
	                    <center><img src="https://skingvaporizer.com/img/logostruks.png"></center>
	                    <div class="col invoice-to">
	                        <h3 class="invoice-id">No Orderan :{{ nopesan(Auth::guard('toko')->id(),$order->id_order,$order->created_at) }}</h3>
	                        <div class="to">{{ $order->nama }}</div>
	                        <div class="date">{{ tgl_indo($order->created_at,'short') }}</div>
	                        <div class="address">{{ $order->alamat }}</div>
	                        <div class="email">{{ $order->nohp }}</div>
	                    </div>
	                </div>
	                <br>
	                
	                <table border="1" cellspacing="2" cellpadding="3">
	                    <thead>
	                        <tr>
	                            <th class="text-left">Produk</th>
	                            <th class="text-right">Harga</th>
	                            <th class="text-right">Qty</th>
	                            <th class="text-right">Total</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php $no=1; $total=$diskon=0; ?>
	                    @foreach($order->detail($order->id_order) as $item)
	                        <tr>
	                            <td class="text-left">{{ $item->nm_produk }}</td>
	                            <td class="unit">{{ rupiah($item->harga) }}</td>
	                            <td class="qty">{{ $item->jumlah }}</td>
	                            <td class="total">{{ rupiah($item->jumlah*$item->harga) }}</td>
	                            <?php $total = $total+($item->jumlah*$item->harga); $diskon = $diskon+($item->jumlah*$item->diskon); ?>
	                        </tr>
	                    <?php $no++; ?>
	                    @endforeach
	                    </tbody>
	                </table>
	                
	                <br>
	                
	                <div>Total belanja : {{ rupiah($total) }}</div>
	                <div>Diskon : -{{ rupiah($diskon) }}</div>
	                <div>Ongkos kirim : {{ rupiah($order->total - ($total-$diskon)) }}</div>
	                <div><b>Total tagihan : {{ rupiah($order->total) }}</b></div> <br>
	                
	            </main>
	          </div>
	        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
	        <div></div>
	    </div>
	</div>
</body>
</html>