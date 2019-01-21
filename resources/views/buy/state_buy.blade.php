<!DOCTYPE html>
<html>
<head>
	<title>单价</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- <link rel="stylesheet" type="text/css" href="../css/buy/state_buy.css"> -->
	<script type="text/javascript" src="../js/lib/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../js/buy/state_buy.js"></script>
</head>
<body>
	<div>
		<h1>财务报表</h1>
	</div>
	<div>
		<ul>
			<li><button>分类账目</button></li>
			<li><button>进料报表</button></li>
			<li><button>报表三</button></li>
			<li><button>报表四</button></li>
			<li><button>报表五</button></li>
		</ul>
	</div>
	<div class="ledger" style="display: none;">
		<ul class="ledger-selector">
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
			<li><button onclick="selData()">刷新</button></li>
			<li><button onclick="btnOpenAddbox()">添加单价</button></li>
		</ul>
		<div>
			
		</div>
	</div>
	<!-- 月进料单 -->
	<div>
		<div>
			<h2>进料报表</h2>
		</div>
		<ul>
			<li>
				起始时间：<input id="sel_begin_date" type="date" name="begin_date">
			</li>
			<li>
				结束时间：<input id="sel_end_date" type="date" name="end_date">
			</li>
			<li><button onclick="selData()">查找</button></li>
			<li><button onclick="selData()">刷新</button></li>
		</ul>
		<table border="1">
			<caption>报表标题</caption>
			<thead>
				<th class="number">编号</th>
				<th class="date">日期</th>
				<th class="company">供货单位</th>
				<th class="product">产品名称</th>
				<th class="type">规格</th>
				<th class="car">运输车号</th>
				<th class="weight">净重</th>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				
			</tfoot>
		</table>
	</div>
	<div class="showbox">
	</div>
</body>
</html>