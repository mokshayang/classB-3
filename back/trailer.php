<h3 class='ct'>預告片清單</h3>
<div style="width:100%;">
    <div style="display:flex;align-items:center;justify-content:center;text-align:center">
        <div style="width:25%;background-color:#eee;margin:0 1px">預告片海報</div>
        <div style="width:25%;background-color:#eee;margin:0 1px">預告片片名</div>
        <div style="width:25%;background-color:#eee;margin:0 1px">預告片排序</div>
        <div style="width:25%;background-color:#eee;margin:0 1px">操作</div>
    </div>
    <form action="api/edit_trailer.php" method="post">
        <!-- 下方的固定位置 :  -->
        <div style="height:210px;overflow:auto">
            <?php
            $ts = $Trailer->all(" order by rank asc");
            foreach ($ts as $k => $t) {
                $prev=($k==0)?$t['id']:$ts[$k-1]['id'];
                $next=($k==(count($ts)-1))?$t['id']:$ts[$k+1]['id'];
            ?>
                <div style="display:flex;align-items:center;justify-content:center;text-align:center">
                    <div style="width:25%;margin:0 1px;padding:2px;">
                        <img src="./upload/<?= $t['img'] ?>" alt="" style="width:100px">
                    </div>
                    <div style="width:25%;margin:0 1px">
                        <input type="text" name="name[]" value="<?= $t['name'] ?>">
                    </div>
                    <div style="width:25%;margin:0 1px">
                        <input type="button" onclick="sw('<?=$do?>',<?=$t['id']?>,<?=$prev?>)"  value="往上">
                        <input type="button" onclick="sw('<?=$do?>',<?=$t['id']?>,<?=$next?>)"  value="往下">
                    </div>
                    <div style="width:25%;margin:0 1px">
                        <input type="checkbox" name="sh[]" value="<?= $t['id'] ?>" <?= ($t['sh'] == 1) ? 'checked' : ''; ?>>顯示&nbsp;
                        <input type="checkbox" name="del[]" value="<?= $t['id'] ?>">刪除&nbsp;
                        <select name="ani[]" id="">
                            <option value="1" <?=($t['ani']==1)?'selected':'';?>>淡入淡出</option>
                            <option value="2" <?=($t['ani']==2)?'selected':'';?>>滑入滑出</option>
                            <option value="3" <?=($t['ani']==3)?'selected':'';?>>縮放</option>
                        </select>
                        <input type="hidden" name="id[]" value="<?=$t['id']?>">
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="ct">
            <input type="submit" value="編輯確定">
            <input type="reset" value="重置">
        </div>
    </form>
</div>

<hr>
<h3 class='ct'>新增預告片海報</h3>
<form action="api/add_trailer.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>預告片海報<input type="file" name="img" id=""></td>
            <td>預告片片名<input type="text" name="name" id=""></td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>
<script>
    function sw(table,id1,id2){
        $.post("./api/sw.php",{table,id1,id2},()=>{
            location.reload();
        })
    }
</script>