
<html>
   
   <head>
    <meta charset="UTF-8">
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
           Resumen de Comisiones
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
   Página {PAGENO} de {nb}
   </div>
   </htmlpagefooter>
   
   <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
   <sethtmlpagefooter name="myfooter" value="on" />
   mpdf-->
  
   
   </br>
   @foreach($fechaactual as $item)
        @php
            $ventasprimero="Ventas de $item->mes - $item->año pagados en $item->mes - $item->año";
        @endphp

       <h3 style="">1. Ventas de {{$item->mes}} - {{$item->año}} pagados en {{$item->mes}} - {{$item->año}}</h3>
   
   @endforeach
   
   <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
       <thead>
           <tr>
               <td width="20%" align="center">Codigo Documento</td>
               <td width="20%" align="center">Tipo Documento</td>
               <td width="25%" align="center">Cantidad</td>
               <td width="20%" align="center">Total</td>           
           </tr>
       </thead>
       <tbody>
           {{$cuenta1=0}}
           @foreach($mesactual as $item)
           <tr>
               <td align="center">{{$item->tipo_documento}}</td>
               <td align="center">{{$item->TPDC_DESCRIPCION}}</td>
               <td align="center">{{$item->documento}}</td>
               <td align="center">$ {{number_format($item->total,2)}}</td>
               {{$cuenta1=$cuenta1+$item->total}}
               
           </tr>
           @endforeach
           <tr>
               <td align="center" colspan="3">TOTAL = </td>
               <td align="center">$ {{number_format($cuenta1,2)}}</td>
           </tr>
       </tbody>
   </table>
   
   </br>
   @foreach($fechaanterior as $item)
        @php
        $ventassegundo="Ventas de $item->mesAnt - $item->añoAnt pagados en $item->mes - $item->año";   
        @endphp
       <h3 style="">2. Ventas de {{$item->mesAnt}} - {{$item->añoAnt}} pagados en {{$item->mes}} - {{$item->año}}</h3>
   
   @endforeach
   
   <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
   <thead>
           <tr>
               <td width="20%" align="center">Codigo Documento</td>
               <td width="20%" align="center">Tipo Documento</td>
               <td width="25%" align="center">Cantidad</td>
               <td width="20%" align="center">Total</td>           
           </tr>
       </thead>
       <tbody>
           {{$cuenta2=0}}
           @foreach($mesanterior as $item)
           <tr>
               <td align="center">{{$item->tipo_documento}}</td>
               <td align="center">{{$item->TPDC_DESCRIPCION}}</td>
               <td align="center">{{$item->documento}}</td>
               <td align="center">$ {{number_format($item->total,2)}}</td>
               {{$cuenta2=$cuenta2+$item->total}}
               
           </tr>
           @endforeach
           <tr>
               <td align="center" colspan="3">TOTAL = </td>
               <td align="center">$ {{number_format($cuenta2,2)}}</td>
           </tr>
       </tbody>
   
   </table>
   
   </br>
   @foreach($fechaactual as $item)
        
        @php
            $ventasultimo="Ventas de $item->mes - $item->año con pago posterior";
        @endphp
       <h3 style="">3. Ventas de {{$item->mes}} - {{$item->año}} con pago posterior</h3>
   
   @endforeach
   
   <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
        <thead>
           <tr>
               <td width="20%" align="center">Codigo Documento</td>
               <td width="20%" align="center">Tipo Documento</td>
               <td width="25%" align="center">Cantidad</td>
               <td width="20%" align="center">Total</td>           
           </tr>
       </thead>
       <tbody>
           {{$cuenta3=0}}
           @foreach($messiguiente as $item)
           <tr>
               <td align="center">{{$item->tipo_documento}}</td>
               <td align="center">{{$item->TPDC_DESCRIPCION}}</td>
               <td align="center">{{$item->documento}}</td>
               <td align="center">$ {{number_format($item->total,2)}}</td>
               {{$cuenta3=$cuenta3+$item->total}}
               
           </tr>
           @endforeach
           <tr>
               <td align="center" colspan="3">TOTAL = </td>
               <td align="center">$ {{number_format($cuenta3,2)}}</td>
           </tr>
       </tbody>
   
   </table>
   @php
        foreach($niveles as $item){
                    $nivel1=0;
                    $nivel1+=$item->nivel1;
                    $nivel2=0;
                    $nivel2+=$item->nivel2;
                    $nivel3=0;
                    $nivel3+=$item->nivel3;
                    $comision1=0;
                    $comision1+=$item->comision1;
                    $comision2=0;
                    $comision2+=$item->comision2;
                    $comision3=0;
                    $comision3+=$item->comision3;
                }
    if($comision3 == 0 && $nivel3 == 0){

        if($nivel2 == 0 && $comision2==0){

            if($nivel1 == 0 && $comision1 == 0){
                $porcentaje=0;
                $i=0;
        
            }
        else{
            if($cuentafinal >= $nivel1){
                $porcentaje=$comision1 * 0.01;
            }
            else{
                $porcentaje=0;
                $i=1;
            }
        }
    }
    else{

        if($cuenta1 >= $nivel2){

            $porcentaje=$comision2 * 0.01;
            $i=2;
        
        }
        else{
            if($cuenta1 >= $nivel1){
                $porcentaje=$comision1 * 0.01;
                $i=1;
            }
            else{
                $porcentaje=0;
                $i=0;
            } 
        }
    
    }
}
else{
    if($cuenta1 >= $nivel3){
        $porcentaje=$comision3*0.01;
        $i=3;
    }
    else{
        if($cuenta1 >= $nivel2){
            $porcentaje=$comision2*0.01;
            $i=2;
        }
        else{
            if($cuenta1 >= $nivel1){
                $porcentaje=$comision1*0.01;
                $i=1;
            }
            else{
                $porcentaje=0;
                $i=0;
            }
        }
    }
}
$comisionfinal1=$cuenta1*$porcentaje;
$porcentaje1=$porcentaje/0.01;
    @endphp

    @php
    if($comision3 == 0 && $nivel3 == 0){

    if($nivel2 == 0 && $comision2==0){

        if($nivel1 == 0 && $comision1 == 0){
            $porcentaje=0;
            $i=0;

        }
    else{
        if($cuenta2 >= $nivel1){
            $porcentaje=$comision1 * 0.01;
        }
        else{
            $porcentaje=0;
            $i=1;
        }
    }
    }
    else{

    if($cuenta2 >= $nivel2){

        $porcentaje=$comision2 * 0.01;
        $i=2;

    }
    else{
        if($cuenta2 >= $nivel1){
            $porcentaje=$comision1 * 0.01;
            $i=1;
        }
        else{
            $porcentaje=0;
            $i=0;
        } 
    }

    }
    }
    else{
    if($cuenta2 >= $nivel3){
    $porcentaje=$comision3*0.01;
    $i=3;
    }
    else{
    if($cuenta2 >= $nivel2){
        $porcentaje=$comision2*0.01;
        $i=2;
    }
    else{
        if($cuenta2 >= $nivel1){
            $porcentaje=$comision1*0.01;
            $i=1;
        }
        else{
            $porcentaje=0;
            $i=0;
        }
    }
    }
}
$comisionfinal2=$cuenta2*$porcentaje;
$porcentaje2=$porcentaje/0.01;
    @endphp
   
    @php
    if($comision3 == 0 && $nivel3 == 0){

    if($nivel2 == 0 && $comision2==0){

        if($nivel1 == 0 && $comision1 == 0){
            $porcentaje=0;
            $i=0;

        }
    else{
        if($cuenta3 >= $nivel1){
            $porcentaje=$comision1 * 0.01;
        }
        else{
            $porcentaje=0;
            $i=1;
        }
    }
    }
    else{

    if($cuenta3 >= $nivel2){

        $porcentaje=$comision2 * 0.01;
        $i=2;

    }
    else{
        if($cuenta3 >= $nivel1){
            $porcentaje=$comision1 * 0.01;
            $i=1;
        }
        else{
            $porcentaje=0;
            $i=0;
        } 
    }

    }
    }
    else{
    if($cuenta3 >= $nivel3){
    $porcentaje=$comision3*0.01;
    $i=3;
    }
    else{
    if($cuenta3 >= $nivel2){
        $porcentaje=$comision2*0.01;
        $i=2;
    }
    else{
        if($cuenta3 >= $nivel1){
            $porcentaje=$comision1*0.01;
            $i=1;
        }
        else{
            $porcentaje=0;
            $i=0;
        }
    }
    }
}
$comisionfinal3=$cuenta3*$porcentaje;
$comisionfinal4=$comisionfinal1+$comisionfinal2+$comisionfinal3;
$porcentaje3=$porcentaje/0.01;
    @endphp
   <h3 style="">4. Niveles de comisiones</h3>


   <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8" id="tabla">
        <thead>
           <tr>
                
               <td width="20%" align="center">Nivel 1</td>
               <td width="20%" align="center">Comision</td>
               <td width="20%" align="center">Nivel 2</td>
               <td width="20%" align="center">Comision</td>
               <td width="20%" align="center">Nivel3 </td>
               <td width="20%" align="center">Comision</td>
           </tr>
       </thead>
       <tbody id="cuerpo">
           
          <tr>
            @if($i==0)
                <td align="center">{{number_format($nivel1,2)}}</td>
                <td align="center">{{number_format($comision1,2)}}%</td>
                <td align="center">{{number_format($nivel2,2)}}</td>
                <td align="center">{{number_format($comision2,2)}}%</td>
                <td align="center">{{number_format($nivel3,2)}}</td>
                <td align="center">{{number_format($comision3,2)}}%</td>
            @else 
                @if($i==1)
                    <td align="center" style="background:yellow">{{number_format($nivel1,2)}}</td>
                    <td align="center">{{number_format($comision1,2)}}%</td>
                    <td align="center">{{number_format($nivel2,2)}}</td>
                    <td align="center">{{number_format($comision2,2)}}%</td>
                    <td align="center">{{number_format($nivel3,2)}}</td>
                    <td align="center">{{number_format($comision3,2)}}%</td> 
                @else

                    @if($i==2)
                        <td align="center">{{number_format($nivel1,2)}}</td>
                        <td align="center">{{number_format($comision1,2)}}%</td>
                        <td align="center"  style="background:yellow">{{number_format($nivel2,2)}}</td>
                        <td align="center">{{number_format($comision2,2)}}%</td>
                        <td align="center">{{number_format($nivel3,2)}}</td>
                        <td align="center">{{number_format($comision3,2)}}%</td>
                    @else
                        <td align="center">{{number_format($nivel1,2)}}</td>
                        <td align="center">{{number_format($comision1,2)}}%</td>
                        <td align="center">{{number_format($nivel2,2)}}</td>
                        <td align="center">{{number_format($comision2,2)}}%</td>
                        <td align="center"   style="background:yellow">{{number_format($nivel3,2)}}</td>
                        <td align="center">{{number_format($comision3,2)}}%</td>
                    @endif
                @endif

            @endif 
                
            </tr>
           
       </tbody>
            
   </table>

 
  </br>
    <h3 style="">5. Comision final</h3>
    <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
        <thead>
           <tr>
               <td width="80%" align="center">Gestion - Mes </td>
               <td width="20%" align="center">Total</td>
               <td width="20%" align="center">Porcentaje</td>
               <td width="20%" align="center">Comision</td>
           </tr>
       </thead>
       <tbody>
            <tr>
                <td width="20%" align="center">{{$ventasprimero}}</td>
                <td width="20%" align="right">{{number_format($cuenta1,2)}}</td>
                <td width="20%" align="right">{{number_format($porcentaje1,2)}}%</td>
                <td width="20%" align="right">{{number_format($comisionfinal1,2)}}</td>
            </tr>
            <tr>
                <td width="20%" align="center">{{$ventassegundo}}</td>
                <td width="20%" align="right">{{number_format($cuenta2,2)}}</td>
                <td width="20%" align="right">{{number_format($porcentaje2,2)}}%</td>
                <td width="20%" align="right">{{number_format($comisionfinal2,2)}}</td>
            </tr>
            <tr>
                <td width="20%" align="center">{{$ventasultimo}}</td>
                <td width="20%" align="right">{{number_format($cuenta3,2)}}</td>
                <td width="20%" align="right">{{number_format($porcentaje3,2)}}%</td>
                <td width="20%" align="right">{{number_format($comisionfinal3,2)}}</td>
            </tr>
            <tr>
                <td width="20%" align="center" colspan="3">Total</td>
                <td width="20%" align="right">{{number_format($comisionfinal4,2)}}</td>
            </tr>
           
       </tbody>
   </table>

   </br>
   <script >
       
            $(document).ready(function(){
                //let cuerpo='<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>';

                $('#cuerpo').append('<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>');

            })

    </script>
   </body>
   </html>

   