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

    $id = "user_" . rand();
    $username = htmlspecialchars($data['username']);
    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $role = htmlspecialchars($data['role']);
    $password = htmlspecialchars($data['password']);
    $created_at = date('Y/m/d');

    $query = "INSERT INTO tb_user VALUES ('$id', '$username', '$email', '$no_hp', '$role', '$password', '$created_at', '$nama_lengkap')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function add_products($data, $table)
{
    global $conn;

    $id_product = 'barang_' + rand();
    $id_user = $data['id_user'];
    $nama_barang = $data['nama_barang'];
    $jumlah_barang = $data['jumlah_barang'];
    $tanggal_masuk = date('Y/m/d');

    $query = "INSERT INTO $table VALUES ('$id_product', '$id_user', '$nama_barang', '$jumlah_barang', '$tanggal_masuk')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
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
