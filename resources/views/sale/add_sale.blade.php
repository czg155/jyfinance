<!DOCTYPE html>
<html>
<head>
	<title>增加出货</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="../css/sale/add_sale.css">
	<script type="text/javascript" src="../js/sale/add_sale.js"></script>
	<script type="text/javascript" src="../js/lib/jquery-3.3.1.min.js"></script>
</head>
<body>
	<div class="addbox">
		<ul class="template">
			<li><span>模板------</span></li>
			<li class="date">日期：<input id="template_date" type="date" name="t-date"></li>
			<li class="company">施工单位：<input id="template_company" type="text" name="t-company" maxlength="20"></li>
			<li class="company">工程名称：<input id="template_project" type="text" name="t-project" maxlength="20"></li>
			<li class="company">施工部位：<input id="template_part" type="text" name="t-part" maxlength="20"></li>
			<li class="product">强度等级：<input id="template_product" type="text" name="t-product" maxlength="10"></li>
		</ul>
		<table class="table-data" id="add-sale-table" border="1px">
			<thead>
				<th></th>
				<th class="number">编号</th>
				<th class="date">日期</th>
				<th class="company">施工单位</th>
				<th class="project">工程名称</th>
				<th class="part">施工部位</th>
				<th class="product">强度等级</th>
				<th class="weight">方量</th>
				<th class="car">运输车号</th>
				<th class="carindex">车次</th>
				<th class="tip">备注</th>
				<th></th>
			</thead>
			<tbody id="insert_data">
				<tr>
					<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>
					<td class="number"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="project"><input type="text" name="project" maxlength="20"></td>
					<td class="part"><input type="text" name="part" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
					<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>
				</tr>
				<tr>
					<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>
					<td class="number"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="project"><input type="text" name="project" maxlength="20"></td>
					<td class="part"><input type="text" name="part" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
					<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>
				</tr>
				<tr>
					<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>
					<td class="number"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="project"><input type="text" name="project" maxlength="20"></td>
					<td class="part"><input type="text" name="part" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
					<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>
				</tr>
				<tr>
					<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>
					<td class="number"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="project"><input type="text" name="project" maxlength="20"></td>
					<td class="part"><input type="text" name="part" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
					<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>
				</tr>
				<tr>
					<td class="button"><button onclick="useTemplate(this)">使用模板</button></td>
					<td class="number"><input type="number" name="number" maxlength="20"></td>
					<td class="date"><input type="date" name="date" maxlength="20"></td>
					<td class="company"><input type="text" name="company" maxlength="20"></td>
					<td class="project"><input type="text" name="project" maxlength="20"></td>
					<td class="part"><input type="text" name="part" maxlength="20"></td>
					<td class="product"><input type="text" name="product" maxlength="10"></td>
					<td class="weight"><input type="number" name="weight" maxlength="20"></td>
					<td class="car"><input type="text" name="car" maxlength="10"></td>
					<td class="carindex"><input type="text" name="carindex" maxlength="3"></td>
					<td class="tip"><input type="text" name="tip" maxlength="20"></td>
					<td class="button"><button onclick="clearTemplate(this)">清除模板</button></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="12"><button onclick="addRow()">添加行</button></td>
				</tr>
				<tr></tr>
				<tr>
					<td><button onclick="saveAddSaleValue()">提交</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>