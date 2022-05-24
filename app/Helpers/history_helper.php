<?php

if (!function_exists('history_list')) {
    function history_list(): array {
        return [
            'Menunggu Pembayaran', 'Pesanan sedang di proses', 'Pesanan sedang dikemas', 'Pesanan sedang diantar', 'Pesanan telah sampai',
        ];
    }
}
