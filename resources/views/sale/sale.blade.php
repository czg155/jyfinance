<!DOCTYPE html>
<html>
<head>
	<title>出货</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="css/sale/sale.css">
	<link rel="stylesheet" type="text/css" href="css/sale/table.css">
	<script type="text/javascript" src="js/lib/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/sale/sale.js"></script>
</head>
<body>
	<div class="head">
		<h1 class="head-title">旌原公司出货单</h1>
	</div>
	<div class="operate">
		<ul class="operate-left-buttons">
			<li>
				<span>工程名称：</span>
				<select id="sel_project" onchange="changeProduct(this.options[this.options.selectedIndex].value)">
				</select>
			</li>
			<li>
				<span>强度等级：</span>
				<select id="sel_product">
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
			<li><button><a href="sale/state_sale">报表分析</a></button></li>
		</ul>
		<ul class="operate-right-buttons">
			<li><button><a href="sale/price_sale">修改单价</a></button></li>
			<li><button><a href="sale/operate_sale">操作</a></button></li>
			<li><button><a href="sale/add_sale">增加</a></button></li>
		</ul>
	</div>
	<div class="dataview">
		<table border="1" class="table-data">
			<thead>
				<tr>
					<th class="number">编号</th>
					<th class="date">日期</th>
					<th class="company">供货单位</th>
					<th class="project">产品名称</th>
					<th class="part">施工部位</th>
					<th class="product">规格</th>
					<th class="weight">方量</th>
					<th class="car">运输车号</th>
					<th class="carindex">车次</th>
					<th class="tip">备注</th>
				</tr>
			</thead>
			<tbody id="sel_data">
				<tr>
					<td>请查找数据！</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>