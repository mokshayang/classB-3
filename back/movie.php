<button onclick="location.href='?do=add_movie'">新增院線片</button>
<hr>
<?php
$rows = $Movie->all(" order by rank ");
foreach ($rows as $key => $row) {
    $prev = ($key == 0) ? $row['id'] : $rows[$key - 1]['id'];
    $next = ($key == count($rows) - 1) ? $row['id'] : $rows[$key + 1]['id'];
?>
    <div style="display:flex;width:95%;margin:auto;margin:2px ;padding:2px">
        <div style="width:15%">
            <img src="./upload/<?= $row['poster'] ?>" style="width:80px">
        </div>
        <div  style="width:12%">
            分級:<img src="./icon/03C0<?= $row['level'] ?>.png" class="img-fluid rounded-top" alt="">
        </div>
        <div style="width:70%">
            <div style="display:flex;justify-content:space-between;">
                <div>片名 : <?=$row['name']?></div>
                <div>片長 : <?=$row['length']?></div>
                <div>上映時間 : <?=$row['ondate']?></div>
            </div>
            <div>
                <button onclick="showMovie(<?= $row['id']; ?>)"><?= ($row['sh'] == 1) ? "顯示" : "隱藏"; ?></button>
                <button onclick="sw('<?= $do ?>',<?= $row['id'] ?>,<?= $prev ?>)">往上</button>
                <button onclick="sw('<?= $do ?>',<?= $row['id'] ?>,<?= $next ?>)">往下</button>
                <button onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'">編輯電影</button>
                <button onclick="del('<?=$do?>',<?= $row['id']; ?>)">刪除電影</button>
            </div>
            <div>
                劇情介紹 : <?= $row['intro'] ?>
            </div>
        </div>
    </div>





<?php } ?>
<script>


   

   
</script>