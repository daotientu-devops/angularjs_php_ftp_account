<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 04/07/2016
 * Time: 11:13 SA
 */
require_once 'config.php';

class dbHelper
{
    private $db;
    private $err;

    function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        try {
            $this->db = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            $response["status"] = "error";
            $response["message"] = 'Connection failed; ' . $e->getMessage();
            $response["data"] = null;
            echoResponse(200, $response);
            exit;
        }
    }

    /**
     * Fetching single record
     * @param $table
     * @param $columns
     * @param $where
     * @return mixed
     */
    public function getOneRecord($query)
    {
        $r = $this->db->query($query . ' LIMIT 1') or die($this->db->error . __LINE__);
        return $result = $r->fetch();
    }

    /**
     * Creating new record
     * @param $table
     * @param $columns
     * @param $where
     * @return mixed
     */
    public function insertIntoTable($obj, $column_names, $table_name)
    {
        $c = (array)$obj;
        $keys = array_keys($c);
        $columns = '';
        $values = '';
        foreach ($column_names as $desired_key) {   // Check the obj received. If blank insert blank into the array.
            if (!in_array($desired_key, $keys)) {
                $$desired_key = '';
            } else {
                $$desired_key = $c[$desired_key];
            }
            $columns = $columns . $desired_key . ',';
            $values = $values . "'" . $$desired_key . "',";
        }
        $query = "INSERT INTO " . $table_name . "(" . trim($columns, ',') . ") VALUES (" . trim($values, ',') . ")";
        $r = $this->db->query($query) or die($this->db->error . __LINE__);

        if ($r) {
            $new_row_id = $this->db->lastInsertId();
            return $new_row_id;
        } else {
            return NULL;
        }
    }

    /**
     * Get Session
     * @param $table
     * @param $columns
     * @param $where
     * @return mixed
     */
    public function getSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $sess = array();
        if (isset($_SESSION['id'])) {
            $sess["id"] = $_SESSION['id'];
            $sess["name"] = $_SESSION['name'];
            $sess["email"] = $_SESSION['email'];
        } else {
            $sess["id"] = '';
            $sess["name"] = 'Guest';
            $sess["email"] = '';
        }
        return $sess;
    }

    /**
     * Destroy Session
     * @param $table
     * @param $columns
     * @param $where
     * @return mixed
     */
    public function destroySession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['id'])) {
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            $info = 'info';
            if (isset($_COOKIE[$info])) {

            }
            $msg = "Logged Out Successfully...";
        } else {
            $msg = "Not logged in...";
        }
        return $msg;
    }

    function select($table, $columns, $where)
    {
        try {
            $a = array();
            $w = '';
            foreach ($where as $key => $value) {
                $w .= " and " . $key . " like :" . $key;
                $a[":" . $key] = $value;
            }
            $stmt = $this->db->prepare("select " . $columns . " from " . $table . " where 1=1 " . $w);
            $stmt->execute($a);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $response['data'] = $rows;
        } catch (PDOException $e) {
            $response['status'] = "error";
            $response['message'] = 'Select Failed: ' . $e->getMessage();
            $response['data'] = null;
        }
        return $response;
    }

    function select2($table, $columns, $where, $order)
    {
        try {

        } catch (PDOException $e) {

        }
    }

    function insert($table, $columnsArray, $requiredColumnsArray)
    {
        $this->verifyRequiredParams($columnsArray, $requiredColumnsArray);

        try {
            $a = array();
            $c = "";
            $v = "";
            foreach ($columnsArray as $key => $value) {
                $c .= $key . ", ";
                $v .= ":" . $key . ", ";
                $a[":" . $key] = $value;
            }
            $c = rtrim($c, ', ');
            $v = rtrim($v, ', ');
            $stmt = $this->db->prepare("INSERT INTO $table($c) VALUES ($v)");
            $stmt->execute($a);
            $affected_rows = $stmt->rowCount();
            $lastInsertId = $this->db->lastInsertId();
            $response["status"] = "success";
            $response["message"] = $affected_rows . " row inserted into database";
            $response["data"] = $lastInsertId;
        } catch (PDOException $e) {
            $response["status"] = "error";
            $response["message"] = "Insert Failed: " . $e->getMessage();
            $response["data"] = 0;
        }
        return $response;
    }

    function update($table, $columnsArray, $where, $requiredColumnsArray)
    {
        $this->verifyRequiredParams($columnsArray, $requiredColumnsArray);

        try {
            $a = array();
            $w = "";
            $c = "";
            foreach ($where as $key => $value) {
                $w .= " and " . $key . " = :" . $key;
                $a[":" . $key] = $value;
            }
            foreach ($columnsArray as $key => $value) {
                $c .= $key . " = :" . $key . ", ";
                $a[":" . $key] = $value;
            }
            $c = rtrim($c, ", ");
            $stmt = $this->db->prepare("UPDATE $table SET $c WHERE 1=1 " . $w);
            $stmt->execute($a);
            $affected_rows = $stmt->rowCount();
            if ($affected_rows <= 0) {
                $response["status"] = "warning";
                $response["message"] = "No row updated";
            } else {
                $response["status"] = "success";
                $response["message"] = $affected_rows . " row(s) updated in database";
            }
        } catch (PDOException $e) {
            $response["status"] = "error";
            $response["message"] = "Update Failed: " . $e->getMessage();
        }
        return $response;
    }

    function delete($table, $where)
    {
        if (count($where) <= 0) {
            $response["status"] = "warning";
            $response["message"] = "Delete Failed: At least one condition is required";
        } else {
            try {
                $a = array();
                $w = "";
                foreach ($where as $key => $value) {
                    $w .= " and " . $key . " = :" . $key;
                    $a[":" . $key] = $value;
                }
                $stmt = $this->db->prepare("DELETE FROM $table WHERE 1=1 " . $w);
                $stmt->execute($a);
                $affected_rows = $stmt->rowCount();
                if ($affected_rows <= 0) {
                    $response["status"] = "warning";
                    $response["message"] = "No row deleted";
                } else {
                    $response["status"] = "success";
                    $response["message"] = $affected_rows . " row(s) deleted from database";
                }
            } catch (PDOException $e) {
                $response["status"] = "error";
                $response["message"] = "Delete Failed: " . $e->getMessage();
            }
        }
        return $response;
    }

    function verifyRequiredParams($inArray, $requiredColumns)
    {
        $error = false;
        $errorColumns = "";
        foreach ($requiredColumns as $field) {
            if (!isset($inArray->$field) || strlen(trim($inArray->$field)) <= 0) {
                $error = true;
                $errorColumns .= $field . ', ';
            }
        }

        if ($error) {
            $response = array();
            $response["status"] = "error";
            $response["message"] = 'Required field(s) ' . rtrim($errorColumns, ', ') . ' is missing or empty';
            echoResponse(200, $response); // Lỗi 200
            exit;
        }
    }
}