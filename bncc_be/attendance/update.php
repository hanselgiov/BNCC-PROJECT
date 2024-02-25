<?php
    include 'config.php';

    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // validate email
    $q = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND id <> '$id'");
    $n = mysqli_num_rows($q);

    if($n > 0 ){

        echo "<script>
            alert('Email sudah digunakan');
            window.location.href = 'edit.php?id=$id';
        </script>";
    }

    else{

        // echo "$firstName $lastName $email $bio $id"; die();
        mysqli_query($conn, "UPDATE user SET firstName='$firstName', lastName='$lastName', email='$email', bio='$bio' WHERE id='$id'");
    
        echo "<script>
        alert('User berhasil di update');
        window.location.href = 'dashboard.php';
        </script>";
    }