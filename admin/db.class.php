<?php

class db
{

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $port = "3306";
    private $table_name;
    private $dbname = "database";
    private $conn;
    public function __construct($table_name)
    {
        $this->table_name = $table_name;
        $this->conn = $this->conn();
    }

    public function conn()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
            return $this->conn;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function insert($data)
    {
        $sql = "INSERT INTO $this->table_name (";
        $flag = 0;
        $array_values = [];
        unset($data["id"]);

        foreach ($data as $campo => $valor) {
            $sql .= $flag == 0 ? "$campo" : ",$campo";
            $flag = 1;
        }

        $sql .= ") VALUES (";
        $flag = 0;

        foreach ($data as $campo => $valor) {
            $sql .= $flag == 0 ? "?" : ",?";
            $flag = 1;
            $array_values[] = $valor;
        }
        $sql .= ")";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($array_values);
    }

    public function update($data)
    {
        $sql = "UPDATE $this->table_name SET ";
        $flag = 0;
        $id = $data['id'];
        $array_values = [];

        foreach ($data as $campo => $valor) {
            $sql .= $flag == 0 ? "$campo=?" : ",$campo=?";
            $flag = 1;
            $array_values[] = $valor;
        }
        $sql .= " WHERE id = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($array_values);
    }

    public function all($table_name = null)
    {
        $table_name = !empty($table_name) ? $table_name : $this->table_name;
        $sql = "SELECT * FROM $table_name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function filter($data, $column = 'email')
    {
        $val = $data[$column];

        if (!isset($data[$column])) {
            return [];
        }

        if ($column == 'nome' || $column == 'username' || $column == 'nome_completo') {
            $sql = "SELECT * FROM $this->table_name WHERE LOWER($column) LIKE LOWER(?)";
            $val = "%$val%";
        } elseif ($column == 'email') {
            $sql = "SELECT * FROM $this->table_name WHERE $column = ?";
        } else {
            $sql = "SELECT * FROM $this->table_name WHERE $column = ?";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$val]);

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function find($id, $table_name = null)
    {
        $table_name = !empty($table_name) ? $table_name : $this->table_name;

        $sql = "SELECT * FROM $table_name WHERE id LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetchObject();
    }

    public function destroy($id)
    {
        $sql = "DELETE FROM $this->table_name WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    function checkLogin()
    {
        if (empty($_SESSION['username'])) {
            session_destroy();
            header("Location: ./login.php?error=" . urlencode("Faça login para acessar essa página!"));
            exit();
        }
    }

    function checkAdminLogin()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
            session_destroy();
            header("Location: ./login.php?error=" . urlencode("Faça login para acessar essa página!"));
            exit();
        }
    }
}
?>