<?php
include 'function.php';

$id_user = $_GET['id_user'];

if (delete('tb_user', 'id_user', $id_user) > 0) {
    echo "
        <script>
            alert('Pengguna berhasil dihapus');
            document.location.href = 'user_management.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Pengguna gagal dihapus');
            document.location.href = 'user_management.php';
        </script>
    ";
}
