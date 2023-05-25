<?php

class Agensi extends DB
{
    function getAgensi()
    {
        $query = "SELECT * FROM agensi";
        return $this->execute($query);
    }

    function getAgensiById($id)
    {
        $query = "SELECT * FROM agensi WHERE id_agensi=$id";
        return $this->execute($query);
    }

    function searchAgensi($key)
    {
        $query = "SELECT * FROM agensi WHERE nama_agensi LIKE '%" . $key . "%'";
        return $this->execute($query);
    }
    function addAgensi($data)
    {
        $nama_agensi = $data['nama_agensi'];
       
        $query = "INSERT INTO agensi VALUES('', '$nama_agensi')";
        return $this->executeAffected($query);
    }


    function updateAgensi($id, $data)
    {
        $nama_agensi = $data['nama_agensi'];
        $query = "UPDATE agensi SET nama_agensi='$nama_agensi' WHERE id_agensi='$id'";
        return $this->executeAffected($query);
    }

    function deleteAgensi($id)
    {
        $query = "DELETE FROM agensi WHERE id_agensi='$id'";
        return $this->executeAffected($query);
    }
}
