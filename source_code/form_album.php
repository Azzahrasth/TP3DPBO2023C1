<?php 

    include('config/db.php');
    include('classes/DB.php');
    include('classes/Agensi.php');
    include('classes/Grup.php');
    include('classes/Album.php');
    include('classes/Template.php');

    $album = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $album->open();

    $grup = new Grup($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $grup->open();

    $agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $agensi->open();

    $grup->getGrup();
    $agensi->getAgensi();
    $view = new Template("templates/skinform.html");

    if (isset($_GET['edit'])) {
        $title = "Edit Album";
        $id = $_GET['edit'];
        $album->getAlbumById($id);

 

        list($id_album, $judul, $harga, $cover, $id_grup, $id_agensi) = $album->getResult();
    
        $data_grup = null;
        while( list($id_grup, $nama_grup) = $grup->getResult()){
            $data_grup .= "
            <option value=". $id_grup .">". $nama_grup ."</option>";
         }
        
        $data_agensi = null;
        while(list($id_agensi, $nama_agensi) = $agensi->getResult()){
            $data_agensi .= "
            <option value=". $id_agensi .">". $nama_agensi ."</option>";
        }
 
        if (isset($_POST['btn-submit'])) {
            $album->updateAlbum($id, $_POST, $_FILES);
            header("location:index.php");
        }
        
        $view->replace("DATA_JUDUL", $judul);
        $view->replace("DATA_HARGA", $harga);

    }else{
        
        $title = "Tambah Album";
        $data_grup = null;
        while( list($id_grup, $nama_grup) = $grup->getResult()){
            $data_grup .= "
            <option value=". $id_grup .">". $nama_grup ."</option>";
        }
        
        $data_agensi = null;
        while(list($id_agensi, $nama_agensi) = $agensi->getResult()){
            $data_agensi .= "
            <option value=". $id_agensi .">". $nama_agensi ."</option> ";
        }
        
        if (isset($_POST['btn-submit'])) {
            $album->addAlbum($_POST, $_FILES);
            header("location:index.php");
        }

    }


$album->close();
$grup->close();
$agensi->close();

$view->replace("DATA_AGENSI", $data_agensi);
$view->replace("DATA_GRUP", $data_grup);
$view->replace("DATA_TITLE", $title);
$view->write();

?>