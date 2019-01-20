<!DOCTYPE html>
<html>
<head>
	<title>单价</title>
	@extends('layouts.f_zero')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="../css/buy/state_buy.css">
	<script type="text/javascript" src="../js/lib/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../js/buy/state_buy.js"></script>
</head>
<body>
	<div>
		<ul>
			<li><button>分类账目</button></li>
			<li><button>报表二</button></li>
			<li><button>报表三</button></li>
			<li><button>报表四</button></li>
			<li><button>报表五</button></li>
		</ul>
	</div>
	<div class="ledger">
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
	<div class="showbox">
	</div>
</body>
</html>