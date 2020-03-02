
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
	<td width="60%"  style="text-align: right; font-weight: bold; font-size: 14pt; vertical-align: middle;" colspan="3" >
		Reporte de Comisiones
	</td>
</tr>
<tr>
	<td width="40%" style="color:#000000; font-size: 10px;">
		<span > Alejandro Azolas 2999, Arica - Chile</span>
		<br />
		<span style="font-family:dejavusanscondensed;">&#9742;</span> +56 58 247 5880
	</td>
	<td width="12%" style="text-align: left; ">Gestión<br/><span style="font-weight: bold; font-size: 10pt;">
		{{$year}}
	</span></td>
    <td width="12%" style="text-align: left;">Mes: <br />
        
        @foreach($fechaactual as $item)
            <span style="font-weight: bold; font-size: 10pt;">{{$item->mes}}</span>
        @endforeach
        
    </td>
    <td width="12%" style="text-align: left;">Sucursal: <br /><span style="font-weight: bold; font-size: 10pt;">
        @foreach($sucursal as $item)
            <span style="font-weight: bold; font-size: 10pt;">{{$item->SUCU_NOMBRE}}</span>
        @endforeach
    </span></td>

    <td width="12%" style="text-align: left;">Vendedor: <br /><span style="font-weight: bold; font-size: 10pt;">
		@foreach($vendedor as $item)
            <span style="font-weight: bold; font-size: 10pt;">{{$item->VEND_NOMBRE}}</span>
        @endforeach
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
@foreach($fechaactual as $item)
            
    <h3 style="">1. Ventas de {{$item->mes}} - {{$item->año}} pagados en {{$item->mes}} - {{$item->año}}</h3>

@endforeach

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
        <tr>
            <td width="20%" align="center">Folio</td>
            <td width="20%" align="center">Fecha Venta</td>
            <td width="25%" align="center">RUC Cliente</td>
            <td width="20%" align="center">Fecha Pago</td>
            <td width="20%" align="center">Deposito</td>
            <td width="20%" align="center">Precio Neto</td>            
        </tr>
    </thead>
    <tbody>
        {{$cuenta=0}}
        @foreach($mesactual as $item)
        <tr>
            <td align="center">{{$item->folio}}</td>
            <td align="center">{{$item->fecha2}}</td>
            <td align="center">{{$item->rut_cliente}}</td>
            <td align="center">{{$item->fecha_pago}}</td>
            <td align="center">{{$item->n_deposito}}</td>
            <td align="center">$ {{$item->comision}}</td>
            {{$cuenta=$cuenta+$item->comision}}
            
        </tr>
        @endforeach
        <tr>
            <td align="center" colspan="5">TOTAL = </td>
            <td align="center">$ {{$cuenta}}</td>
        </tr>
    </tbody>
</table>

</br>
@foreach($fechaanterior as $item)
            
    <h3 style="">2. Ventas de {{$item->mesAnt}} - {{$item->añoAnt}} pagados en {{$item->mes}} - {{$item->año}}</h3>

@endforeach

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
        <tr>
            <td width="20%" align="center">Folio</td>
            <td width="20%" align="center">Fecha Venta</td>
            <td width="25%" align="center">RUC Cliente</td>
            <td width="20%" align="center">Fecha Pago</td>
            <td width="20%" align="center">Deposito</td>
            <td width="20%" align="center">Precio Neto</td>            
        </tr>
    </thead>
    <tbody>
        {{$cuenta=0}}
        @foreach($mesanterior as $item)
        <tr>
            <td align="center">{{$item->folio}}</td>
            <td align="center">{{$item->fecha2}}</td>
            <td align="center">{{$item->rut_cliente}}</td>
            <td align="center">{{$item->fecha_pago}}</td>
            <td align="center">{{$item->n_deposito}}</td>
            <td align="center">$ {{$item->comision}}</td>
            {{$cuenta=$cuenta+$item->comision}}
        </tr>
        @endforeach
        <tr>
            <td align="center" colspan="5">TOTAL = </td>
            <td align="center">$ {{$cuenta}}</td>
        </tr>
    </tbody>

</table>

</br>
@foreach($fechaactual as $item)
            
    <h3 style="">3. Ventas de {{$item->mes}} - {{$item->año}} con pago posterior</h3>

@endforeach

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
        <tr>
            <td width="20%" align="center">Folio</td>
            <td width="20%" align="center">Fecha Venta</td>
            <td width="25%" align="center">RUC Cliente</td>
            <!--<td width="20%" align="center">Fecha Pago</td>-->
            <!--<td width="20%" align="center">Deposito</td>-->
            <td width="20%" align="center">Precio Neto</td>            
        </tr>
    </thead>
    <tbody>
        {{$cuenta=0}}
        @foreach($messiguiente as $item)
        <tr>
            <td align="center">{{$item->folio}}</td>
            <td align="center">{{$item->fecha2}}</td>
            <td align="center">{{$item->rut_cliente}}</td>
            <!--<td align="center">{{$item->fecha_pago}}</td>-->
            <!--<td align="center">{{$item->n_deposito}}</td>-->
            <td align="center">$ {{$item->comision}}</td>
            {{$cuenta=$cuenta+$item->comision}}
            
        </tr>
        @endforeach
        <tr>
            <td align="center" colspan="3">TOTAL = </td>
            <td align="center">$ {{$cuenta}}</td>
        </tr>
    </tbody>

</table>

</body>
</html>



