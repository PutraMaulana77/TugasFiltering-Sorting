<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'User/koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	
	if($data['level']=="Guru"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "Guru";
		// alihkan ke halaman dashboard admin
		header("location:Admin/index2.php");

    }else if($data['level']=="Siswa"){
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "Siswa";
        // alihkan ke halaman dashboard pegawai
        header("location:User/index2.php");

	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
 
?>