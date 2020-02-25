
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #a6a6a8;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #a6a6a8;
	border-right: 0.1mm solid #a6a6a8;
}
table thead.grey td, table tr.grey td  { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #a6a6a8;
	font-variant: small-caps;
}
table tr.bold td {
font-weight: bold;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #a6a6a8;
	background-color: #FFFFFF;
	border: 0mm none #a6a6a8;
	border-top: 0.1mm solid #a6a6a8;
	border-right: 0.1mm solid #a6a6a8;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #a6a6a8;
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
		Detalle de depositos
	</td>
</tr>
<tr>
	<td width="40%" style="color:#000000; font-size: 10px;">
		<span > Alejandro Azolas 2999, Arica - Chile</span>
		<br />
		<span style="font-family:dejavusanscondensed;">&#9742;</span> +56 58 247 5880
	</td>
	<td width="12%" style="text-align: right; ">Desde <br /><span style="font-weight: bold; font-size: 10pt;">
		13/07/2019
	</span></td>
	<td width="12%" style="text-align: right;">Hasta <br /><span style="font-weight: bold; font-size: 10pt;">
		16/07/2019
	</span></td>
</tr></table>

</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

</br>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr class="bold">
<td width="">T</td>
<td width="" >Deposito</td>
<td width="">Fecha</td>
<td width="">Caja</td>
<td width="">Operación</td>
<td width="">Efectivo</td>
<td width="">Cheque</td>
<td width="">Monto</td>
<td width="">Observaciones</td>
<td width="">Cliente</td>

</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr class="grey">
	<td colspan="10"><H3>
		Barros Arana
	</H3></td>
</tr>
<tr>
<td   align="center">-</td>
<td  >R. Cheque</td>
<td   >En cartera</td>
<td  >R. Cheque</td>
<td   class="cost">&pound;25.60</td>
<td   class="cost">&pound;25.60</td>
<td   align="center">-</td>

<td   >En cartera</td>

<td  >R. Cheque</td>
<td   >En cartera</td>

</tr>


<tr class="grey">
	<td colspan="10"><H3>
		Barros Arana
	</H3></td>
</tr>
<tr>
<td   align="center">-</td>
<td  >R. Cheque</td>
<td   >En cartera</td>
<td  >R. Cheque</td>
<td   class="cost">&pound;25.60</td>
<td   class="cost">&pound;25.60</td>
<td   align="center">-</td>

<td   >En cartera</td>

<td  >R. Cheque</td>
<td   >En cartera</td>

</tr>
</tbody>
</table>
<br>
<br>
<p>&nbsp;</p>

</body>
</html>



