function saveAddSaleValue() {
	var objArray = [];
	var tr = $('#insert_data').find('tr');
	$(tr).each(function(index, e) {
		var td = $(this).find('td').nextUntil('td.button');
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
		url: "m/buy/add_sale",
		type: "POST",
		dataType: "json",
		data: {"inputs" : objArray},
		success:function(r){
			if (r.code == 1) {
				location.reload();
			} else {
				alert("save fail");
			}
		}
	});
}