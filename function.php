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

    $id = "brg" . rand();
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

function add_products($data)
{
    global $conn;

    $id = "brg" . rand();
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

function count_total($attr)
{
    global $conn;

    $query = "SELECT count(role) as total FROM tb_user WHERE role = '$attr'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    echo mysqli_error($conn);

    return $data;
}
