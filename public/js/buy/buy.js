var ATTR_ALL = [];
var ATTR_PRODUCT_TYPE = [];

$(function(){
	$sel = selAttr();
	if ($sel) {
		//供货单位的select项
		var c = '<option value="-1" selected = "selected">全部</option>';
		for(var o in ATTR_ALL) {
			c = c + '<option value="' + o + '">' + o + '</option>';
		}

		//产品名称的select项
		var p = '<option value="-1" selected = "selected">全部</option>';
		for(var o in ATTR_PRODUCT_TYPE) {
			p = p + '<option value="' + o + '">' + o + '</option>';
		}

		// //规格的select项
		var t = '<option value="-1" selected = "selected">全部</option>';

		//渲染
		$('#sel_company').append(c);
		$('#sel_product').append(p);
		$('#sel_type').append(t);
	}
});

function selAttr() {
	var re = 0;

	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/buy/sel_attr_buy",
		type: "POST",
		dataType: "json",
		async: false,
		success:function(r){
			if (r.sign == 1) {
				ATTR_ALL = r.attr_all;
				ATTR_PRODUCT_TYPE = r.attr_product_type;
				re = 1;
			} else {
				re = 0;
			}
		}
	});
	return re;
}

function changeCompany(v) {
	//产品名称的select项
	var s = '<option value="-1" selected = "selected">全部</option>';
	if (v == -1) {
		for (var o in ATTR_PRODUCT_TYPE) {
			s = s + '<option value="' + o + '">' + o + '</option>';
		}
	} else {
		for (var o in ATTR_ALL[v]) {
			s = s + '<option value="' + o + '">' + o + '</option>';
		}
	}
	$('#sel_product').html(s);

	//规格的select项
	s = '<option value="-1" selected = "selected">全部</option>';
	$('#sel_type').html(s);
}

function changeProduct(v) {
	console.log(ATTR_ALL);
	//规格的select项
	var s = '<option value="-1" selected = "selected">全部</option>';
	if (v != -1) {
		var obj = ATTR_PRODUCT_TYPE[v];
		for (var i = 0; i < obj.length; i++) {
			s = s + '<option value="' + obj[i] + '">' +obj[i] + '</option>';
		}
	}
	$('#sel_type').html(s);
}

function selData() {
	var objArray = {};
	objArray['company'] = $('#sel_company').val();
	objArray['product'] = $('#sel_product').val();
	objArray['type'] = $('#sel_type').val();
	objArray['beginTime'] = $('#sel_begin_time').val();
	objArray['endTime'] = $('#sel_end_time').val();
	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/buy/sel_buy",
		type: "POST",
		data: {"inputs" : objArray},
		dataType: "json",
		success:function(r){
			if (r.sign == 1) {
				var get_data = r.inputs;
				var s = '';
				for (var i = 0; i < get_data.length; i++) {
					s += '<tr id="tr_' + get_data[i]['id'] + '">';
					s += '<td class="id"><input name="id" value="' + get_data[i]['id'] + '"></td>';
					s += '<td class="number"><input type="number" name="number" maxlength="20" value="' + get_data[i]['number'] + '"></td>';
					s += '<td class="date"><input type="date" name="date" maxlength="20" value="' + get_data[i]['date'] + '"></td>';
					s += '<td class="company"><input type="text" name="company" maxlength="20" value="' + get_data[i]['company'] + '"></td>';
					s += '<td class="product"><input type="text" name="product" maxlength="10" value="' + get_data[i]['product'] + '"></td>';
					s += '<td class="type"><input type="text" name="type" maxlength="10" value="' + get_data[i]['type'] + '"></td>';
					s += '<td class="car"><input type="text" name="car" maxlength="10" value="' + get_data[i]['car'] + '"></td>';
					s += '<td class="weight"><input type="number" name="weight" maxlength="20" value="' + get_data[i]['weight'] + '"></td>';
					s += '<td class="tip"><input type="text" name="tip" maxlength="20" value="' + get_data[i]['tip'] + '"></td>';
					s += '</tr>';
				}
				$('#sel_data').html(s);
			} else {	
			}
		}
	});
}