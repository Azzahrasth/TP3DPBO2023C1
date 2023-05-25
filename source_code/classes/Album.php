<?php

// extends db biar nnti pas mau konek db gaperlu manggil db lgi
//  cukup manggil tabel2 nya aja, nah ini tabel album
class Album extends DB
{
    function getAlbumJoin()
    {
        $query = "SELECT * FROM album JOIN grup ON album.id_grup=grup.id_grup JOIN agensi ON album.id_agensi=agensi.id_agensi ORDER BY album.id_album";
        return $this->execute($query);
    }

    function getAlbum()
    {
        $query = "SELECT * FROM album";
        return $this->execute($query);
    }

    function getAlbumById($id)
    {
       $query = "SELECT * FROM album JOIN grup ON album.id_grup=grup.id_grup JOIN agensi ON album.id_agensi=agensi.id_agensi WHERE album.id_album = $id";

        return $this->execute($query);
    }

    function searchAlbum($key)
    {
       $query = "SELECT * FROM album  JOIN grup ON album.id_grup=grup.id_grup JOIN agensi ON album.id_agensi=agensi.id_agensi WHERE album.judul LIKE '%" . $key . "%'";
        return $this->execute($query);
    }
    function sortAlbumByJudul()
    {
       $query = "SELECT * FROM album  JOIN grup ON album.id_grup=grup.id_grup JOIN agensi ON album.id_agensi=agensi.id_agensi ORDER BY album.judul ASC";
        return $this->execute($query);
    }
    function sortAlbumByHarga()
    {
       $query = "SELECT * FROM album  JOIN grup ON album.id_grup=grup.id_grup JOIN agensi ON album.id_agensi=agensi.id_agensi ORDER BY album.harga ASC";
        return $this->execute($query);
    }

    function addAlbum($data, $file)
    {
        $targetDir = "./assets/images/";
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        $fileTargetDir = $targetDir . $image;

   
        if (!file_exists($fileTargetDir)) {
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        $judul = $data['judul'];
        $harga = $data['harga'];
        $id_grup = $data['id_grup'];
        $id_agensi = $data['id_agensi'];

        
        $query = "INSERT INTO album VALUES ('','$judul', '$harga', '$image',  '$id_grup', '$id_agensi')";
        
         return $this->executeAffected($query);
    }

    function updateAlbum($id, $data, $file)
    {
    
        $targetDir = "./assets/images/";
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        $fileTargetDir = $targetDir . $image;

   
        if (!file_exists($fileTargetDir)) {
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        $judul = $data['judul'];
        $harga = $data['harga'];
      
        $id_grup = $data['id_grup'];
        $id_agensi = $data['id_agensi'];

        $query = "UPDATE album SET judul='$judul', harga='$harga', cover='$image',
         id_grup='$id_grup', id_agensi='$id_agensi' WHERE id_album='$id'";
        

         return $this->executeAffected($query);
    }

    function deleteAlbum($id)
    {
        $query = "DELETE FROM album WHERE id_album='$id'";
        return $this->executeAffected($query);
    }
}
