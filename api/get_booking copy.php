<?php include_once "base.php";
$booking = [2, 4, 6, 19, 20];//先設定預訂座位
?>
<!-- 圖css -->
<style>
.block{
    width: 540px;
    height: 370px;
    background-image: url(./icon/03D04.png);
    margin: auto;
    position: relative;
}
.seats{
    position: absolute;
    left: 112px;
    top: 20px;
    width: 316px;
    height: 340px;
    display: grid;
    grid-template-columns: repeat(5,1fr);
    font-size: 12px;
    text-align: center;
}
.seats>div{
    width: 100%;
    height: 85px;
}
.booking,.null{
    background-position: center;
    background-repeat: no-repeat;
}
.booking{
    background-image: url(./icon/03D03.png);
}
.null{
    background-image: url(./icon/03D02.png);
    position: relative;
}
.chk{
    position: absolute;
    right: 0px;
    bottom: 0px;
}
</style>
<!-- 放圖 -->
<div class="block">
    <div class="seats">
    <?php
    for($i=0;$i<20;$i++){
        if(in_array($i,$booking)){
            echo "<div class='booking'>";
        }else{
            echo "<div class='null'>";
        }
                echo "<div>";
                echo (floor($i/5)+1)."排".($i%5+1)."號";
                echo "</div>";
                if(!in_array($i,$booking))
                echo "<input class='chk' type='checkbox' value='$i'>";
                
            echo "</div>";
    }
    ?>
    </div>
</div>



<!-- 文字敘述 -->
<div class="info">
    <div>你選擇的電影是 : <span id="mov"></span></div>
    <div>你選擇的日期是 :<span id="day"></span> 場次為 :<span id="sess"></span></div>
    <div>你已選擇 <span id="num"> </span>張，最多可以購買四張。</div>
    <div class="ct">
        <button onclick="$('#ord,#booking').toggle();">上一步</button>
        <button onclick="checkout()">確定</button>
    </div>
</div>
<script>
    let seats = [];
    $('.chk').on('change',function(){
        if($(this).prop('checked')){
            if(seats.length>=4){
                alert("最多只能購買四張票喔");
                $(this).prop('checked',false);
            }else{
                seats.push($(this).val())
            }
            console.log(seats);
        }else{     
            seats.splice(seats.indexOf($(this).val()),1);
            console.log(seats);
        }
        $('#num').text(seats.length);

    })
    function checkout(){
        $.post("./api/order.php",{
                    movs:$('#movs option:selected').text(),
                    day:$('#days option:selected').val(),
                    sess:$('#session option:selected').val(),

        },(res)=>{
            console.log(res);
        })
    }
</script>