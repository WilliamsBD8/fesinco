
<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Saldo Inicial</th>
            <th>Interes</th>
            <th>Abono a capital</th>
            <th>Seguro</th>
            <th>Cuota a Pagar</th>
            <th>Saldo Final</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < $quota_max; $i++): ?>
            <?php
                $sald_inic = $i == 0 ? $mont_value : $sald_fina;
                $inte_actu = $sald_inic * $valor_tasa;
                $segu_actu = $sald_inic * $segu_tasa;
                $capi_actu = abs($inte_actu + $segu_actu - $cuota);
                $sald_fina = $sald_inic - $capi_actu;
            ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td>$ <?= number_format($sald_inic, 2, '.', ',') ?></td>
                <td>$ <?= number_format($inte_actu, 2, '.', ',') ?></td>
                <td>$ <?= number_format($capi_actu, 2, '.', ',') ?></td>
                <td>$ <?= number_format($segu_actu, 2, '.', ',') ?></td>
                <td>$ <?= number_format($cuota, 2, '.', ',') ?></td>
                <td>$ <?= number_format($sald_fina, 2, '.', ',') ?></td>
            </tr>
        <?php endfor ?>
    </tbody>
</table>