<?php

class Grup extends DB
{
    
    function getGrup()
    {
        $query = "SELECT * FROM grup";
        return $this->execute($query);
    }

    function getGrupById($id)
    {
        $query = "SELECT * FROM grup WHERE id_grup=$id";
        return $this->execute($query);
    }

     function searchGrup($key)
    {
        $query = "SELECT * FROM grup WHERE nama_grup LIKE '%" . $key . "%'";
        return $this->execute($query);
    }

    function addGrup($data)
    {
        $nama_grup = $data['nama_grup'];
        $query = "INSERT INTO grup VALUES('', '$nama_grup')";
        return $this->executeAffected($query);
    }

    function updateGrup($id, $data)
    {
        $nama_grup = $data['nama_grup'];
        $query = "UPDATE grup SET nama_grup='$nama_grup' WHERE id_grup='$id'";
        return $this->executeAffected($query);
    }

    function deleteGrup($id)
    {
        $query = "DELETE FROM grup WHERE id_grup='$id'";
        return $this->executeAffected($query);
    }
}
