<table class="table-solicity-header">
    <tr>
        <td width="50%">CIUDAD Y FECHA:</td>
        <td>VALOR SOLICITADO:</td>
    </tr>
    <tr>
        <td>Bogota, <?= date('Y-m-d', strtotime($credit->created_at)) ?></td>
        <td>$ <?= number_format($credit->value, 0, '.', ',') ?></td>
    </tr>
</table>

<h2 class="info-solicitate">
    DATOS SOLICITANTE
</h2>

<table class="table-data">
    <tr>
        <td colspan="3">APELLIDOS Y NOMBRE<br><?= $user->name ?></td>
        <td>CEDULA DE CIUDADANIA<br>N° <?= $user->identification ?></td>
    </tr>
    <tr>
        <td>FECHA DE INGRESO<br><?= $credit->date_init ?></td>
        <td>CARGO QUE OCUPA<br><?= $credit->position ?></td>
        <td>DEPENDENCIA DONDE TRABAJA<br>&nbsp;</td>
        <td>SUELDO BASICO<br>$</td>
    </tr>
    <tr>
        <td colspan="3">LINEA DE CREDITO: <span class="ml-2"><?= $credit->credit_name ?></span><br><br>AUTORIZO GIRAR A FAVOR DE: </td>
        <td>PLAZO SOLICITADO<br>N° MESES: <?= $credit->quota_max ?> <br> Máximo: <?= $credit->quota ?> </td>
    </tr>
</table>
<p class="lawers">
    •Mediante esta solicitud autorizamos al pagador de la Superintendencia de Industria y Comercio y/o del Instituto Nacional de Metrología, para retener el valor que cubra las cuotas del crédito aprobado mas sus intereses hasta su cancelación y a destinar la totalidad del mismo en el fin solicitado, a constituir las garantías exigidas y a cumplir con todas las demás obligaciones fijadas en el reglamento de crédito de FESINCO.  El cual declaramos conocer en su totalidad. Aceptamos las condiciones en que sea aprobada esta solicitud.<br>
    •Autorizamos irrevocablemente para que con fines estadísticos de control, supervisión e información comercial y financiera. FESINCO reporte, solicite y divulgue nuestro comportamiento comercial y financiero ante cualquier central de información y según las condiciones establecidas por FESINCO y los organismos de control respectivos, para lo cual firmamos a continuación.<br>
    •Acorde con la normatividad vigente. (Ley 1581 de 2012 y el Decreto 1377 de 2013, de la ley Hábeas data o Protección de datos)<br>
    ESTA LIBRANZA ESTA CONFORME CON LA LEY 1527 DE ABRIL DE 2012.
</p>
<table class="">
    <tr>
        <td class="td-border w-50 text-center">CODEUDOR</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td class="td-border">APELLIDOS Y NOMBRES<br>&nbsp;</td>
        <td class="td-border-bottom text-center">&nbsp;<br>FIRMA DEL SOLICITANTE</td>
    </tr>
    <tr>
        <td class="td-border">DIRECCIÓN Y TELÉFONO<br>&nbsp;<br>&nbsp;</td>
        <td class="td-border-bottom">DIRECCIÓN<br>TELÉFONO<br>EXTENSION</td>
    </tr>
    <tr>
        <td class="td-border">FIRMA<br>C.C.</td>
        <td>&nbsp;</td>
    </tr>
</table>
<h2 class="info-fesinco">
    PARA  USO EXCLUSIVO DE FESINCO
</h2>
<table class="analisis">
    <tr>
        <td class="td-border text-center" colspan="4">ANÁLISIS CAPACIDAD DE CREDITO DEL SOLICITANTE </td>
    </tr>
    <tr>
        <td class="td-border text-center" colspan="2">APORTES Y OBLIGACIONES</td>
        <td class="td-border text-center" colspan="2">CAPACIDAD DE DESCUENTO</td>
    </tr>
    <tr>
        <td class="td-border w-25">TOTAL APORTES MAS AHORRO</td>
        <td class="td-border w-25">$</td>
        <td class="td-border w-25">SALARIO BASICO</td>
        <td class="td-border w-25">$</td>
    </tr>
    <tr>
        <td class="td-border">TOTAL CREDITO</td>
        <td class="td-border">$</td>
        <td class="td-border">TOTAL DESCUENTOS NOMINA</td>
        <td class="td-border">$</td>
    </tr>
    <tr>
        <td class="td-border">SALDO</td>
        <td class="td-border">$</td>
        <td class="td-border">CAPACIDAD MÁXIMA DESCUENTO</td>
        <td class="td-border">$</td>
    </tr>
    <tr>
        <td class="td-border">VALOR SOLICITADO</td>
        <td class="td-border">$</td>
        <td class="td-border">VALOR CUOTA MENSUAL</td>
        <td class="td-border">$</td>
    </tr>
    <tr>
        <td class="td-border">N° VECES ENDEUDAMIENTO</td>
        <td class="td-border">$</td>
        <td colspan="2"></td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td class="w-25 b-top b-bottom b-left">
            Solicitud<br>aprobada por:
        </td>
        <td class="w-25 b-top b-bottom">
            Gerencia <input type="checkbox"><br>
            Comite de credito <input type="checkbox"><br>
            Junta Directiva <input type="checkbox">
        </td>
        <td class="w-25 b-top b-bottom b-right">FECHA: <?= date('Y-m-d') ?><br>Acta N° <?= $credit->id ?></td>
        <td class="w-25 ml-2"> Garantias: ________________ ___________________________</td>
    </tr>
    <tr>
        <td class="td-border">Negada: <input type="checkbox"></td>
        <td colspan="4"></td>
    </tr>
</table>
<br>
<span class="span-change"><b>(*) SI CAMBIO DE CUENTA DEBO INFORMAR A FESINCO </b></span>