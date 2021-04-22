<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Lomba.class.php");

// Membuat objek dari kelas task
$otask = new Lomba($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getLomba();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

//jika menerima post form
if ($isset($_POST['add'])) {
	// memanggil method untuk insert data
	$otask->insert($_POST);

	header("Location: index.php");
}

while (list($id, $tnama, $tttl, $talamat, $tasal_sekolah, $tmata_lomba, $tstatus_bayar) = $otask->getResult()) {
	// Tampilan jika user sudah membayar biaya pendaftaran 
	if($tstatus_bayar == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $talamat . "</td>
		<td>" . $tasal_sekolah . "</td>
		<td>" . $tmata_lomba . "</td>
		<td>" . $tstatus_bayar . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika user belum membayar pendaftaran 
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $talamat . "</td>
		<td>" . $tasal_sekolah . "</td>
		<td>" . $tmata_lomba . "</td>
		<td>" . $tstatus_bayar . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' name='update' ><a href='index.php?id_status_bayar=" . $id .  "' style='color: white; font-weight: bold;'>Sudah Bayar</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// delete
if ($isset($_GET['id_hapus'])) {
	//mengambil nilai dari get
	$id_task = $_GET['id_hapus'];

	//menghapus data berdasarkan id
	$otask->delete($id_hapus);

	//unset get
	unset($_GET['id_hapus']);

	header("Location: index.php");
}

// proses selesai
if($isset($_POST['selesai'])){

	$otask->finish($_POST);

	header("Location: index.php");
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/desain.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();