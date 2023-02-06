<?php
date_default_timezone_set("Asia/Taipei");
session_start();
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function q($sql){
    global $pdo;
    $dsn="mysql:host=localhost;charset=utf8;dbname=db15_3";//個人用
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll();
}
function to($location){
    header("location:$location");
}

class DB
{
    protected $table;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db15_3";//個人用
    protected $pdo;
    public $level = [
                1=>'普遍級',
                2=>'輔導級',
                3=>'保護級',
                4=>'限制級',
    ];
    function __construct($table)
    {
        $this->pdo = new PDO($this->dsn,'root','');//個人用
        $this->table = $table;
    }
    private function arrayToSqlArray($array){
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }
    function mathSql($math,$col,...$arg){
        $sql = "select $math($col) from $this->table  ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->arrayToSqlArray($arg[0]);
                $sql .=" where" . join(" && ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $sql;
    }
    function all(...$arg){
        $sql = "select * from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->arrayToSqlArray($arg[0]);
                $sql .= " where " .join(" && ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        //dd($sql);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function find($id){
        $sql = "select * from $this->table where ";
        if(is_array($id)){
            $tmp = $this->arrayToSqlArray($id);
            $sql .= join(" && ",$tmp);
        }else{
            $sql .= " `id`=$id";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    function del($id){
        $sql = "delete from $this->table where ";
        if(is_array($id)){
            $tmp = $this->arrayToSqlArray($id);
            $sql .= join(" && ",$tmp);
        }else{
            $sql .= " `id`=$id";
        }
        return $this->pdo->exec($sql);
    }
    function save($array){
        if(isset($array['id'])){
            $id = $array['id'];
            unset($array['id']);
            $tmp = $this->arrayToSqlArray($array);
            $sql = "update $this->table set " ;
            $sql .=  join(",",$tmp);
            $sql .= " where `id`=$id" ;
        }else{
            $col = array_keys($array);
            $sql = "insert into $this->table (`" . join("`,`",$col)."`)
            values ('" . join("','",$array)."')";
        }
    //    dd($sql);
        return $this->pdo->exec($sql);
    }
    function count(...$arg){
        $sql = $this->mathSql("count","*",...$arg);
    //    dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col,...$arg){
         $sql = $this->mathSql("sum",$col,...$arg);
        //dd($sql);
        return $this->pdo->query($sql)->fetchColumn();       
    }
    function min($col,...$arg){
        $sql = $this->mathSql("min",$col,...$arg);
        //dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function max($col,...$arg){
        $sql = $this->mathSql("max",$col,...$arg);
        //dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function avg($col,...$arg){
        $sql = $this->mathSql("avg",$col,...$arg);
        //dd($sql);
        return $this->pdo->query($sql)->fetchColumn();
    }
   
}

function is_image($type){//$type 為字串格式
    switch($type){
        case "image/gif";
        case "image/jpeg";
        case "image/png";
            return true;//表示這三個結果都是一樣的
        break;
        default:
        return false;
    }
}

function dummy_icon($type){
    switch($type){
        case "text/plain":
            return "file-txt.png";
        break;
        case "application/mspowerpoint":
        case "application/vnd.openxmlformats-officedocument.presentationml.pre":
            return "file-ppt.png";
        break;
        case "application/msword":
            return "file-doc.png";
        break;
        case "application/postscript":
            return "file-ai.png";
        break;
        default:
            return "file-regular.png";
    }
}
$Trailer = new DB("trailer");//介紹片海報
$Movie = new Db("movie");
// $admin = new DB("admin_hw");
// $subject = new DB("survey_subject_hw");
// $options= new DB("survey_options_hw");
// $log = new DB("survey_log_hw");
