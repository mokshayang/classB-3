<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <style>
        #poster {
            width: 420px;
            height: 400px;
            position: relative;
        }
        .lis{
            width: 210px;
            height: 280px;
            margin: auto;
            position: relative;
            text-align: center;
            
        }
        .po{
            display:none;
            position: absolute;
        }
        .po img{
            width: 100%;
            height: 260px;
        }
    </style>
    <div class="rb tab" style="width:95%;">
        <div id="poster">
            <div class="lis">
                <?php
                $pos = $Tp->all(['sh' => 1], " order by rank");
                foreach ($pos as $po) {
                ?>
                    <div class="po" data-ani="<?=$po['ani']?>">
                        <img src="upload/<?= $po['img'] ?>" alt="">
                        <div><?= $po['name'] ?></div>
                    </div>
                <?php }    ?>
            </div>


            <style>
                .con {
                    width: 420px;
                    height: 110px;
                    position: absolute;
                    bottom: 0;
                    display: grid;
                    grid-template-columns: 1fr 8fr 1fr;
                    justify-items: center;
                    align-items: center;
                }

                .lef,
                .rig,
                .bt {
                    cursor: pointer;
                }

                .lef,
                .rig {
                    border-bottom: 20px solid transparent;
                    border-top: 20px solid transparent;
                }

                .lef {
                    border-right: 20px solid blue;
                }

                .rig {
                    border-left: 20px solid blue;
                }

                .bts {
                    width: 320px;
                    height: 100px;
                    display: grid;
                    grid-auto-flow: column;
                    grid-gap: 8px;
                    overflow: hidden;
                    text-align: center;
                    font-size: 12px;
                }

                .bt {
                    width: 72px;
                    position: relative;
                }

                .bt img {
                    width: 100%;
                    height: 80px;
                }
            </style>
            <div class="con">
                <div class="lef"></div>
                <div class="bts">
                    <?php
                    $pos = $Tp->all(['sh' => 1], " order by rank");
                    foreach ($pos as $po) {
                    ?>
                        <div class="bt">
                            <img src="upload/<?= $po['img'] ?>" alt="">
                            <div><?= $po['name'] ?></div>
                        </div>
                    <?php }    ?>
                </div>
                <div class="rig"></div>
            </div>
        </div>
    </div>
</div>

<script>

    let num = $('.bt').length,
        p = 0;
    $('.lef,.rig').on('click', function() {
        if ($(this).hasClass('lef')) {
            p = (p > 0) ? p - 1 : p
        } else {
            p = (p < num - 4) ? p + 1 : p
        }
        $('.bt').animate({
            right: 80 * p
        })
    })
    let po = $('.po');
    po.eq(0).show()
    let now = 0;

    let counter = setInterval(ani,2500);
    $('.bt').on('click',function(){
        let tt = $(this).index();
        ani(tt);
    })
    function ani(next){
        now = $('.po:visible').index();
        if(!next){
            next = (now+1 < po.length)?now+1:0;
        }
        let type = po.eq(next).data('ani');
        switch(type){
            case 1:
                po.eq(now).fadeOut(1000,()=>{
                    po.eq(next).fadeIn(1000)
                })
                break;
            case 2:
                po.eq(now).slideUp(1000,()=>{
                    po.eq(next).slideDown(1000)
                })
                break;
            case 3:
                po.eq(now).hide(1000,()=>{
                    po.eq(next).show(1000)
                })
                break;
        }
    }
    $('.bts').hover(
        function(){
            clearInterval(counter)
        },
        function(){
            counter = setInterval(ani,2500)
        },
    )
</script>


<style>
    .hall {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-auto-rows: 150px;
        grid-gap: 5px;
    }

    .item {
        display: grid;
        grid-template-columns: 2fr 3fr;
        border: 1px solid #ccc;
        border-radius: 5px;
        align-items: center;
        grid-gap: 3px;
    }

    .bb {
        grid-column: span 2;
        text-align: center;
    }
</style>

<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="hall">
            <?php
            $st = date("Y-m-d", strtotime("-2 day"));
            $day = date("Y-m-d");
            $tt = $Movie->count(['sh' => 1], " && ondate between '$st' and '$day' ");
            $div = 4;
            $p = ceil($tt / $div);
            $now = $_GET['p'] ?? 1;
            $start = ($now - 1) * $div;
            $rows = $Movie->all(['sh' => 1], " && ondate between '$st' and '$day' limit $start,$div ");
            foreach ($rows as $row) {
            ?>
                <div class="item">
                    <div class="pic">
                        <img src="upload/<?= $row['poster'] ?>" style="width:80px;cursor:pointer;" onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">
                    </div>
                    <div class="mid">
                        <div><?= $row['name'] ?></div>
                        <div>
                            <img src="icon/03C0<?= $row['level'] ?>.png">
                        </div>
                        <div>上映日期</div>
                        <div><?= $row['ondate'] ?></div>
                    </div>
                    <div class="bb">
                        <button onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">劇情介紹</button>
                        <button onclick="location.href='?do=order&id=<?= $row['id'] ?>'">線上訂票</button>
                    </div>
                </div>
            <?php } ?>
        </div>


        <style>
            .ct a {
                text-decoration: none;
                color: #ccc;
            }
        </style>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $p; $i++) {
                $si = ($now == $i) ? '24px' : '16px';
                echo "<a href='?p=$i' style='font-size:$si'>&nbsp; $i &nbsp;</a>";
            }
            ?>
        </div>
    </div>
</div>