<?php
include ("KontrakView.php");
include ("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
    private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
    private $tpl;

    function __construct()
    {
        //konstruktor
        $this->prosespasien = new ProsesPasien();
    }

    function tampil()
    {
        $this->prosespasien->prosesDataPasien();
        $data = null;

        //semua terkait tampilan adalah tanggung jawab view
        for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
            $no = $i + 1;
            $data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td>
				<a class='btn btn-success' href='index.php?id=" . $this->prosespasien->getId($i) . "'>Ubah</a>
				<a class='btn btn-danger' href='index.php?hapus=" . $this->prosespasien->getId($i) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>Hapus</a>
			</td>";
        }
        // Membaca template skin.html
        $this->tpl = new Template("templates/skin.html");

        // Mengganti kode Data_Tabel dengan data yang sudah diproses
        $this->tpl->replace("DATA_TABEL", $data);

        // Menampilkan ke layar
        $this->tpl->write();
    }

    function form_add()
    {
        $title = 'Tambah';
        $form = '
                <form action="index.php?add" method="POST">

                <br><br><div class="card">
                
                <div class="card-header bg-primary">
                <h1 class="text-white text-center">  Tambah Pasien </h1>
                </div><br>
        
                <label> NIK: </label>
                <input type="text" name="nik" class="form-control"> <br>
    
                <label> NAMA: </label>
                <input type="text" name="nama" class="form-control"> <br>
    
                <label> TEMPAT: </label>
                <input type="text" name="tempat" class="form-control"> <br>
    
                <label> TANGGAL LAHIR: </label>
                <input type="date" name="tl" class="form-control"> <br>
    
                <label> GENDER: </label>
                <select class="form-control" id="gender" name="gender" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
                </select> <br>
    
                <label> EMAIL: </label>
                <input type="text" name="email" class="form-control"> <br>
    
                <label> TELP: </label>
                <input type="text" name="telp" class="form-control"> <br>
                
                <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>
        
                </div>
                </form>';


        $view = new Template("templates/skinform.html");
        $view->replace("DATA_FORM", $form);
        $view->replace("DATA_TITLE", $title);
        $view->write();
    }

    function form_edit($id)
    {
        $pasien = $this->prosespasien->getDataPasienById($id);
        $laki_laki = ($pasien->getGender() == "Laki-laki") ? 'selected' : '';
        $perempuan = ($pasien->getGender() == "Perempuan") ? 'selected' : '';

        $title = 'Update';

        $form = '
        <form action="index.php?id=' . $id . '" method="POST">
        <input type="hidden" name="id" value="' . $id . '">
        <br><br><div class="card">
        
        <div class="card-header bg-primary">
        <h1 class="text-white text-center">  Update Pasien </h1>
        </div><br>

        <label> NIK: </label>
        <input type="text" name="nik" class="form-control" value="' . $pasien->getNik() . '"> <br>

        <label> NAMA: </label>
        <input type="text" name="nama" class="form-control" value="' . $pasien->getNama() . '"> <br>

        <label> TEMPAT: </label>
        <input type="text" name="tempat" class="form-control" value="' . $pasien->getTempat() . '"> <br>

        <label> TANGGAL LAHIR: </label>
        <input type="date" name="tl" class="form-control" value="' . $pasien->getTl() . '"> <br>

        <label> GENDER: </label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="Laki-laki" ' . $laki_laki . '>Laki-laki</option>
            <option value="Perempuan" ' . $perempuan . '>Perempuan</option>
        </select>

        <label> EMAIL: </label>
        <input type="text" name="email" class="form-control" value="' . $pasien->getEmail() . '"> <br>

        <label> TELP: </label>
        <input type="text" name="telp" class="form-control" value="' . $pasien->getTelp() . '"> <br>
        
        <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
        <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

        </div>
        </form>';


        $view = new Template("templates/skinform.html");
        $view->replace("DATA_FORM", $form);
        $view->replace("DATA_TITLE", $title);
        $view->write();
    }

    function add($data)
    {
        $this->prosespasien->add($data);
    }
    function update($data)
    {
        $this->prosespasien->update($data);
    }
    function delete($id)
    {
        $this->prosespasien->delete($id);
    }
}