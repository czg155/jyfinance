var ATTR = [];

$(function(){
	$sel = selAttr();
	if ($sel) {
		//工程名称的select项
		var pj = '<option value="-1" selected = "selected">全部</option>';
		var pd = '<option value="-1" selected = "selected">全部</option>';
		for(var opj in ATTR) {
			pj = pj + '<option value="' + opj + '">' + opj + '</option>';

			//产品名称的select项
			for(var opd in ATTR[opj]) {
				pd = pd + '<option value="' + opd + '">' + opd + '</option>';
			}
			for (var i = 0; i < ATTR[opj]; i++) {
				pd = pd + '<option value="' + ATTR[opj][i] + '">' + ATTR[opj][i] + '</option>';
			}
		}

		//渲染
		$('#sel_project').append(pj);
		$('#sel_product').append(pd);
	}
});

function selAttr() {
	var re = 0;

	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/sale/sel_attr_sale",
		type: "POST",
		dataType: "json",
		async: false,
		success:function(r){
			if (r.sign == 1) {
				ATTR = r.attr;
				re = 1;
			} else {
				re = 0;
			}
		}
	});
	return re;
}

function changeProject(v) {
	console.log(ATTR);
	//规格的select项
	var s = '<option value="-1" selected = "selected">全部</option>';
	if (v != -1) {
		var obj = ATTR[v];
		for (var i = 0; i < obj.length; i++) {
			s = s + '<option value="' + obj[i] + '">' +obj[i] + '</option>';
		}
	}
	$('#sel_product').html(s);
}

function selData() {
	var objArray = {};
	objArray['project'] = $('#sel_project').val();
	objArray['product'] = $('#sel_product').val();
	objArray['begin'] = $('#sel_begin_date').val();
	objArray['end'] = $('#sel_end_date').val();
	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/sale/sel_sale",
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
					s += '<td class="project"><input type="text" name="project" maxlength="20" value="' + get_data[i]['project'] + '"></td>';
					s += '<td class="part"><input type="text" name="part" maxlength="20" value="' + get_data[i]['part'] + '"></td>';
					s += '<td class="product"><input type="text" name="product" maxlength="10" value="' + get_data[i]['product'] + '"></td>';
					s += '<td class="weight"><input type="number" name="weight" maxlength="20" value="' + get_data[i]['weight'] + '"></td>';
					s += '<td class="car"><input type="text" name="car" maxlength="10" value="' + get_data[i]['car'] + '"></td>';
					s += '<td class="carindex"><input type="number" name="carindex" maxlength="3" value="' + get_data[i]['carindex'] + '"></td>';
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

function delData(v) {
	var re = 0;
	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/sale/delete_sale",
		type: "POST",
		data: {"inputs" : v},
		dataType: "json",
		success:function(r){
			if (r.sign == 1) {
				alert('del success');
				re = 1;
			} else {
				re = 0;
			}
		}
	});
}

function updateData(v) {
	var objArray = {};
	var td = $('#tr_'+v).find('td');
	var em = 0;
	$(td).each(function(index, e) {
		var o = $(this).find('input');
		if ($(o).attr('name') == 'id') {
			objArray[$(o).attr('name')] = $(o).val();
		} else {
			if ($(o).attr('value') != $(o).val()) {
				objArray[$(o).attr('name')] = $(o).val();
				em = 1;
			}
		}
	});
	if (!em) {
		objArray = {};
	}

	var re = 0;
	$.ajax({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "m/sale/update_sale",
		type: "POST",
		data: {"inputs" : objArray},
		dataType: "json",
		success:function(r){
			if (r.sign == 1) {
				alert('update success');
				re = 1;
			} else {
				re = 0;
				alert('update fail');
			}
		}
	});
}