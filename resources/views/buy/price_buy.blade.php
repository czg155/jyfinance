<!DOCTYPE html>
<html>
<head>
	<title>单价</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="../css/buy/price_buy.css">
	<script type="text/javascript" src="../js/lib/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../js/buy/price_buy.js"></script>
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
			<li><button onclick="selData()">查找</button></li>
			<li><button>刷新</button></li>
		</ul>
	</div>
	<div class="operatebox">
		<table class="table-data">
			<thead>
				<th class="id"></th>
				<th class="company">供货单位</th>
				<th class="product">产品名称</th>
				<th class="type">规格</th>
				<th class="begin">起始日期</th>
				<th class="end">结束日期</th>
				<th class="price">单价</th>
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
	<div class="addbox">
		<table class="table-addbox">
			<thead>
				<th class="company">供货单位</th>
				<th class="product">产品名称</th>
				<th class="type">规格</th>
				<th class="begin">起始日期</th>
				<th class="end">结束日期</th>
				<th class="price">单价</th>
				<th class="tip">备注</th>
			</thead>
			<tbody id="insert_data">
				<tr>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="begin"><input type="date" name="begin" maxlength="20"></td>
					<td class="end"><input type="date" name="end" maxlength="20"></td>
					<td class="price"><input type="number" name="price" maxlength="10"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
				<tr>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="begin"><input type="date" name="begin" maxlength="20"></td>
					<td class="end"><input type="date" name="end" maxlength="20"></td>
					<td class="price"><input type="number" name="price" maxlength="10"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
				<tr>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="begin"><input type="date" name="begin" maxlength="20"></td>
					<td class="end"><input type="date" name="end" maxlength="20"></td>
					<td class="price"><input type="number" name="price" maxlength="10"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7"><button onclick="addRow()">添加行</button></td>
				</tr>
				<tr>
					<td><button onclick="savePriceBuyValue()">提交</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>