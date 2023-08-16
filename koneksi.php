<?php 
    $conn = mysqli_connect("localhost","root","","dbteknikinformatika_abdulhakiimabyan");
 
    if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }
?>