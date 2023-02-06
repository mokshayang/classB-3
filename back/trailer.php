<style>
    .head {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
       
       
    }
    .tit {
        width: 25%;
        background-color: #eee;
        margin: 0 1px;
    }
</style>
<h3 class="ct">預告片清單</h3>
<div style='width:100%'>
    <div class="head">
        <div class="tit">預告片海報</div>
        <div class="tit">預告片片名</div>
        <div class="tit">預告片排序</div>
        <div class="tit">操作</div>
    </div>
    <form action="./api/total.php?api=edit_trailer" method="post">
        <div style="height: 210px ; overflow:auto;"><!--固定屬性-->
            <?php
            $ts = $Trailer->all(" order by rank desc");
            foreach ($ts as $k => $t) {
                $show = ($t['sh'] == 1) ? "checked" : '';
                $prev = ($k == 0) ? $t['id'] : $ts[$k - 1]['id']; //如果是第一筆，跟自己換，否則往上
                $next = ($k == (count($ts) - 1)) ? $t['id'] : $ts[$k + 1]['id']; //如果是最後一筆。跟自己換 否則往下
            ?>
                <div class="head">
                    <div class="tit">
                        <img src="./upload/<?= $t['img'] ?>" style="width:100px;">
                    </div>
                    <div class="tit">
                        <input type="text" name="name[]" value="<?= $t['name'] ?>">
                    </div>
                    <div class="tit">
                        <input type="button" value="往上" onclick="sw('<?= $do ?>',<?= $t['id'] ?>,<?= $prev ?>)">
                        <input type="button" value="往下" onclick="sw('<?= $do ?>',<?= $t['id'] ?>,<?= $next ?>)">
                    </div>
                    <div class="tit">
                        <input type="checkbox" name="sh[]" value="<?= $t['id'] ?>" <?= $show ?>>顯示&nbsp;
                        <input type="checkbox" name="del[]" value="<?= $t['id'] ?>">刪除&nbsp;
                        <select name="ani[]">
                            <option value="1" <?= ($t['ani'] == 1) ? 'selected' : ''; ?>>淡入淡出</option>
                            <option value="2" <?= ($t['ani'] == 2) ? 'selected' : ''; ?>>滑入滑出</option>
                            <option value="3" <?= ($t['ani'] == 3) ? 'selected' : ''; ?>>縮放</option>
                        </select>
                        <input type="hidden" name="id[]" value="<?= $t['id'] ?>">
                    </div>
                </div>
            <?php  } ?>
        </div>
        <div class="ct">
            <input type="submit" value="編輯確定">
            <input type="reset" value="重置">
        </div>
    </form>
</div>
<hr>
<form action="api/total.php?api=add_trailer" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>預告片海報: <input type="file" name="img" id=""></td>
            <td>預告片片名: <input type="text" name="name" id=""></td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>

<script>
    function sw(table, id1, id2) {
        $.post("./api/sw.php", {
            table,
            id1,
            id2
        }, () => {
            location.reload();
        })
    }
</script>
