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
		url: "m/buy/sortattr_buy",
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
	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/buy/sel_price_buy",
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
					s += '<td class="company"><input type="text" name="company" maxlength="20" value="' + get_data[i]['company'] + '"></td>';
					s += '<td class="product"><input type="text" name="product" maxlength="10" value="' + get_data[i]['product'] + '"></td>';
					s += '<td class="type"><input type="text" name="type" maxlength="10" value="' + get_data[i]['type'] + '"></td>';
					s += '<td class="begin"><input type="date" name="begin" maxlength="20" value="' + get_data[i]['begin'] + '"></td>';
					s += '<td class="end"><input type="date" name="end" maxlength="20" value="' + get_data[i]['end'] + '"></td>';
					s += '<td class="price"><input type="number" name="price" maxlength="10" value="' + get_data[i]['price'] + '"></td>';
					s += '<td class="tip"><input type="text" name="tip" maxlength="20" value="' + get_data[i]['tip'] + '"></td>';
					s += '<td class="delete"><button onclick="delData(' + get_data[i]['id'] + ')">删除</button></td>';
					s += '<td class="update"><button onclick="updateData(' + get_data[i]['id'] + ')">修改</button></td>';
					s += '</tr>';
				}
				$('#sel_data').html(s);
			} else {	
			}
		}
	});
}

function addRow() {
	var s = '<tr>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="type"><input type="text" name="type" maxlength="10"></td>' +
				'<td class="begin"><input type="date" name="begin" maxlength="20"></td>' +
				'<td class="end"><input type="date" name="end" maxlength="20"></td>' +
				'<td class="price"><input type="number" name="price" maxlength="10"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
			'</tr>' +
			'<tr>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="type"><input type="text" name="type" maxlength="10"></td>' +
				'<td class="begin"><input type="date" name="begin" maxlength="20"></td>' +
				'<td class="end"><input type="date" name="end" maxlength="20"></td>' +
				'<td class="price"><input type="number" name="price" maxlength="10"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
			'</tr>' +
			'<tr>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="type"><input type="text" name="type" maxlength="10"></td>' +
				'<td class="begin"><input type="date" name="begin" maxlength="20"></td>' +
				'<td class="end"><input type="date" name="end" maxlength="20"></td>' +
				'<td class="price"><input type="number" name="price" maxlength="10"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
			'</tr>';
	$('#insert_data').append(s);
}

function savePriceBuyValue() {
	var objArray = [];
	var tr = $('#insert_data').find('tr');
	$(tr).each(function(index, e) {
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
		if (check < 6) {
			objArray.push(obj);
		}
	});

	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/buy/add_price_buy",
		type: "POST",
		dataType: "json",
		data: {"inputs" : objArray},
		success:function(r){
			if (r.sign == 1) {
				alert('save success');
				$('.addbox').hide();
				selDate();
			} else if (r.sign == 2) {
				$('.addbox').hide();
			}else {
				alert("save fail");
			}
		}
	});
}

function btnOpenAddbox() {
	$('.addbox').show();
}

function btnCloseAddbox() {
	$('.addbox').hide();
}