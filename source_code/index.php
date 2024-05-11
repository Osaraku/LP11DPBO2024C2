<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

include ("model/Template.class.php");
include ("model/DB.class.php");
include ("model/Pasien.class.php");
include ("model/TabelPasien.class.php");
include ("view/TampilPasien.php");


$tp = new TampilPasien();

if (isset($_GET['add'])) {
    if (isset($_POST['submit'])) {
        $data = $tp->add($_POST);
    } else {
        $data = $tp->form_add();
    }
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['submit'])) {
        $data = $tp->update($_POST);
    } else {
        $data = $tp->form_edit($id);
    }
} else if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $data = $tp->delete($id);

} else {
    $data = $tp->tampil();
}