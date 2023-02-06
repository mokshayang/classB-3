<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="abgne-block-20111227">
            <ul class="lists">
            </ul>
            <ul class="controls">
            </ul>
        </div>
    </div>
</div>
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
        grid-auto-rows: 20px 30px  20px 20px;
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
    .gg img{
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
        .ct a{
            text-decoration: none;
        }
    </style>
    <div class="ct">
        <?php
        for ($i = 1; $i <= $pages; $i++) {
            $size = ($i==$now)?"20px":'16px';
            echo "<a href='?p=$i' style='font-size:$size'>";
            echo "&nbsp; $i &nbsp;";
            echo "</a>";
        }
        ?>
    </div>
</div>
</div>