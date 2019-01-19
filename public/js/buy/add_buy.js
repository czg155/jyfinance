function saveAddBuyValue() {
	var objArray = [];
	var tr = $('#add-buy-table').find('tbody').find('tr');
	$.each(tr, function() {
		var td = $(this).find('td');
		var obj = {};
		var check = 0;
		$.each(td, function() {
			var o = $(this).find('input');
			if ($.isEmptyObject($(o).val())) {
				check += 1;
			}
			obj[$(o).attr('name')] = $(o).val();
		});
		if (check < 8) {
			objArray.push(obj);
		}
	});

	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/buy/add_buy",
		type: "POST",
		dataType: "json",
		data: {"inputs" : objArray},
		success:function(r){
			if (r.code == 0) {
				alert("save success");
			} else {
				alert("save fail");
			}
		}
	});
}