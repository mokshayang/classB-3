<style>
    #poster {
        width: 420px;
        height: 400px;
        position: relative;
    }

    .lists {
        width: 210px;
        height: 280px;
        position: relative;
        margin: auto;
        overflow: hidden;
    }

    .pos {
        width: 210px;
        height: 280px;
        /* background-color: #fff; */
        /* margin-left: 105px; */
        position: absolute;
        text-align: center;
        display: none;
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

    .btn {
        width: 80px;
        font-style: 12px;
        text-align: center;
        /* display: none; */
        flex-shrink: 0;
        box-sizing: border-box;
        padding: 3px;
        position: relative;
    }

    .btn img {
        width: 100%;
        height: 80px;
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="poster">
<!-- 大魔王 -->
            <div class="lists">
                <?php
                $posters = $Tp->all(['sh' => 1]);
                foreach ($posters as $poster) {
                ?>
                    <div class="pos" data-ani = "<?=$poster['ani']?>" >
                        <img src="./upload/<?= $poster['img'] ?>">
                        <div><?= $poster['name'] ?></div>
                    </div>
                <?php } ?>
            </div>


<!-- 小小魔王 -->
            <div class="controls">

                <div class="left"></div>

                <div class="btns">
                    <?php
                    $posters = $Tp->all(['sh' => 1], " order by rank ");
                    foreach ($posters as $key => $poster) {
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
    $('.pos').eq(0).show();
    //目前只會動一次
    let btns = $('.btn').length; //全部的張數
    let p = 0; //要持續動，一刺秀四張，全部有N張

    // //往右按一下
    // $(".right").on('click',function(){
    //     if((p+1) <= btns-4) p++;
    //     $(".btn").css({right:80*p});
    // })
    // //往左按一下
    // $(".left").on('click',function(){
    //     if((p-1) >= 0 ) p--;
    //     $(".btn").css({right:80*p});
    // })

    //合併
    $(".left,.right").on('click', function() {

        if ($(this).hasClass('left')) {
            p = (p - 1 >= 0) ? p - 1 : p;
        } else {
            p = (p + 1 <= btns - 4) ? p + 1 : p;
        }

        $(".btn").animate({
            right: 80 * p
        }, () => {
            //call back function 
            // console.log("YA~");
        });

    })






    
    
    //大魔王  上放的預告片
    let now = 0;

    let counter = setInterval(() => { //間隔
        ani()//兩張 與下方 click 也有ani在跑，所以當點擊時會出現下方
    }, 3000);

    //下方點選的index 
$('.btn').on("click",function(){
    let _this = $(this).index();
    // console.log('now=>',now+1,'_this=>',_this);
    // console.log("下一張是"+$(".pos"));
    ani(_this);//帶入下一張
})

    function ani(next) {
        //如何知道哪一張 正在進行 visible
        now = $('.pos:visible').index();

        //next 不存在
        if(typeof(next)=='undefined'){
            //設置邊界
            next = (now+1 < $('.pos').length )?now+1:0;
        }


        //抓取動畫方式 : PHP 撈資料
        let Anitype = $('.pos').eq(next).data('ani');
        // console.log('now=>'+now+',next=>'+next+',ani=>'+Anitype);

        switch (Anitype) { //下張的進場 用的是 此張的動畫效果
            case 1://淡入淡出
                // $('.pos').eq(now).fadeOut(1000, () => {
                //     $('.pos').eq(next).fadeIn(1000);
                // });

                $('.pos').eq(now).fadeOut(2500);
                $('.pos').eq(next).fadeIn(2500);
                break;

            case 2://滑入滑出
                //下方可以不用加
                $(".pos").eq(next).css({left:210,top:0,width:210,height:280});
                $('.pos').eq(next).show();

                $('.pos').eq(now).animate({left:-210,top:0,width:210,height:280},1500, () => {
                    $('.pos').eq(now).hide();
                    $('.pos').eq(now).css({left:0,top:0,width:210,height:280});
                });

                $('.pos').eq(next).animate({left:0,top:0,width:210,height:280},1500);

                // $('.pos').eq(now).slideUp(1000, () => {
                //     $('.pos').eq(next).slideDown(1000);
                // });
                break;

            case 3://縮放
                $(".pos").eq(next).css({left:105,top:140,width:0,height:0});
                $('.pos').eq(now).animate({left:105,top:140,width:0,height:0},1000, () => {
                    $('.pos').eq(now).hide();
                    $('.pos').eq(now).css({left:0,top:0,width:210,height:280});

                    $('.pos').eq(next).show();
                    $('.pos').eq(next).animate({left:0,top:0,width:210,height:280},1000)
                });

                // $('.pos').eq(now).hide(1000, () => {
                //     $('.pos').eq(next).show(1000);
                // });
                break;
        }
    }

    $('.btns').hover(
        function(){
            clearInterval(counter);
        },
        function(){
            counter = setInterval(()=>{
                ani();
            },3000)
        }
    )
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