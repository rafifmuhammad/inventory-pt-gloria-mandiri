<?php

$conn = mysqli_connect('localhost', 'root', '', 'invent_app');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function add_user($data)
{
    global $conn;

    $id = uniqid();
    $username = htmlspecialchars(strtolower(stripslashes($data['username'])));
    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $role = htmlspecialchars($data['role']);
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
    $created_at = date('Y/m/d');

    // Check username 
    $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('username sudah terdaftar!');</script>";

        return false;
    }

    // Passsword encryption
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO tb_user VALUES ('$id', '$username', '$email', '$no_hp', '$role', '$password', '$created_at', '$nama_lengkap')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function get_single_user($id_user)
{
    global $conn;

    $query = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
    $result = mysqli_query($conn, $query);

    return mysqli_fetch_assoc($result);
}

function update_user($data, $id_user)
{
    global $conn;

    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $role = htmlspecialchars($data['role']);
    $password = htmlspecialchars($data['password']);
    $created_at = htmlspecialchars($data['created_at']);

    $query = "UPDATE tb_user SET 
        id_user = '$id_user',
        username = '$username',
        email = '$email',
        no_hp = '$no_hp',
        role = '$role',
        password = '$password',
        created_at = '$created_at',
        nama_lengkap = '$nama_lengkap'
            WHERE id_user = '$id_user' 
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update_product_in($data, $id_barang)
{
    global $conn;

    $id_user = $data['id_user'];
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $jumlah_barang = htmlspecialchars($data['jumlah_barang']);
    $tanggal_masuk = htmlspecialchars($data['tanggal_masuk']);

    $query = "UPDATE tb_barang_masuk SET 
        id_barang = '$id_barang', 
        id_user = '$id_user',
        nama_barang = '$nama_barang',
        jumlah_barang = '$jumlah_barang',
        tanggal_masuk = '$tanggal_masuk' 
        WHERE id_barang = '$id_barang'
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update_product_out($data, $id_barang)
{
    global $conn;

    $id_user = $data['id_user'];
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $jumlah_barang = htmlspecialchars($data['jumlah_barang']);
    $tanggal_keluar = htmlspecialchars($data['tanggal_keluar']);

    $query = "UPDATE tb_barang_keluar SET 
        id_barang = '$id_barang', 
        id_user = '$id_user',
        nama_barang = '$nama_barang',
        jumlah_barang = '$jumlah_barang',
        tanggal_keluar = '$tanggal_keluar'
        WHERE id_barang = '$id_barang'
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function add_products($data, $table)
{
    global $conn;

    $id_product = uniqid();
    $id_user = $data['id_user'];
    $nama_barang = $data['nama_barang'];
    $jumlah_barang = $data['jumlah_barang'];
    $tanggal = date('Y/m/d');

    $query = "INSERT INTO $table VALUES ('$id_product', '$id_user', '$nama_barang', '$jumlah_barang', '$tanggal')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function get_single_product($table, $attr, $id_barang)
{
    global $conn;

    $query = "SELECT $attr FROM $table WHERE id_barang = '$id_barang'";
    $result = mysqli_query($conn, $query);

    return mysqli_fetch_assoc($result);
}

function delete($table, $where, $id)
{
    global $conn;

    $query = "DELETE FROM $table WHERE $where = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// count total based on condition
function count_total($attr)
{
    global $conn;

    $query = "SELECT count(role) as total FROM tb_user WHERE role = '$attr'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    return $data;
}

function count_all($table)
{
    global $conn;

    $query = "SELECT count(*) as total FROM $table";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    return $data;
}

// sum total of products
function sum($table, $attr)
{
    global $conn;

    $query = "SELECT sum($attr) as sum FROM $table";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    return $data;
}
