<?php 

/******************************************
TUGAS PRAKTIKUM 4
NAMA   : ANNISA MUJA AHIDAH
NIM    : 1902125
******************************************/

class Lomba extends DB{
	
	// Mengambil data
	function getLomba()
	{
		// Query mysql select data ke tb_pasien
		$query = "SELECT * FROM tb_pasien";

		// Mengeksekusi query
		return $this->execute($query);
	}

	//menambahkan data
	function insert($data)
	{
		$tnama = $data['tnama'];
		$tttl = $data['tttl'];
		$talamat = $data['talamat'];
        $tasal_sekolah = $data['tasalsekolah'];
		$tmata_lomba = $data['tmata_lomba'];
        $status_bayar = "Belum Bayar";

		// Query mysql insert data ke tb_pasien
		$query = "INSERT INTO tb_pasien (nama_td, tanggal_lahir_td, alamat_td, asal_sekolah_td, mata_lomba_td, status_bayar_td)
		VALUES ('$tnama', '$tttl', '$talamat', '$tasal_sekolah', '$tmata_lomba', '$tstatus_bayar') ";

		// Mengeksekusi query
		return $this->execute($query);
	}

	//menghapus tabel
	function delete()
	{
		$id = $_GET[‘tnama’];
		//query for delete data in database
		$query = "DELETE from tb_pasien WHERE name_td = ‘$tnama’" ;

		// Mengeksekusi query
		return $this->execute($query);
	}

	//selesai
	function finish()
	{	
		$tstatus_bayar = "Sudah Bayar";
		$query = "UPDATE tb_pasien SET status_bayar_td='Sudah Bayar'";
		// Mengeksekusi query
		return $this->execute($query);
	}

}

?>
