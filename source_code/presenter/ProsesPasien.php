<?php

include ("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender
				$pasien->setEmail($row['email']); //mengisi email
				$pasien->setTelp($row['telp']); //mengisi telepon

				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan email Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		//mengembalikan telp Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}

	function getDataPasienById($id)
	{
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->getPasienById($id);

			$row = $this->tabelpasien->getResult();
			$data = new Pasien();
			$data->setId($row['id']);
			$data->setNik($row['nik']);
			$data->setNama($row['nama']);
			$data->setTempat($row['tempat']);
			$data->setTl($row['tl']);
			$data->setGender($row['gender']);
			$data->setEmail($row['email']);
			$data->setTelp($row['telp']);

			$this->tabelpasien->close();
			return $data;
		} catch (Exception $e) {
			echo "wiw error " . $e->getMessage();
		}
	}

	function add($data)
	{
		try {
			$this->tabelpasien->open();
			$result = $this->tabelpasien->add_pasien($data);
			if ($result) {
				echo "<script>
					alert('Pasien telah berhasil ditambahkan!');
					document.location.href = 'index.php';
				</script>";
			} else {
				echo "<script>
					alert('Pasien gagal untuk ditambahkan!');
					document.location.href = 'index.php';
				</script>";
			}
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error " . $e->getMessage();
		}
	}

	function update($data)
	{
		try {
			$this->tabelpasien->open();
			$result = $this->tabelpasien->update_pasien($data);
			if ($result) {
				echo "<script>
				alert('Pasien telah berhasil diubah!');
				document.location.href = 'index.php';
				</script>";
			} else {
				echo "<script>
				alert('Pasien gagal untuk diubah!');
				document.location.href = 'index.php';
				</script>";
			}
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error " . $e->getMessage();
		}
	}

	function delete($id)
	{
		try {
			$this->tabelpasien->open();
			$result = $this->tabelpasien->delete_pasien($id);
			if ($result) {
				echo "<script>
						alert('Pasien telah berhasil dihapus!');
						document.location.href = 'index.php';
					  </script>";
			} else {
				echo "<script>
						alert('Pasien gagal untuk dihapus!');
						document.location.href = 'index.php';
					  </script>";
			}

			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error " . $e->getMessage();
		}
	}

}