<table border="1" width="100%">						
    <tr>
        <td align="center"><b>C&eacute;dula : <?= $user->identification ?> &nbsp;&nbsp;&nbsp;&nbsp; Nombre : <?= $user->name ?></b></td>							
    </tr>					
</table>
<br>
<table border="0" width="100%">						
    <tr>
        <td align="center"><b>CR&Eacute;DITOS</b></td>							
    </tr>					
</table>

<table>
    <thead>
        <tr>
            <th><b>&nbsp;</b></th>							
            <th><b>Prestamo No</b></th>	
            <th><b>Tipo Prestamo </b></th>								
            <th><b>Valor Prestamo </b></th>	
            <th><b>No. Cuotas</b></th>	
            <th><b>Cuota</b></th>	
            <th><b>Saldo</b></th>	
        </tr>
    </thead>
    <tbody>
        <?php
            $aux_ttl_saldo=0;
            $aux_ttl_cuota=0;
            $aux_ttl_valor_prestamo=0;
        ?>

        <?php foreach($extracts_wal as $key_wall => $wallet): ?>
            <?php
                $aux_ttl_saldo          = $aux_ttl_saldo + $wallet->saldo;
                $aux_ttl_cuota          = $aux_ttl_cuota + $wallet->valcta;
                $aux_ttl_valor_prestamo = $aux_ttl_valor_prestamo + $wallet->valor;
            ?>
            <tr>
                <td ><?= $wallet->fecsolici ?></td>							
                <td ><?= $wallet->numero ?></td>	
                <td ><?= $wallet->line_credit_wall->name ?></td>								
                <td align="right"><?= number_format($wallet->valor, 0, ",", ".") ?></td>	
                <td ><?= $wallet->ctapact ?></td>	
                <td align="right"><?= number_format($wallet->valcta, 0, ",", ".") ?></td>	
                <td align="right"><?= number_format($wallet->saldo, 0, ",", ".") ?></td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="3">&nbsp;</td>		
            <td align="right"><?=number_format($aux_ttl_valor_prestamo, 0, ",", ".");?></td>	
            <td >&nbsp;</td>	
            <td align="right"><?=number_format($aux_ttl_cuota, 0, ",", ".");?></td>	
            <td align="right"><?=number_format($aux_ttl_saldo, 0, ",", ".");?></td>	
        </tr>
    </tbody>
</table>


<table border="1" width="100%">	
    <tr>
        <td align="center"><b>SALDOS APORTES Y AHORROS</b></td>							
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td><b>Saldo de Ahorro : </b> </td>
                    <td>&nbsp;<b>&nbsp;:&nbsp;</b>&nbsp;</td>
                    <td align="right"><b><?=number_format($extracts_con->salahoper);?></b></td>							
                </tr>
                <?php $aux_total_reserva_permanente=0; ?>
                <?php if($extracts_con->fecha > '2021-08-30'): ?>
                    <?php $aux_total_reserva_permanente=$extracts_con->salahopex; ?>
                    <tr>
                        <td><b>Ahorro permanente Reserva Especial </b> </td>
                        <td>&nbsp;<b>&nbsp;:&nbsp;</b>&nbsp;</td>
                        <td align="right"><b><?=number_format($extracts_con->salahopex);?></b></td>							
                    </tr>
                <?php endif ?>
                <tr>
                    <td><b>Saldo de Aportes : </b> </td>
                    <td>&nbsp;<b>&nbsp;:&nbsp;</b>&nbsp;</td>
                    <td align="right"><b><?=number_format($extracts_con->salaportes);?></b></td>							
                </tr>
                <tr>
                    <td><b>Saldo de Ahorro Program.:  </b> </td>
                    <td>&nbsp;<b>&nbsp;:&nbsp;</b>&nbsp;</td>
                    <td align="right"><b><?=number_format($extracts_con->salahopro);?></b></td>							
                </tr>
                <tr>
                    <td><b>Saldo de Ahorro Voluntario:  </b> </td>
                    <td>&nbsp;<b>&nbsp;:&nbsp;</b>&nbsp;</td>
                    <td align="right"><b><?=number_format($extracts_con->salahovol);?></b></td>							
                </tr>
                <tr>
                    <td><b>Saldo de Reserva Especial: </b> </td>
                    <td>&nbsp;<b>&nbsp;:&nbsp;</b>&nbsp;</td>
                    <td align="right"><b><?=number_format($extracts_con->salresesp);?></b></td>							
                </tr>
                <tr>
                    <td colspan="3"><hr></td>
                </tr>
                <tr>
                    <td><b>Total Aporte + Ahorros  </b> </td>
                    <td>&nbsp;<b>&nbsp;:&nbsp;</b>&nbsp;</td>
                    <td align="right">
                        <?php 
                            $aux_total=$extracts_con->salahoper+$aux_total_reserva_permanente+$extracts_con->salaportes +$extracts_con->salahovol+ $extracts_con->salahopro+ $extracts_con->salresesp; 
                        ?>
                        <b><?= number_format($aux_total); ?></b>
                    </td>							
                </tr>
            </table>
        </td>
    </tr>
</table>

<br>
<p align="center">SI PASADOS 8 DIAS NO HEMOS RECIBIDO CONFIRMACI&Oacute;N DE LOS SALDOS. SE TOMAR&Aacute;N COMO CORRECTOS</p>