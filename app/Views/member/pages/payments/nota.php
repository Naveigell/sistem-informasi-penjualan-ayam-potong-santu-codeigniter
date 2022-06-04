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
/** @var array $orders */
/** @var array $user */
/** @var array $shipping */
/** @var array $area */
?>
<div id="printable" class="container">
    <table border="0" cellpadding="0" cellspacing="0" width="485" class="border" style="overflow-x:auto;">
        <thead>
        <tr>
            <td colspan="6" width="485" id="caption"><?= shop_information()['shop_name']; ?></td>
        </tr>
        <tr>
            <td class="left" colspan="2">Nama Pemesan</td>
            <td class="left kop"><?= $user['name']; ?></td>
            <td></td>
            <td class="left">Tanggal</td>
            <td class="left kop"><?= shop_information()['shop_city']; ?>, <?= date('d F Y'); ?></td>
        </tr>
        <tr>
            <td class="left" colspan="2">Id Pemesanan</td>
            <td class="left kop"><b><?= strtoupper($shipping['order_id']); ?></b></td>
            <td></td>
            <td class="left">Perihal</td>
            <td class="left kop">Nota Pembelian</td>
        </tr>
        <tr>
            <td class="left" colspan="2">Alamat</td>
            <td class="left kop"><?= $shipping['address']; ?></td>
            <td></td>
            <td class="left">Ongkos Kirim</td>
            <td class="left kop"><?= format_number($area['cost']); ?></td>
        </tr>
        <tr>
            <td></td>
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
            <th>HARGA SATUAN</th>
            <th>VARIAN</th>
            <th>JUMLAH</th>
            <th>TOTAL</th>
            <th colspan="2">KETERANGAN</th>
        </tr>

        <?php
        $total = 0;

        foreach($orders as $index => $order): ?>
            <tr>
                <td align="right"><?= $index + 1; ?></td>
                <td><?= format_number($order->sub_product_price); ?></td>
                <td><?= $order->sub_product_unit; ?></td>
                <td align="right"><?= $order->quantity; ?></td>
                <td><?= format_number($order->sub_product_price * $order->quantity); ?></td>
                <td colspan="2"> <?= $order->name; ?></td>
            </tr>
        <?php $total += $order->sub_product_price * $order->quantity; ?>
        <?php endforeach; ?>
        <tr>
            <th colspan="3"> TOTAL</th>
            <td><?= format_number($total); ?></td>
            <td colspan="2"></td>
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
                <td></td>
            </tr>
        <?php endfor; ?>
        <tr class="ttd">
            <th colspan="3">Diterima</th>
            <th colspan="3">Mengetahui</th>
        </tr>
        <tr>
            <td colspan="3"><?= $user['name']; ?></td>
            <td colspan="3"><?= shop_information()['shop_owner']; ?></td>
        </tr>
        </tfoot>
    </table>
</div>
<script>
    window.print();
</script>