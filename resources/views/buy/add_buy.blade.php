<!DOCTYPE html>
<html>
<head>
	<title>增加入库</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="../css/buy/add_buy.css">
	<script type="text/javascript" src="../js/buy/add_buy.js"></script>
	<script type="text/javascript" src="../js/lib/jquery-3.3.1.min.js"></script>
</head>
<body>
	<div class="addbox">
		<ul class="template">
			<li><span>模板------</span></li>
			<li class="date">日期：<input type="date" name="t-date"></li>
			<li class="company">供货单位：<input type="text" name="t-company" maxlength="20"></li>
			<li class="product">产品名称：<input type="text" name="t-product" maxlength="10"></li>
			<li class="type">类型：<input type="text" name="t-type" maxlength="10"></li>
		</ul>
		<table class="table-data" id="add-buy-table">
			<thead>
				<th class="id">编号</th>
				<th class="date">日期</th>
				<th class="company">供货单位</th>
				<th class="product">产品名称</th>
				<th class="type">规格</th>
				<th class="car">运输车号</th>
				<th class="weight">净重</th>
				<th class="tip">备注</th>
			</thead>
			<tbody>
				<tr>
					<td class="id"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
				<tr>
					<td class="id"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
				<tr>
					<td class="id"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
				<tr>
					<td class="id"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
				<tr>
					<td class="id"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="type"><input type="text" name="type" maxlength="10"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="8"><button>添加行</button></td>
				</tr>
				<tr></tr>
				<tr>
					<td><button onclick="saveAddBuyValue()">提交</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>