<?php
include 'function.php';

$id_barang = $_GET['id_barang'];

if (delete('tb_barang_masuk', 'id_barang', $id_barang) > 0) {
    echo "
        <script>
            alert('Barang berhasil dihapus');
            document.location.href = 'products_in.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Barang gagal dihapus');
            document.location.href = 'products_in.php';
        </script>
    ";
}
