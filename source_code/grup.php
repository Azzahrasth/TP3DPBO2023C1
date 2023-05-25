<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Grup.php');
include('classes/Template.php');

$grup = new Grup($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$grup->open();

if (isset($_POST['btn-cari'])) {
    $grup->searchGrup($_POST['cari']);
} else {
    $grup->getGrup();
}

$dataForm = null;


$view = new Template('templates/skintabel.html');


$mainTitle = 'Grup';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Grup</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'grup';

while ($div = $grup->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_grup'] . '</td>
    <td style="font-size: 22px;">
        <a href="grup.php?edit=' . $div['id_grup'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="grup.php?hapus=' . $div['id_grup'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($grup->deleteGrup($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'grup.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'grup.php';
            </script>";
        }
    }
}

if (!isset($_GET['edit'], $_GET['hapus'])) {
    $inputTitle = "Tambah Grup";
    $dataForm = "
            <div class='mb-3'>
              <label for='nama_grup' class='form-label'>Nama Grup</label>
              <input type='text' class='form-control' id='nama_grup' name='nama_grup' placeholder='Masukan Nama Grup...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-submit' id='btn-submit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-submit'])) {

        if ($grup->addGrup($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'grup.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'grup.php';
            </script>";
        }
    }
}



if (isset($_GET['edit'])) {
    
    $id = $_GET['edit'];

    $grup->getGrupById($id);
    list($id_grup, $nama_grup) = $grup->getResult();

    $inputTitle = "Edit Grup";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_grup' name='id_grup' value='". $id_grup ."' />
              <label for='nama_grup' class='form-label'>Nama grup</label>
              <input type='text' class='form-control' id='nama_grup' name='nama_grup' value='". $nama_grup ."' placeholder='Masukan Nama Grup...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Update</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-edit'])) {
    
         if ($grup->updateGrup($id, $_POST) > 0) {
            echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'grup.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'grup.php';
            </script>";
        }
    }
}

$grup->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace("DATA_INPUT_TITLE", $inputTitle);
$view->replace("DATA_INPUT_FORM", $dataForm);
$view->write();
