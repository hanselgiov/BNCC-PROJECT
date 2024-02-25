<?php 

    include 'config.php';
    $id = $_GET['id'];

    // validate email
    $q = "SELECT * FROM user WHERE id='$id'";
    $r = mysqli_query($conn, $q);
    $n = mysqli_num_rows($r);

    if($n < 1){
        echo "<script>
        alert('User tidak ditemukan');
        window.location.href = 'dashboard.php';
        </script>";
        
    } else {
        mysqli_query($conn,"DELETE FROM user WHERE id='$id'");
            echo "<script>
            alert('User berhasil di hapus');
            window.location.href = 'dashboard.php';
            </script>";
    }

    