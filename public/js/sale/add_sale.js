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
		url: "m/sale/add_sale",
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

function addRow() {
	var s = '<tr>' +
				'<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>' +
				'<td class="number"><input type="number" name="number" maxlength="20"></td>' +
				'<td class="date"><input type="date" name="date" maxlength="20"></td>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="project"><input type="text" name="project" maxlength="20"></td>' +
				'<td class="part"><input type="text" name="part" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="weight"><input type="number" name="weight" maxlength="20"></td>' +
				'<td class="car"><input type="text" name="car" maxlength="10"></td>' +
				'<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
				'<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>' +
			'</tr>' +
			'<tr>' +
				'<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>' +
				'<td class="number"><input type="number" name="number" maxlength="20"></td>' +
				'<td class="date"><input type="date" name="date" maxlength="20"></td>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="project"><input type="text" name="project" maxlength="20"></td>' +
				'<td class="part"><input type="text" name="part" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="weight"><input type="number" name="weight" maxlength="20"></td>' +
				'<td class="car"><input type="text" name="car" maxlength="10"></td>' +
				'<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
				'<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>' +
			'</tr>' +
			'<tr>' +
				'<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>' +
				'<td class="number"><input type="number" name="number" maxlength="20"></td>' +
				'<td class="date"><input type="date" name="date" maxlength="20"></td>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="project"><input type="text" name="project" maxlength="20"></td>' +
				'<td class="part"><input type="text" name="part" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="weight"><input type="number" name="weight" maxlength="20"></td>' +
				'<td class="car"><input type="text" name="car" maxlength="10"></td>' +
				'<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
				'<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>' +
			'</tr>' +
			'<tr>' +
				'<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>' +
				'<td class="number"><input type="number" name="number" maxlength="20"></td>' +
				'<td class="date"><input type="date" name="date" maxlength="20"></td>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="project"><input type="text" name="project" maxlength="20"></td>' +
				'<td class="part"><input type="text" name="part" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="weight"><input type="number" name="weight" maxlength="20"></td>' +
				'<td class="car"><input type="text" name="car" maxlength="10"></td>' +
				'<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
				'<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>' +
			'</tr>' +
			'<tr>' +
				'<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>' +
				'<td class="number"><input type="number" name="number" maxlength="20"></td>' +
				'<td class="date"><input type="date" name="date" maxlength="20"></td>' +
				'<td class="company"><input type="text" name="company" maxlength="20"></td>' +
				'<td class="project"><input type="text" name="project" maxlength="20"></td>' +
				'<td class="part"><input type="text" name="part" maxlength="20"></td>' +
				'<td class="product"><input type="text" name="product" maxlength="10"></td>' +
				'<td class="weight"><input type="number" name="weight" maxlength="20"></td>' +
				'<td class="car"><input type="text" name="car" maxlength="10"></td>' +
				'<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>' +
				'<td class="tip"><input type="text" name="tip" maxlength="20"></td>' +
				'<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>' +
			'</tr>';
	$('#insert_data').append(s);
}

function useTemplate(o) {
	var td = $(o).parent().nextUntil('td.button');
	$(td).each(function(index, e){
		var i = $(this).find('input');
		switch($(i).attr('name')) {
			case 'date':
				$(i).val($('#template_date').val());
				break;
			case 'company':
				$(i).val($('#template_company').val());
				break;
			case 'project':
				$(i).val($('#template_project').val());
				break;
			case 'part':
				$(i).val($('#template_part').val());
				break;
			case 'product':
				$(i).val($('#template_product').val());
				break;
			default:
				$(i).val('');
				break;
		}
	});
}

function clearTemplate(o) {
	var td = $(o).parent().prevUntil('td.button');
	$(td).each(function(index, e){
		var i = $(this).find('input');
		$(i).val('');
	});
}