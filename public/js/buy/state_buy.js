function selData() {
	var objArray = {};
	objArray['begin'] = $('#sel_begin_date').val();
	objArray['end'] = $('#sel_end_date').val();
	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/buy/state_material_buy",
		type: "POST",
		data: {"inputs" : objArray},
		dataType: "json",
		success:function(r){
			if (r.sign == 1) {
				var get_data = r.inputs;
				var s = '';
				$('#sel_data').html(s);
			} else {	
			}
		}
	});
}