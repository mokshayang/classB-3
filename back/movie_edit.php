<h3 class="ct">編輯院線片</h3>
<?php
$row = $Movie->find($_GET['id']);
$date = explode("-",$row['date']);
?>
<style>
    .item{
        display: grid;
        grid-template-columns: 2fr 10fr;
        align-items: center;
    }

</style>
<form action="api/save.php" method="post" enctype="multipart/form-data">
    <div class="item">
        <div style="text-align:center">影片資料</div>
        <div>
            <table>
                <tr>
                    <td>片名 :</td>
                    <td>
                        <input type="text" name="name" value="<?=$row['name']?>">
                    </td>
                </tr>
                <tr>
                    <td>分級 :</td>
                    <td>
                        <select name="level" >
                            <option value="1" <?=($row['level']==1)?'selected':'';?>>普遍級</option>
                            <option value="2" <?=($row['level']==2)?'selected':'';?>>輔導級</option>
                            <option value="3" <?=($row['level']==3)?'selected':'';?>>保護級</option>
                            <option value="4" <?=($row['level']==4)?'selected':'';?>>限制級</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td >片長 :</td>
                    <td>
                        <input type="number" name="length" value="<?=$row['length']?>">
                    </td>
                </tr>
                <tr>
                    <td>上映日期 :</td>
                    <td>
                        <select name="year" >
                            <option value="2023" <?=($date[0]==2023)?'selected':'';?>>2023</option>
                            <option value="2024" <?=($date[0]==2024)?'selected':'';?>>2024</option>
                        </select>年
                        <select name="month" >
                            <?php
                                for($i=1;$i<13;$i++){
                                    $ss = ($date[1]==$i)?'selected':'';
                                    echo "<option value='$i' $ss>$i</option>";
                                }
                            ?>
                        </select>月
                        <select name="day" >
                        <?php
                                for($i=1;$i<32;$i++){
                                    $ss = ($date[2]==$i)?'selected':'';
                                    echo "<option value='$i' $ss >$i</option>";
                                }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商 :</td>
                    <td>
                        <input type="text" name="publish" value="<?=$row['publish']?>">
                    </td>
                </tr>
                <tr>
                    <td>導演 :</td>
                    <td>
                        <input type="text" name="director" value="<?=$row['director']?>">
                    </td>
                </tr>
                <tr>
                    <td>預告影片 :</td>
                    <td>
                        <input type="file" name="trailer" >
                    </td>
                </tr>
                <tr>
                    <td>電影海報 :</td>
                    <td>
                        <input type="file" name="poster" >
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="item">
        <div style="text-align:center">劇情簡介</div>
        <div>
            <textarea name="intro" style="width:95%;" rows="6"><?=$row['intro']?></textarea>
        </div>
    </div>
    <br>
    <div class="ct">
        <input type="hidden" name="id" value="<?=$row['id']?>">
        <input type="submit" value="編輯確定">
        <input type="reset" value="重置">
    </div>
</form>