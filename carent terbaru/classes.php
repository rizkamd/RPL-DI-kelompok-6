<?php

class Connection
{
    public $conn;
    public $servername,$username,$password,$table;
    function connect()
    {
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->table);

        if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }
}

class Customer
{
    public $id,$username,$password,$notelp,$nama,$ktp,$alamat,$conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    function uploadKTP($foto_ktp)
    {
        $foto_ktp_path = "fotoktp_".strval(rand(0,1000000)).$foto_ktp["name"];
        move_uploaded_file($foto_ktp["tmp_name"],"foto_ktp/$foto_ktp_path");
        $this->ktp = $foto_ktp_path;
    }

    function login() : mysqli_result
    {
        $q = $this->prepare(
            "SELECT * FROM customer WHERE username = ? AND password = ?",
            "ss",
            $this->username,
            $this->password
        );
        $q->execute();
        $res = $q->get_result();
        return $res;
    }

    function insertToDB()
    {
        $q = $this->prepare(
            "INSERT INTO customer (nama,username,password,alamat,notelp,ktp) VALUES (?,?,?,?,?,?)",
            "ssssis",
            $this->nama,
            $this->username,
            $this->password,
            $this->alamat,
            $this->notelp,
            $this->ktp
        );
        $q->execute();
    }

    function updateProfile()
    {
        $q = $this->prepare(
            "UPDATE customer SET nama = ?,username = ?,password = ?,alamat = ?,notelp = ?,ktp = ? WHERE id = ?",
            "ssssisi",
            $this->nama,
            $this->username,
            $this->password,
            $this->alamat,
            $this->notelp,
            $this->ktp,
            $this->id
        );
        $q->execute();
    }

    function getData()
    {
        $q = $this->prepare(
            "SELECT * FROM customer WHERE username = ? AND password = ?",
            "ss",
            $this->username,
            $this->password
        );
        $q->execute();
        $res = $q->get_result();
        return $res;
    }

    function getDataById($id)
    {
        $q = $this->prepare(
            "SELECT * FROM customer WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->username = $data["username"];
        $this->password = $data["password"];
        $this->alamat = $data["alamat"];
        $this->notelp = $data["notelp"];
        $this->ktp = $data["ktp"];
    }
}

class Admin
{
    public $conn,$username,$password;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    function login()
    {
        $q = $this->prepare(
            "SELECT * FROM admin WHERE username = ? AND password = ?",
            "ss",
            $this->username,
            $this->password
        );
        $q->execute();
        $res = $q->get_result();
        return $res;
    }

    function getDataById($id)
    {
        $q = $this->prepare(
            "SELECT * FROM admin WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->password = $data["password"];
    }

}

class MobilMatic
{
    public $conn,$id,$nama,$nopolisi,$merk,$foto,$harga12jam,$harga24jam;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    public function selectAll()
    {
        $q = $this->conn->query("SELECT * FROM mobilmatic");
        return $q;
    }

    public function getDataById($id)
    {
        $q = $this->prepare("SELECT * FROM mobilmatic WHERE id = ?","i",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->nopolisi = $data["nopolisi"];
        $this->merk = $data["merk"];
        $this->foto = $data["foto"];
        $this->harga12jam = $data["harga12jam"];
        $this->harga24jam = $data["harga24jam"];
    }

    function uploadFoto($foto)
    {
        $foto_path = "fotoktp_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_mobil/$foto_path");
        $this->foto = $foto_path;
    }

    public function insertMobil()
    {
        $q = $this->prepare(
            "INSERT INTO mobilmatic (nopolisi,merk,harga12jam,harga24jam,foto,nama) VALUES (?,?,?,?,?,?)",
            "ssiiss",
            $this->nopolisi,
            $this->merk,
            $this->harga12jam,
            $this->harga24jam,
            $this->foto,
            $this->nama
        );
        $q->execute();
    }

    public function updateMobil()
    {
        $q = $this->prepare(
            "UPDATE mobilmatic SET nopolisi=?,merk=?,harga12jam=?,harga24jam=?,foto=?,nama=? WHERE id = ?",
            "ssiissi",
            $this->nopolisi,
            $this->merk,
            $this->harga12jam,
            $this->harga24jam,
            $this->foto,
            $this->nama,
            $this->id
        );
        $q->execute();
    }

