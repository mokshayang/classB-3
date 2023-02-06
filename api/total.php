<?php include_once "base.php";
$do = $_GET['api'] ?? "total";
$file = "$do.php";
if (file_exists($file)) {
    include_once $file;
} else {
    echo "無此檔案 !!";
}
