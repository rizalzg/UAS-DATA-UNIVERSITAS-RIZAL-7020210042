<?php
class Employee
{
    // Connection
    private $conn;
    // Table
    private $db_table = "Employee";
    // Columns
    public $id;
    public $kode;
    public $namaprogramstudi;
    public $jenjang;
    public $akreditasi;
    public $status;
    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getEmployees()
    {
        $sqlQuery = "SELECT id, kode, namaprogramstudi, jenjang, akreditasi, status FROM "
            . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createEmployee()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                    kode = :kode,
                    namaprogramstudi = :namaprogramstudi,
                    jenjang = :jenjang,
                    akreditasi = :akreditasi,
                    status = :status";
        $stmt = $this->conn->prepare($sqlQuery);
        // sanitize
        $this->kode = htmlspecialchars(strip_tags($this->kode));
        $this->namaprogramstudi = htmlspecialchars(strip_tags($this->namaprogramstudi));
        $this->jenjang = htmlspecialchars(strip_tags($this->jenjang));
        $this->akreditasi = htmlspecialchars(strip_tags($this->akreditasi));
        $this->status = htmlspecialchars(strip_tags($this->status));
        // bind data
        $stmt->bindParam(":kode", $this->kode);
        $stmt->bindParam(":namaprogramstudi", $this->namaprogramstudi);
        $stmt->bindParam(":jenjang", $this->jenjang);
        $stmt->bindParam(":akreditasi", $this->akreditasi);
        $stmt->bindParam(":status", $this->status);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // READ single
    public function getSingleEmployee()
    {
        $sqlQuery = "SELECT
                        id,
                        kode,
                        namaprogramstudi,
                        jenjang,
                        akreditasi,
                        status
                    FROM
                        " . $this->db_table . "
                WHERE
                        id = ?
                LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->kode = $dataRow['kode'];
        $this->namaprogramstudi = $dataRow['namaprogramstudi'];
        $this->jenjang = $dataRow['jenjang'];
        $this->akreditasi = $dataRow['akreditasi'];
        $this->status = $dataRow['status'];
    }
    // UPDATE
    public function updateEmployee()
    {
        $sqlQuery = "UPDATE
                    " . $this->db_table . "
                SET
                    kode = :kode,
                    namaprogramstudi = :namaprogramstudi,
                    jenjang = :jenjang,
                    akreditasi = :akreditasi,
                    status = :status
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->kode = htmlspecialchars(strip_tags($this->kode));
        $this->namaprogramstudi = htmlspecialchars(strip_tags($this->namaprogramstudi));
        $this->jenjang = htmlspecialchars(strip_tags($this->jenjang));
        $this->akreditasi = htmlspecialchars(strip_tags($this->akreditasi));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":kode", $this->kode);
        $stmt->bindParam(":namaprogramstudi", $this->namaprogramstudi);
        $stmt->bindParam(":jenjang", $this->jenjang);
        $stmt->bindParam(":akreditasi", $this->akreditasi);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // DELETE
    function deleteEmployee()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
