var COMPANY = [];
var PRODUCT = new Array();
var TYPE = new Array();

$(function(){
	$sel = findSel();
	if ($sel) {
		//供货单位的select项
		var s = '<option value="" selected = "selected">选择供货单位</option>';
		for (var i = 0; i <  COMPANY.length; i++) {
			s = s + '<option value="' + COMPANY[i] + '">' + COMPANY[i] + '</option>';
		}
		$('#sel_company').append(s);

		//产品名称的select项
		s = '<option value="" selected = "selected">选择产品名称</option>';
		for (var i = 0; i <  PRODUCT[COMPANY[0]].length; i++) {
			s = s + '<option value="' + PRODUCT[COMPANY[0]][i] + '">' + PRODUCT[COMPANY[0]][i] + '</option>';
		}
		$('#sel_product').append(s);

		//规格的select项
		s = '<option value="" selected = "selected">选择规格</option>';
		for (var i = 0; i <  TYPE[PRODUCT[COMPANY[0]]].length; i++) {
			s = s + '<option value="' + TYPE[PRODUCT[COMPANY[0]]][i] + '">' + TYPE[PRODUCT[COMPANY[0]]][i] + '</option>';
		}
		$('#sel_type').append(s);
	}
});

function findSel() {
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
				COMPANY = r.inputs_company;
				PRODUCT = r.inputs_product;
				TYPE = r.inputs_type;
				re = 1;
			} else {
				re = 0;
			}
		}
	});
	return re;
}

function changeCompany(v) {
	// alert(v);
	//产品名称的select项
	var s = '<option value="" selected = "selected">全部</option>';
	for (var i = 0; i <  PRODUCT[v].length; i++) {
		s = s + '<option value="' + PRODUCT[v][i] + '">' + PRODUCT[v][i] + '</option>';
	}
	$('#sel_product').html(s);

	//规格的select项
	s = '<option value="" selected = "selected">全部</option>';
	for (var i = 0; i <  TYPE[PRODUCT[v]].length; i++) {
		s = s + '<option value="' + TYPE[PRODUCT[v]][i] + '">' + TYPE[PRODUCT[v]][i] + '</option>';
	}
	$('#sel_type').html(s);
}

function changeProduct(v) {
	//规格的select项
	var s = '<option value="" selected = "selected">全部</option>';
	for (var i = 0; i <  TYPE[v].length; i++) {
		s = s + '<option value="' + TYPE[v][i] + '">' + TYPE[v][i] + '</option>';
	}
	$('#sel_type').html(s);
}

function findSelData() {
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
					s += '<tr>';
					s += '<td class="id"><input type="number" name="number" maxlength="20" value="' + get_data[i]['number'] + '"></td>';
					s += '<td class="date"><input type="date" name="date" maxlength="20" value="' + get_data[i]['date'] + '"></td>';
					s += '<td class="company"><input type="text" name="company" maxlength="20" value="' + get_data[i]['company'] + '"></td>';
					s += '<td class="product"><input type="text" name="product" maxlength="10" value="' + get_data[i]['product'] + '"></td>';
					s += '<td class="type"><input type="text" name="type" maxlength="10" value="' + get_data[i]['type'] + '"></td>';
					s += '<td class="car"><input type="text" name="car" maxlength="10" value="' + get_data[i]['car'] + '"></td>';
					s += '<td class="weight"><input type="number" name="weight" maxlength="20" value="' + get_data[i]['weight'] + '"></td>';
					s += '<td class="tip"><input type="text" name="tip" maxlength="20" value="' + get_data[i]['tip'] + '"></td>';
					s += '<td class="delete"><button>删除</button></td>';
					s += '<td class="update"><button>修改</button></td>';
					s += '</tr>';
				}
				$('#sel_data').html(s);
			} else {
			}
		}
	});
}