<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%">
<tr  height="30">
	<td width="40%" >
		<img class="" src="assets/images/favicon/logo.png" alt="materialize logo" style=" position: relative;  height: 60px; width: 150px; ">
	</td>
	<td width="60%"  style="text-align: right; font-weight: bold; font-size: 14pt; vertical-align: middle;" colspan="2" >
		Resumen de transacciones
	</td>
</tr>
<tr>
	<td width="40%" style="color:#000000; font-size: 10px;">
		<span > Alejandro Azolas 2999, Arica - Chile</span>
		<br />
		<span style="font-family:dejavusanscondensed;">&#9742;</span> +56 58 247 5880
	</td>
	<td width="12%" style="text-align: right; ">Desde <br /><span style="font-weight: bold; font-size: 10pt;">
		{{$fecha1}}
	</span></td>
	<td width="12%" style="text-align: right;">Hasta <br /><span style="font-weight: bold; font-size: 10pt;">
		{{$fecha2}}
	</span></td>
</tr></table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Pagina {PAGENO} de {nb}
</div>
</htmlpagefooter>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->
@php
	if(!empty($depositosDetalle1[0])){
		foreach ($depositosDetalle1 as $item) {
			if (!isset($total_group[$item->OPER_DESC])) {
				$total_group[$item->OPER_DESC]=0;
			}
			$group[$item->OPER_DESC][] = $item;
			$total_group[$item->OPER_DESC] += $item->monto ? (int)$item->monto : 0;
		}
		$group_1=$group;
		$total_group_1=$total_group;
		//dd($group_1);
		//dd($total_group_1);
	}
	//unset($group);
	//unset($total_group);
	if(!empty($depositosDetalle2[0])){
		foreach ($depositosDetalle2 as $item) {
			if (!isset($total_group[$item->OPER_DESC])) {
				$total_group[$item->OPER_DESC]=0;
			}
			if (!isset($total_group_2[$item->OPER_DESC])) {
				$total_group_2[$item->OPER_DESC]=0;
			}
			$group_2[$item->OPER_DESC][] = $item;
			$group[$item->OPER_DESC][] = $item;
			$total_group_2[$item->OPER_DESC] += $item->monto ? (int)$item->monto : 0;
			$total_group[$item->OPER_DESC] += $item->monto ? (int)$item->monto : 0;
		}
		//dd($group_2);
		//dd($total_group_2);
	}
@endphp
<h3 style="">Resumen de ventas</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>

<tr>
<td width="25%">Codigo</td>
<td width="45%">Forma de pago</td>
<td width="30%">Sub-total</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
{{ $total_ventas= 0 }}
@foreach($resumen_ventas as $item)
<tr>
	<td align="center">{{$item->FRPG_CODIGO}}</td>
	<td>{{$item->FRPG_DESCRIPCION}}</td>
	<td class="cost">&#36;&#32;{{$item->sub_total}}</td>
</tr>
@php
	$total_ventas += $item->sub_total;
@endphp
@endforeach
<tr>
	<td align="center">-</td>
	<td >TOTAL</td>
	<td class="cost">&#36;&#32;{{$total_ventas}}</td>
</tr>
</tbody>
</table>
<br>
<h3 style="">Desglose</h3>
<h3 style="">1. Retiros Diarios</h3>
<h3 style="">
</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="20%"></td>
<td width="35%">Tipo de operación</td>
<td width="25%">Observación</td>
<td width="20%">Total</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
@if(isset($group_1))
@php
$total_diarios = 0 ;
@endphp
@foreach($group_1 as $item => $value)
<tr>
<td   align="center">{{$loop->iteration}}</td>
<td  >{{$item}}</td>
<td   >-</td>
<td   class="cost">{{$total_group_1[$item]}}</td>
</tr>
@php
	$total_diarios += $total_group_1[$item];
@endphp
@endforeach
<tr>
<td align="center">-</td>
<td>-</td>
<td >TOTAL</td>
<td class="cost">{{$total_diarios}}</td>
</tr>
@else
<tr><td>
<h4 style="">No se encontraron datos</h4>
</td>
</tr>
@endif
</tbody>
</table>

<br>
<h3 style="">2. Otros Retiros - Cobranza</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<!-- <thead>
<tr>
<td width="20%"></td>
<td width="35%">Tipo de operación</td>
<td width="25%">Observación</td>
<td width="20%">Total</td>
</tr>
</thead> -->
<tbody>
<!-- ITEMS HERE -->
@if(isset($group_2))
{{ $total_otros = 0 }}
@foreach($group_2 as $item => $value)
<tr>
<td width="20%"  align="center">{{$loop->iteration}}</td>
<td width="35%" >{{$item}}</td>
<td width="25%"  >-</td>
<td width="20%"  class="cost">{{$total_group_2[$item]}}</td>
</tr>
@php
	$total_otros += $total_group_2[$item];
@endphp
@endforeach
<tr>
<td align="center">-</td>
<td>-</td>
<td >TOTAL</td>
<td class="cost">{{$total_otros}}</td>
</tr>
@else
<h4 style="">No se encontraron datos</h4>
@endif
</tbody>
</table>
<br>
<!-- <h3 style="">3. Abono clientes</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<tbody>
<tr>
<td width="20%"  align="center">-</td>
<td width="35%" >R. Cheque</td>
<td width="25%"  >En cartera</td>
<td width="20%"  class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">-</td>
<td>R. Cheque</td>
<td >En cartera</td>
<td class="cost">&pound;25.60</td>
</tr>
</tbody>
</table> -->
<br>
<h3 style="">3. Prosegur</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<tbody>
{{ $total_prosegur = 0 }}
@foreach($group as $item => $value)
<tr>
<td width="20%"  align="center">{{$loop->iteration}}</td>
<td width="35%" >{{$item}}</td>
<td width="25%"  >-</td>
<td width="20%"  class="cost">{{$total_group[$item]}}</td>
</tr>
@php
	$total_prosegur += $total_group[$item];
@endphp
@endforeach
<tr>
<td align="center">-</td>
<td>-</td>
<td >TOTAL</td>
<td class="cost">{{$total_prosegur}}</td>
</tr>
</tbody>
</table>
<br>
<p>&nbsp;</p>

</body>
</html>
