$('.custom-file-input').on('change',function(e){
    //get the file name
    var fileName = e.target.files[0].name;
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
});

$(document).on('click','.btn-hapus', function(e){
	$this = $(this);
	e.preventDefault();
	bootbox.confirm({ 
	    size: "small",
	    message: "Yakin hapus data ini?",
	    callback: function(result){
	    	if(result==true){
	    		$this.next('form').submit();
	    	}
	    }
	})
});

$(document).on('click','.btn-submit', function(e){
	$this = $(this);
	msg = $(this).data('msg');
	e.preventDefault();
	bootbox.confirm({ 
	    size: "small",
	    message: msg,
	    callback: function(result){
	    	if(result==true){
	    		$this.next('form').submit();
	    	}
	    }
	})
});

$('.date').datepicker({ format:'yyyy-mm-dd' });