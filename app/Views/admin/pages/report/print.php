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
        text-align: center;
    }
    table .kop:before {
        content: ': ';
    }
    .left {
        text-align: left;
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
</style>
<?php
/** @var array $finances */
?>
<div id="printable" class="container">
    <table border="0" cellpadding="0" cellspacing="0" width="485" class="border" style="overflow-x:auto;">
        <thead>
        <tr>
            <td colspan="5" width="485" id="caption"><?= shop_information()['shop_name']; ?></td>
        </tr>
        <tr>
            <td colspan="5">Laporan Keuangan <?= shop_information()['shop_name']; ?></td>
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
            <th>No</th>
            <th>Tanggal</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Total</th>
        </tr>

        <?php
        $total = 0;

        foreach($finances as $index => $finance): ?>
            <?php $total += @$finance->order_id ? $finance->total : -$finance->total; ?>
            <tr>
                <td align="right"><?= $index + 1; ?></td>
                <td><?= date('d F Y', strtotime($finance->date)) ?></td>
                <td align="right"><?= @$finance->order_id ? format_number($finance->total) : '-'; ?></td>
                <td><?= @$finance->rand_id ? format_number($finance->total) : '-'; ?></td>
                <td> <?= format_number($total); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="4"> TOTAL</th>
            <th><?= format_number($total); ?></th>
        </tr>
        </tbody>
        <tfoot>
        <?php for ($i = 0; $i < 4; $i++): ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php endfor; ?>
        <tr class="ttd">
            <th colspan="4"></th>
            <th colspan="1">Mengetahui</th>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="1"><?= shop_information()['shop_owner']; ?></td>
        </tr>
        </tfoot>
    </table>
</div>
<script>
    window.print();
</script>