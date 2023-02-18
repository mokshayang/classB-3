<h2 class="ct">新增院線片</h2>
<style>
    .item{
        display: grid;
        grid-template-columns: 1fr 9fr;
        align-items: center;
    }
</style>
<form action="api/save.php" method="post" enctype="multipart/form-data">
    <div class="item">
        <div>影片資料</div>
        <div>
            <table>
                <tr>
                    <td>片名</td>
                    <td><input type="text" name="name" value=""></td>
                </tr>
                <tr>
                    <td>分級</td>
                    <td>
                        <select name="level" >
                            <option value="1">普遍級</option>
                            <option value="2">輔導級</option>
                            <option value="3">保護級</option>
                            <option value="4">限制級</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>片長</td>
                    <td><input type="number" name="length" value=""></td>
                </tr>
                <tr>
                    <td>上映日期</td>
                    <td>
                        <select name="year" id="">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>年
                        <select name="month" id="">
                            <?php
                                for($i=1;$i<=12;$i++){
                                    echo "<option value='$i'>$i</option>";
                                }
                            ?>
                        </select>月
                        <select name="day" id="">
                        <?php
                                for($i=1;$i<=31;$i++){
                                    echo "<option value='$i'>$i</option>";
                                }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商</td>
                    <td><input type="text" name="publish" value=""></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td><input type="text" name="director" value=""></td>
                </tr>
                <tr>
                    <td>預告影片</td>
                    <td><input type="file" name="trailer" ></td>
                </tr>
                <tr>
                    <td>電影海報</td>
                    <td><input type="file" name="poster" ></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="item">
        <div>劇情簡介</div>
        <div>
            <textarea name="infro" id="" cols="50" rows="6" style='width:90%;'></textarea>
        </div>
    </div>
    <br>
    <div class="ct" >
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>