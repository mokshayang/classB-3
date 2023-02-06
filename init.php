<?php include_once "./api/base.php";
$sqlMovie = " delete from movie";
$sqlTrailer = " delete from trailer";
$pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=db15_3",'root','');
$pdo->exec($sqlMovie);
$pdo->exec($sqlTrailer);
for($i=1;$i<10;$i++){
    $data=[];
    $data['name']="預告片".$i;
    $data['img']="03A0".$i.".jpg";
    $data['sh']=1;
    $data['rank']=$i;
    $data['ani']=rand(1,3);
    $Trailer->save($data);
}

$date = ["2023-02-03","2023-02-04","2023-02-05","2023-02-06"];

for($i=1;$i<24;$i++){
    $data=[];
    $data['name']="院線片". $i;
    $data['level']=rand(1,4);
    $data['length']=rand(90,120);
    $data['ondate']=$date[rand(0,3)];
    $data['publish']="發行商".$i;
    $data['director']="我是導演".$i;
    $data['trailer']="03B".str_pad($i,2,0,STR_PAD_LEFT)."v.mp4";
    $data['poster']="03B".str_pad($i,2,0,STR_PAD_LEFT).".png";;
    $data['sh']=1;
    $data['rank']=$i;
    $data['intro']="院線片 $i 劇情介紹 $i";
    $Movie->save($data);
}
