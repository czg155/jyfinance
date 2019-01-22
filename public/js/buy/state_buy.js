function showStateMaterialBuy() {
	$('#state_material_buy').show();
}

function selStateMaterialBuyData() {
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
				console.log(r.inputs);
				buildStateMaterialBuyTable(r.inputs);
				var caption = '旌原' + $('#sel_begin_date').val() + '——' + $('#sel_end_date').val() + '进料报表';
				$('#caption_state_material_buy').html(caption);
				$('#table_state_material_buy').show();
			} else if (r.sign == 2) {	
				alert("查找失败！请检查起始时间和结束时间。");
			}
		}
	});
}

//生成进料报表表格
//参数：获取的数组data
function buildStateMaterialBuyTable(data) {
	var s_head = '';
	var s_body = '';
	//head中记录表头名字和对应序号
	var head = {};
	var index_head = 0;
	for (var c in data) {
		for (var p in data[c]) {
			for (var t in data[c][p]) {
				if (!head.hasOwnProperty(t + '_' + p)) {
					head[t + '_' + p] = index_head;
					index_head += 1;
				}
				s_body += '<tr><td>' + c + '</td>';
				for (var i = 0; i < head[t + '_' + p]; i++) {
					s_body += '<td></td>';
				}
				s_body += '<td>' + data[c][p][t] + '</td></tr>';
			}
		}
	}
	s_head += '<th></th>';
	for (var i = 0; i < index_head; i++) {
		s_head += '<th>' + findKey(head, i) + '</th>';
	}
	$('#head_state_material_buy').html(s_head);
	$('#body_state_material_buy').html(s_body);
}

function findKey (obj,value, compare = (a, b) => a === b) {
	return Object.keys(obj).find(k => compare(obj[k], value));
}