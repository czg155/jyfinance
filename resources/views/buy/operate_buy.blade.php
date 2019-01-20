<!DOCTYPE html>
<html>
<head>
	<title>操作入库</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="../css/buy/operate_buy.css">
	<script type="text/javascript" src="../js/lib/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../js/buy/operate_buy.js"></script>
</head>
<body>
	<div class="operate">
		<ul class="operate-items">
			<li>
				<span>供货单位：</span>
				<select id="sel_company" onchange="changeCompany(this.options[this.options.selectedIndex].value)">
				</select>
			</li>
			<li>
				<span>产品名称：</span>
				<select id="sel_product" onchange="changeProduct(this.options[this.options.selectedIndex].value)">
				</select>
			</li>
			<li>
				<span>规格：</span>
				<select id="sel_type">
				</select>
			</li>
			<li>
				起始时间：<input id="sel_begin_time" type="date" name="begin_date">
			</li>
			<li>
				结束时间：<input id="sel_end_time" type="date" name="end_date">
			</li>
			<li><button onclick="selData()">查找</button></li>
			<li><button>刷新</button></li>
		</ul>
	</div>
	<div class="operatebox">
		<table class="table-data" id="operate-buy-table">
			<thead>
				<th class="number">编号</th>
				<th class="date">日期</th>
				<th class="company">供货单位</th>
				<th class="product">产品名称</th>
				<th class="type">规格</th>
				<th class="car">运输车号</th>
				<th class="weight">净重</th>
				<th class="tip">备注</th>
				<th class="delete">删除</th>
				<th class="update">修改</th>
			</thead>
			<tbody id="sel_data">
				<tr>
					<td>请查找数据</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>