    public function deleteMobil()
    {
        $q = $this->prepare(
            "DELETE FROM mobilmatic WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }
}

class MobilKopling
{
    public $conn,$id,$nama,$nopolisi,$merk,$foto,$harga12jam,$harga24jam;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    public function selectAll()
    {
        $q = $this->conn->query("SELECT * FROM mobilkopling");
        return $q;
    }

    public function getDataById($id)
    {
        $q = $this->prepare("SELECT * FROM mobilkopling WHERE id = ?","i",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->nopolisi = $data["nopolisi"];
        $this->merk = $data["merk"];
        $this->foto = $data["foto"];
        $this->harga12jam = $data["harga12jam"];
        $this->harga24jam = $data["harga24jam"];
    }

    function uploadFoto($foto)
    {
        $foto_path = "fotoktp_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_mobil/$foto_path");
        $this->foto = $foto_path;
    }

    public function insertMobil()
    {
        $q = $this->prepare(
            "INSERT INTO mobilkopling (nopolisi,merk,harga12jam,harga24jam,foto,nama) VALUES (?,?,?,?,?,?)",
            "ssiiss",
            $this->nopolisi,
            $this->merk,
            $this->harga12jam,
            $this->harga24jam,
            $this->foto,
            $this->nama
        );
        $q->execute();
    }

    public function updateMobil()
    {
        $q = $this->prepare(
            "UPDATE mobilkopling SET nopolisi=?,merk=?,harga12jam=?,harga24jam=?,foto=?,nama=? WHERE id = ?",
            "ssiissi",
            $this->nopolisi,
            $this->merk,
            $this->harga12jam,
            $this->harga24jam,
            $this->foto,
            $this->nama,
            $this->id
        );
        $q->execute();
    }

    public function deleteMobil()
    {
        $q = $this->prepare(
            "DELETE FROM mobilkopling WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }
}

class Rental
{
    public $conn,$id_customer,$id_barang,$durasi,$tanggal,$harga,$jenis,$status,$uniqueid;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getDataByUniqueId($id)
    {
        $q = $this->prepare("SELECT * FROM rental WHERE uniqueid = ?","s",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->id_customer = $data["id_customer"];
        $this->id_barang = $data["id_barang"];
        $this->durasi = $data["durasi"];
        $this->tanggal = $data["tanggal"];
        $this->harga = $data["harga"];
        $this->jenis = $data["jenis"];
        $this->status = $data["status"];
        $this->uniqueid = $data["uniqueid"];
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    function deleteRentalByUniqueId($id)
    {
        $q = $this->prepare("DELETE FROM rental WHERE uniqueid = ?","i",$id);
        $q->execute();
    }

    function setStatusByUniqueId($status,$id)
    {
        $q = $this->prepare(
            "UPDATE rental SET status = ? WHERE uniqueid = ?",
            "si",
            $status,
            $id
        );
        $q->execute();
    }

    function insertRental()
    {
        $q = $this->prepare(
            "INSERT INTO rental (id_customer,id_barang,durasi,tanggal,harga,jenis,status,uniqueid) VALUES (?,?,?,?,?,?,?,?)",
            "iiisisss",
            $this->id_customer,
            $this->id_barang,
            $this->durasi,
            $this->tanggal,
            $this->harga,
            $this->jenis,
            $this->status,
            $this->uniqueid
        );
        $q->execute();
    }

    function selectAll()
    {
        $r = $this->conn->query("SELECT * FROM rental;");
        return $r;
    }
}

class StatusRental
{
    public static $menunggu_bukti_pembayaran = 0;
    public static $menunggu_bukti_pembayaran_diterima = 1;
    public static $bukti_pembayaran_diterima = 2;
    public static $bukti_pembayaran_ditolak = 3;
}

class MetodePembayaran
{
    public $id,$nama,$norek,$foto,$conn,$atasnama;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    public function getDataById($id)
    {
        $q = $this->prepare("SELECT * FROM metodepembayaran WHERE id = ?","i",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->norek = $data["norek"];
        $this->atasnama = $data["atasnama"];
        $this->foto = $data["foto"];
    }

    public function getDataByNama($nama)
    {
        $q = $this->prepare("SELECT * FROM metodepembayaran WHERE nama = ?","i",$nama);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->norek = $data["norek"];
        $this->atasnama = $data["atasnama"];
        $this->foto = $data["foto"];
    }

    function uploadFoto($foto)
    {
        $foto_path = "fotomp_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_mp/$foto_path");
        $this->foto = $foto_path;
    }

    function insertMetodePembayaran()
    {
        $q = $this->prepare(
            "INSERT INTO metodepembayaran (nama,norek,atasnama,foto) VALUES (?,?,?,?)",
            "ssss",
            $this->nama,
            $this->norek,
            $this->atasnama,
            $this->foto
        );
        $q->execute();
    }

    public function deleteMetodePembayaran()
    {
        $q = $this->prepare(
            "DELETE FROM metodepembayaran WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    public function updateMetodePembayaran()
    {
        $q = $this->prepare(
            "UPDATE metodepembayaran SET nama=?,norek=?,atasnama=?,foto=? WHERE id = ?",
            "ssssi",
            $this->nama,
            $this->norek,
            $this->atasnama,
            $this->foto,
            $this->id
        );
        $q->execute();
    }

    public function selectAll()
    {
        $q = $this->conn->query("SELECT * FROM metodepembayaran");
        return $q;
    }
}

class BuktiPembayaran
{
    public $id,$foto,$metode,$uniqueid,$id_customer,$conn;
    private $table = "buktipembayaranrental";

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function uploadFoto($foto)
    {
        $foto_path = "fotobukti_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_bukti/$foto_path");
        $this->foto = $foto_path;
    }
    
    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }
    
    public function getDataByUniqueId($id)
    {
        $q = $this->prepare("SELECT * FROM $this->table WHERE uniqueid = ?","i",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->id = $data["id"];
        $this->id_customer = $data["id_customer"];
        $this->foto = $data["foto"];
        $this->metode = $data["metode"];
        $this->uniqueid = $data["uniqueid"];
    }

    public function updateBuktiByUniqueId($id)
    {
        $q = $this->prepare(
            "UPDATE $this->table SET id_customer=?,foto=?,metode=? WHERE uniqueid = ?",
            "issi",
            $this->id_customer,
            $this->foto,
            $this->metode,
            $id
        );
        $q->execute();
    }

    public function deleteBuktiByUniqueId($id)
    {
        $q = $this->prepare("DELETE FROM $this->table WHERE uniqueid = ?","i",$id);
        $q->execute();
    }

    public function insertBuktiPembayaran()
    {
        $q = $this->prepare(
            "INSERT INTO $this->table (id_customer,metode,uniqueid) VALUES (?,?,?)",
            "sss",
            $this->id_customer,
            $this->metode,
            $this->uniqueid
        );
        $q->execute();
    }

    public function selectAll()
    {
        return $this->conn->query("SELECT * FROM $this->table");
    }
}

class JenisBarang
{
    public static $matic = "matic";
    public static $kopling = "kopling";
    public static $paketmatic = "paketmatic";
    public static $paketkopling = "paketkopling";
}

class Supir
{
    public $conn,$nama,$umur,$kelamin,$foto;
    private $table = "supir";

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    function selectAll()
    {
        $d = $this->conn->query("SELECT * FROM $this->table");
        return $d;
    }

    function getDataById($id)
    {
        $q = $this->prepare("SELECT * FROM $this->table WHERE id = ?","i",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();

        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->umur = $data["umur"];
        $this->kelamin = $data["kelamin"];
        $this->foto = $data["foto"];
    }

    function uploadFoto($foto)
    {
        $foto_path = "fotosupir_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_supir/$foto_path");
        $this->foto = $foto_path;
    }

    function insertSupir()
    {
        $q = $this->prepare(
            "INSERT INTO supir (nama,umur,kelamin,foto) VALUES (?,?,?,?)",
            "siss",
            $this->nama,
            $this->umur,
            $this->kelamin,
            $this->foto
        );
        $q->execute();

    }

    public function deleteSupir($id)
    {
        $q = $this->prepare(
            "DELETE FROM $this->table WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
    }

    public function updateSupir()
    {
        $q = $this->prepare(
            "UPDATE $this->table SET nama=?,umur=?,kelamin=?,foto=? WHERE id=?",
            "sissi",
            $this->nama,
            $this->umur,
            $this->kelamin,
            $this->foto,
            $this->id
        );
        $q->execute();
        
    }

}

class PaketKopling
{
    public $id,$id_mobil,$id_supir,$nama,$harga,$durasi,$foto,$conn;
    private $table = "paketkopling";

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function uploadFoto($foto)
    {
        $foto_path = "fotopaket_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_paket/$foto_path");
        $this->foto = $foto_path;
    }

    public function insertPaketKopling()
    {
        $q = $this->prepare(
            "INSERT INTO $this->table (id_mobil,id_supir,nama,harga,durasi,foto) VALUES (?,?,?,?,?,?)",
            "iisiis",
            $this->id_mobil,
            $this->id_supir,
            $this->nama,
            $this->harga,
            $this->durasi,
            $this->foto
        );
        $q->execute();
    }

    function deletePaket($id)
    {
        $this->prepare("DELETE FROM $this->table WHERE id = ?","i",$id)->execute();
    }

    public function selectAll()
    {
        $q = $this->conn->query("SELECT * FROM $this->table");
        return $q;
    }

    function updatePaket()
    {
        $q = $this->prepare(
            "UPDATE $this->table SET id_mobil=?,id_supir=?,nama=?,harga=?,durasi=?,foto=? WHERE id= ?",
            "iisiisi",
            $this->id_mobil,
            $this->id_supir,
            $this->nama,
            $this->harga,
            $this->durasi,
            $this->foto,
            $this->id
        );
        $q->execute();
    }

    function getDataById($id)
    {
        $q = $this->prepare("SELECT * FROM $this->table WHERE id = ?","i",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();

        $this->id = $data["id"];
        $this->id_mobil = $data["id_mobil"];
        $this->id_supir = $data["id_supir"];
        $this->nama = $data["nama"];
        $this->durasi = $data["durasi"];
        $this->harga = $data["harga"];
        $this->foto = $data["foto"];
    }
}

class PaketMatic
{
    public $id,$id_mobil,$id_supir,$nama,$harga,$durasi,$foto,$conn;
    private $table = "paketmatic";

    public function prepare($query,$type, ...$params) {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type, ...$params);
        return $stmt;
    }

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function uploadFoto($foto)
    {
        $foto_path = "fotopaket_".strval(rand(0,1000000)).$foto["name"];
        move_uploaded_file($foto["tmp_name"],"foto_paket/$foto_path");
        $this->foto = $foto_path;
    }

    public function insertPaketMatic()
    {
        $q = $this->prepare(
            "INSERT INTO $this->table (id_mobil,id_supir,nama,harga,durasi,foto) VALUES (?,?,?,?,?,?)",
            "iisiis",
            $this->id_mobil,
            $this->id_supir,
            $this->nama,
            $this->harga,
            $this->durasi,
            $this->foto
        );
        $q->execute();
    }

    function deletePaket($id)
    {
        $this->prepare("DELETE FROM $this->table WHERE id = ?","i",$id)->execute();
    }

    public function selectAll()
    {
        $q = $this->conn->query("SELECT * FROM $this->table");
        return $q;
    }

    function updatePaket()
    {
        $q = $this->prepare(
            "UPDATE $this->table SET id_mobil=?,id_supir=?,nama=?,harga=?,durasi=?,foto=? WHERE id= ?",
            "iisiisi",
            $this->id_mobil,
            $this->id_supir,
            $this->nama,
            $this->harga,
            $this->durasi,
            $this->foto,
            $this->id
        );
        $q->execute();
    }

    function getDataById($id)
    {
        $q = $this->prepare("SELECT * FROM $this->table WHERE id = ?","i",$id);
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();

        $this->id = $data["id"];
        $this->id_mobil = $data["id_mobil"];
        $this->id_supir = $data["id_supir"];
        $this->nama = $data["nama"];
        $this->durasi = $data["durasi"];
        $this->harga = $data["harga"];
        $this->foto = $data["foto"];
    }
}