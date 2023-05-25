<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Grup.php');
include('classes/Album.php');
include('classes/Template.php');

// buat instances album
$listAlbum = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi ke db
$listAlbum->open();

// select data Album
$listAlbum->getAlbumJoin();

// cari Album
if (isset($_POST['btn-cari'])) {
    // metod mencari data Album
    $listAlbum->searchAlbum($_POST['cari']);
} 
else if (isset($_POST['btn-sort-judul'])) {
    // metod mencari data Album
    $listAlbum->sortAlbumByJudul();
} 
else if (isset($_POST['btn-sort-harga'])) {
    // metod mencari data Album
    $listAlbum->sortAlbumByHarga();
} else {
    // method menampilkan data Album
    $listAlbum->getAlbumJoin();
}

$data = null;

// ambil data oengrus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listAlbum->getResult()) {
    // kenapa .= karna dia mau concat data sebelumnya dg data baru, jdi diambung bukan di replace
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 album-thumbnail">
        <a href="detail.php?id=' . $row['id_album'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['cover'] . '" class="card-img-top" alt="' . $row['cover'] . '">
            </div>
        </a>
            <div class="card-body">
                <p class="card-text album-judul my-0">' . $row['judul'] . '</p>
                <p class="card-text album-harga">Rp.  ' . number_format($row['harga'], 0, ',', '.') . '</p>
                <p class="card-text grup-nama">' . $row['nama_grup'] . '</p>
                <p class="card-text agensi-nama my-0">' . $row['nama_agensi'] . '</p>
            </div>
        
    </div>    
    </div>';
}

// tutup koneksi db
$listAlbum->close();

// buat instance tamplate
$home = new Template('templates/skin.html');

// simpan data ke html
$home->replace('DATA_ALBUM', $data);
$home->write();
