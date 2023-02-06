<style>
    #poster {
        width: 420px;
        height: 400px;
        position: relative;
    }

    .pos {
        width: 200px;
        height: 280px;
        /* background-color: #fff; */
        margin-left: 105px;
        position: absolute;
        text-align: center;
    }

    .pos img {
        width: 100%;
        height: 260px;
    }

    .controls {
        width: 420px;
        height: 110px;
        /* background-color: lightblue; */
        margin: 10px auto 0;
        display: flex;
        align-items: center;
        /* justify-content: space-between; */
        justify-content: space-evenly;
        position: absolute;
        bottom: 0;
    }

    .left,
    .right {
        /* width: 40px;
        height: 40px; */
        /* background-color: red; */
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
    }

    .left {
        border-right: 20px solid blue;
        cursor: pointer;
    }

    .right {
        border-left: 20px solid blue;
        cursor: pointer;
    }

    /* start 箭頭 */

    .btns {
        width: 320px;
        height: 100px;
        /* background-color: green; */
        display: flex;
        overflow: hidden;
    }
    .btn{
        width: 80px;
        font-style: 12px;
        text-align: center;
        /* display: none; */
        flex-shrink: 0;
        box-sizing: border-box;
        padding:3px;
    }
    .btn img{
        width: 100%;
        height: 80px;
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="poster">

            <div class="lists">
                <?php
                $posters = $Trailer->all(['sh' => 1]);
                foreach ($posters as $poster) {
                ?>
                    <div class="pos">
                        <img src="./upload/<?= $poster['img'] ?>">
                        <div><?= $poster['name'] ?></div>
                    </div>
                <?php } ?>
            </div>


            <div class="controls">
                <div class="left"></div>
                <div class="btns">

                    <?php
                    $posters = $Trailer->all(['sh' => 1]);
                    foreach ($posters as $poster) {
                    ?>
                        
                            <div class="btn">
                                <img src="./upload/<?= $poster['img'] ?>">
                                <div><?= $poster['name'] ?></div>
                            </div>
                        
                    <?php } ?>

                </div>
                <div class="right"></div>
            </div>


        </div>
    </div>
</div>
<script>
    
</script>




















<style>
    .grid {
        display: grid;
        width: 100%;
        grid-template-columns: 1fr 1fr;
        border: 1px solid #fff;
        border-radius: 5px;
        justify-items: center;
        align-items: center;
    }

    .item {
        display: grid;
        grid-auto-rows: 20px 30px 20px 20px;
        justify-self: start;
    }

    .all {
        display: grid;
        height: 340px;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 160px 160px;
        grid-gap: 10px;

    }

    .bb {
        grid-column: span 2;
    }

    .gg img {
        border-radius: 3px;
        box-shadow: 0 0 2px #ccc;
        cursor: pointer;
    }
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="all">
            <?php
            $today = date("Y-m-d");
            $startDay = date("Y-m-d", strtotime("-2 days"));
            $tt = $Movie->count(['sh' => 1], " && ondate between '$startDay' and '$today' order by rank ");
            $div = 4;
            $pages = ceil($tt / $div);
            $now = $_GET['p'] ?? 1;
            $start = ($now - 1) * $div;
            $rows = $Movie->all(['sh' => 1], " && ondate between '$startDay' and '$today' order by rank limit $start,$div ");
            foreach ($rows as $row) {
            ?>
                <div class="grid">
                    <div class="gg">
                        <img src="./upload/<?= $row['poster'] ?>" width="80px" onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">
                    </div>
                    <div class="item">
                        <div><?= $row['name'] ?></div>
                        <div> <img src="./icon/03C0<?= $row['level'] ?>.png"> </div>
                        <div>上映日期 : </div>
                        <div><?= $row['ondate'] ?></div>
                    </div>
                    <div class="bb">
                        <button onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">劇情簡介</button>
                        <button onclick="location.href='?do=order&id=<?= $row['id'] ?>'">線上訂票</button>
                    </div>
                </div>

            <?php } ?>
        </div>
        <style>
            .ct a {
                text-decoration: none;
            }
        </style>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                $size = ($i == $now) ? "20px" : '16px';
                echo "<a href='?p=$i' style='font-size:$size'>";
                echo "&nbsp; $i &nbsp;";
                echo "</a>";
            }
            ?>
        </div>
    </div>
</div>