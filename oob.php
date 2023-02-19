<?php
include_once "api/base.php";
$a = [1, 6, 7, 9];
for ($i = 1; $i < 5; $i++) {
    $a[] = rand(0, 19);
}
$a = serialize($a);
// dd($a);

$b = [1, 6, 7, 9];
foreach ([6, 6, 2, 4] as $i) {
    $b[] = $i;
}
dd($b);
