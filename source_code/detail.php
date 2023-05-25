<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Grup.php');
include('classes/Album.php');
include('classes/Template.php');

$album = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$album->open();

$data = nulL;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $id = $_GET['id'];
        $album->getAlbumById($id);
        $row = $album->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['judul'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['cover'] . '" class="img-thumbnail" alt="' . $row['cover'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td>' . $row['judul'] . '</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>Rp. ' . number_format($row['harga'], 0, ',', '.') . '</td>
                                </tr>
                                <tr>
                                    <td>Grup</td>
                                    <td>:</td>
                                    <td>' . $row['nama_grup'] . '</td>
                                </tr>
                                <tr>
                                    <td>Agensi</td>
                                    <td>:</td>
                                    <td>' . $row['nama_agensi'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="form_album.php?edit=' . $row['id_album'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['id_album'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($album->deleteAlbum($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$album->close();

$view = new Template('templates/skindetail.html');
$view->replace('DATA_DETAIL_ALBUM', $data);
$view->write();
