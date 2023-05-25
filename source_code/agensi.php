<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Template.php');

$agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$agensi->open();

if (isset($_POST['btn-cari'])) {
    $agensi->searchAgensi($_POST['cari']);
} else {
    $agensi->getAgensi();
}

$dataForm = null;


$view = new Template('templates/skintabel.html');


$mainTitle = 'Agensi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Agensi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'agensi';

while ($div = $agensi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_agensi'] . '</td>
    <td style="font-size: 22px;">
        <a href="agensi.php?edit=' . $div['id_agensi'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="agensi.php?hapus=' . $div['id_agensi'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($agensi->deleteAgensi($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'agensi.php';
            </script>";
        }
    }
}

if (!isset($_GET['edit'], $_GET['hapus'])) {
    $inputTitle = "Tambah Agensi";
    $dataForm = "
            <div class='mb-3'>
              <label for='nama_agensi' class='form-label'>Nama Agensi</label>
              <input type='text' class='form-control' id='nama_agensi' name='nama_agensi' placeholder='Masukan Nama Agensi...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-submit' id='btn-submit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-submit'])) {
     

       
          if ($agensi->addAgensi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'agensi.php';
            </script>";
        }
    }
}



if (isset($_GET['edit'])) {
    
    $id = $_GET['edit'];

    $agensi->getAgensiById($id);
    list($id_agensi, $nama_agensi) = $agensi->getResult();

    $inputTitle = "Edit Agensi";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_agensi' name='id_agensi' value='". $id_agensi ."' />
              <label for='nama_agensi' class='form-label'>Nama agensi</label>
              <input type='text' class='form-control' id='nama_agensi' name='nama_agensi' value='". $nama_agensi ."' placeholder='Masukan Nama agensi...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Update</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-edit'])) {
    
       
         if ($agensi->updateAgensi($id, $_POST) > 0) {
            echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'agensi.php';
            </script>";
        }
    }
}

$agensi->close();
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace("DATA_INPUT_TITLE", $inputTitle);
$view->replace("DATA_INPUT_FORM", $dataForm);
$view->write();
