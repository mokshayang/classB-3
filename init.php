<?php include_once "./api/base.php";
$Movie->ddd();
$Ord->ddd();
$Tp->ddd();
for ($i = 1; $i < 10; $i++) {
    $data = [];
    $data['name'] = "預告片" . $i;
    $data['img'] = "03A0" . $i . ".jpg";
    $data['sh'] = 1;
    $data['rank'] = $i;
    $data['ani'] = rand(1, 3);
    $Trailer->save($data);
    $Tp->save($data);
}
$date = [date("Y-m-d",strtotime("-2 day")), date("Y-m-d",strtotime("-1 day")), date("Y-m-d"), date("Y-m-d",strtotime("+1 day")),date("Y-m-d",strtotime("+2 day"))];
for ($i = 1; $i < 26; $i++) {
    $data = [];
    $data['name'] = "院線片" . $i;
    $data['level'] = rand(1, 4);
    $data['length'] = rand(90, 120);
    $data['date'] = $date[rand(0, 4)];
    $data['publish'] = "發行商" . $i;
    $data['director'] = "我是導演" . $i;
    $data['trailer'] = "03B" . str_pad($i, 2, 0, STR_PAD_LEFT) . "v.mp4";
    $data['poster'] = "03B" . str_pad($i, 2, 0, STR_PAD_LEFT) . ".png";;
    $data['sh'] = 1;
    $data['rank'] = $i;
    $data['intro'] = "院線片 $i 劇情介紹 $i";
    $Movie->save($data);
}
$date = [date("Y-m-d",strtotime("-2 day")), date("Y-m-d",strtotime("-1 day")), date("Y-m-d"), date("Y-m-d",strtotime("+1 day")),date("Y-m-d",strtotime("+2 day"))];
for ($i = 1; $i < 61; $i++) {
    $data = [];
    $data['no'] = date("Ymd") . sprintf("%04d",$i);
    $data['name'] = "院線片" . rand(1,25);
    $data['date'] = $date[rand(0, 4)];
    $data['session'] = $Ord->ot[rand(1, 5)];
    $data['qt'] = rand(1, 4);
    for ($j = 0; $j < $data['qt']; $j++) {//最多4張票數
        $data['seats'][] = rand(0, 19);//20個位置隨機
    }
    $data['seats'] = serialize($data['seats']);
    $Ord->save($data);
}
to("./index.php");
