<!DOCTYPE html>
<html>
<head>
	<title>入库</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="css/buy/buy.css">
	<link rel="stylesheet" type="text/css" href="css/buy/table.css">
	<script type="text/javascript" src="js/lib/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/buy/buy.js"></script>
</head>
<body>
	<div class="head">
		<h1 class="head-title">旌原公司入库单</h1>
	</div>
	<div class="operate">
		<ul class="operate-left-buttons">
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
			<li><button onclick="findSelData()">查找</button></li>
			<li><button>刷新</button></li>
			<li><button>报表分析</button></li>
		</ul>
		<ul class="operate-right-buttons">
			<li><button>修改单价</button></li>
			<li><button><a href="buy/operate_buy">操作</a></button></li>
			<li><button><a href="buy/add_buy">增加</a></button></li>
		</ul>
	</div>
	<div class="dataview">
		<table border="1" class="table-data">
			<tr>
				<th class="id">编号</th>
				<th class="date">日期</th>
				<th class="company">供货单位</th>
				<th class="product">产品名称</th>
				<th class="type">规格</th>
				<th class="car">运输车号</th>
				<th class="weight">净重</th>
				<th class="tip">备注</th>
			</tr>
				<!-- <?php
				//if ($gets) {
					//foreach ($gets as $key => $value) {
				?>
			<tr>
						<td><?php //echo $value["number"]; ?></td>
						<td><?php //echo $value["date"]; ?></td>
						<td><?php //echo $value["company"]; ?></td>
						<td><?php //echo $value["product"]; ?></td>
						<td><?php //echo $value["type"]; ?></td>
						<td><?php //echo $value["car"]; ?></td>
						<td><?php //echo $value["weight"]; ?></td>
						<td><?php //echo $value["tip"]; ?></td>
			</tr>
				<?php
					//}
				//} else {
				?>
						<td>//无数据</td>
				<?php
					//}
				?> -->
		</table>
	</div>
</body>
</html>