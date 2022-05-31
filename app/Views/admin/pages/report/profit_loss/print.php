<style>
    table {
        max-width: 100%;
        max-height: 100%;
        margin-top: 30px;
    }
    body {
        padding: 5px;
        position: relative;
        width: 100%;
        height: 100%;
    }
    table th,
    table td {
        padding: .625em;
        /*text-align: center;*/
    }
    table .kop:before {
        content: ': ';
    }
    .left {
        text-align: left;
    }
    .right {
        text-align: right;
    }
    table #caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }
    table.border {
        width: 100%;
        border-collapse: collapse
    }

    table.border tbody th, table.border tbody td {
        border: thin solid #000;
        padding: 2px
    }
    .ttd td, .ttd th {
        padding-bottom: 4em;
    }
    @media print {

        html, body {
            height:100%;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }

    }

    #tbl td {
        padding-left: 10px;
    }
</style>
<?php
/** @var array $expenditures */
/** @var array $orders */

$total = 0;
$totalExpenditure = 0;
?>
<div id="printable" class="container">
    <table id="tbl" border="0" cellpadding="0" cellspacing="0" width="485" class="border" style="overflow-x:auto;">
        <thead>
        <tr>
            <td style="text-align: center;" colspan="5" width="485" id="caption"><?= shop_information()['shop_name']; ?></td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="5">Laporan Keuangan <?= shop_information()['shop_name']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><b>Pendapatan Penjualan</b></td>
            <td></td>
            <td></td>
        </tr>
        <?php /** @var array $orders */
        foreach($orders as $order): ?>
            <tr>
                <td><?= $order->name; ?> - <?= $order->quantity; ?> <?= $order->unit; ?></td>
                <td><?php $total += $order->quantity * $order->price; echo format_number($order->quantity * $order->price); ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td><b><?= format_number($total); ?></b></td>
        </tr>
        <tr>
            <td><b>Pengeluaran</b></td>
            <td></td>
            <td></td>
        </tr>
        <?php /** @var array $expenditures */
        foreach($expenditures as $expenditure): ?>
            <tr>
                <td><?= $expenditure->name; ?>&nbsp; x<?= $expenditure->quantity; ?></td>
                <td><?php $totalExpenditure += $expenditure->quantity * $expenditure->nominal; echo format_number($expenditure->quantity * $expenditure->nominal); ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><b>Total Pengeluaran</b></td>
            <td></td>
            <td><b>(<?= format_number($totalExpenditure); ?>)</b></td>
        </tr>
        <tr>
            <td><b>Laba Rugi Bersih</b></td>
            <td></td>
            <td><b><?= format_number($total - $totalExpenditure); ?></b></td>
        </tr>
        </tbody>
        <tfoot>
        <?php for ($i = 0; $i < 4; $i++): ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php endfor; ?>
        <tr class="ttd">
            <th colspan="2"></th>
            <th colspan="1">Mengetahui</th>
        </tr>
        <tr class="ttd">
            <td colspan="2"></td>
            <td style="text-align: center;" colspan="1"><?= shop_information()['shop_owner']; ?></td>
        </tr>
        </tfoot>
    </table>
</div>
<script>
    window.print();
</script>