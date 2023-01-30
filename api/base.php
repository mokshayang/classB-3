<?php
session_start();
date_default_timezone_set("Asia/Taipei");
class DB
{
    protected $table;
    protected $psn = "mysql:host=localhost;charset=utf8;dbname=db15";
    protected $pdo;
    function __construct($table)
    {
        $this->pdo = new PDO($this->psn, 'root', '');
        $this->table = $table;
    }
    //public array.each
    private function arrayToSqlArray($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }

    function all(...$args)
    {
        $sql = "select * from $this->table";
        if (isset($args[0])) {
            if (is_array($args[0])) {
                $tmp = $this->arrayToSqlArray($args[0]);
                $sql .= " where " . join(" && ", $tmp);
            } else {
                $sql .= $args[0];
            }
        }
        if (isset($args[1])) {
            $sql .= $args[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($id)
    {
        $sql = "select * from $this->table";
        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function del($id)
    {
        $sql = "delete from $this->table";
        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }

    function save($array)
    {
        if (isset($array['id'])) {
            $id = $array['id'];//先將id存為變數
            unset($array['id']);//註銷ID
            $tmp = $this->arrayToSqlArray($array);//引入each
            $sql = "update $this->table set ";//sql語法 update table set ``='' , ``='' .. where `id` = $id;
            $sql .= join(" , ", $tmp);
            $sql .= " where `id`=$id";
        } else {
            $cols = array_keys($array);
            $sql = "insert into $this->table (`" . join("` , `", $cols) . "`)  values ('" . join("','", $array) . "')";
        }
        dd($sql);
        return $this->pdo->exec($sql);
    }

    function mathSql($math, $col, ...$arg)
    {
        if (isset($arg[0])) {
            $tmp = $this->arrayToSqlArray($arg[0]);
            $sql = "select $math($col) from $this->table where";
            $sql .= join(" && ", $tmp);
        } else {
            $sql = "select $math($col) from $this->table";
        }
        return $sql;
    }
    //mach mode
    function count(...$arg)
    {
        $sql = $this->mathSql("count", "*", ...$arg);
        dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function min($col, ...$arg)
    {
        $sql = $this->mathSql("min", $col, ...$arg);
        dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function max($col, ...$arg)
    {
        $sql = $this->mathSql("max", $col, ...$arg);
        dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function avg($col, ...$arg)
    {
        $sql = $this->mathSql("avg", $col, ...$arg);
        dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col, ...$arg)
    {
        $sql = $this->mathSql("sum", $col, ...$arg);
        dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
}
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($location)
{
    header("location:" . $location);
}
function q($sql)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=db15";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
$db = new DB('bottom');
// $first=$db->find(1);
// $first['bottom']= "測試中";
// $update = $db->save($first);
// dd($update);
$math = $db->max("id");
dd($math);
