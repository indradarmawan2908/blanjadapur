$(document).ready(function(e) {
  $.ajax({
    method: "GET",
    url: baseUrl,
    dataType: "json",
    complete: function(xhr, status) {},
    success: function(result, xhr, status) {
      $.each(result, function(i, item) {
        $('.provinsi').append($('<option>', {
          value: item.province_id,
          text: item.province
        }));
      });
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
  $('.metode-kirim').hide();
  $('.metode-kirim').find('select').attr('required', false);
  $('.metode-kirim').find('#kodepos').attr('required', false);
});
$(document).on('change', '.provinsi', function(e) {
  var prov = $(this).val();
  if (prov.length > 0) {
    $.ajax({
      method: "GET",
      url: baseUrl + '/' + prov,
      dataType: "json",
      complete: function(xhr, status) {},
      success: function(result, xhr, status) {
        $('.kota').children('option:not(:first)').remove();
        $.each(result, function(i, item) {
          $('.kota').append($('<option>', {
            value: item.city_id,
            text: item.type + " " + item.city_name
          }));
        });
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
});
$(document).on('click', '#cek', function(e) {
  var origin = $('.kota[data-type="asal"]').val();
  var destination = $('.kota[data-type="tujuan"]').val();
  var weight = $('#berat').val();
  var courier = $('#kurir').val();
  if (courier.length <= 0) {
    alert('Pilih Kurir');
    return false;
  }
  $.ajax({
    method: "POST",
    url: baseUrl,
    data: {
      "_token": token,
      'origin': origin,
      'destination': destination,
      'weight': weight,
      'courier': courier
    },
    dataType: "json",
    complete: function(xhr, status) {},
    success: function(result, xhr, status) {
      $('#preview').empty();
      var html = "";
      $.each(result[0].costs, function(i, item) {
        html += "<div class='card mb-3'><div class='card-body'>";
        html += "<p>" + item.service + "</p>";
        html += "<p>" + item.description + "</p>";
        html += "<p>" + item.cost[0].value + "</p>";
        html += "<p>" + item.cost[0].etd + "</p>";
        html += "</div></div>";
      });
      $('#preview').append(html);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
});
$(document).on('change', '.metode', function(e) {
  var val = $(this).val();
  switch (val) {
    case 'cod':
    case 'jemput':
      $('#formAntar').attr('action', url + '/keranjang/bayar');
      $('.metode-kirim').hide();
      $('.metode-kirim').find('select').attr('required', false);
      $('.metode-kirim').find('#kodepos').attr('required', false);
      if(val == 'jemput'){
      	$('#detailKonsumen').hide();
      	$('#detailKonsumen').find('#alamat').attr('required', false);
      }else{
        $('#detailKonsumen').show();
      	$('#detailKonsumen').find('#alamat').attr('required', true);
      }
	break;
    case 'kirim':
      $('#formAntar').attr('action', url + '/keranjang/kirim');
      $('#detailKonsumen').show();
      $('.metode-kirim').show();
      $('.metode-kirim').find('select').attr('required', true);
      $('.metode-kirim').find('#kodepos').attr('required', true);
      $('#detailKonsumen').find('#alamat').attr('required', true);
      break;
  }
});
$(document).on('change', '.ongkir', function(e) {
  var ongkir = $(this).val();
  var paket = $(this).data('paket');
  var total = $('#total').data('value');
  $('#paket').val(paket);
  $('#ongkir').text('Rp ' + numberWithCommas(ongkir));
  $('#total').text('Rp ' + numberWithCommas((parseInt(ongkir) + parseInt(total))));
  $("html, body").animate({
    scrollTop: 0
  }, "slow");
});

function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}