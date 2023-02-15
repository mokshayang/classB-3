<?php include_once "base.php";
$ords = $Ord->all(['movie'=>$_GET['movie'],'date'=>$_GET['date'],'session'=>$_GET['session']]);
$booking=[];
foreach($ords as $ord){
    $seats = unserialize($ord['seats']);
    $booking = array_merge($booking,$seats);
}
?>
<style>
    .box {
        width: 540px;
        height: 370px;
        position: relative;
        background: url(icon/03D04.png);
        margin: auto;
    }

    .seats {
        width: 316px;
        height: 340px;
        position: absolute;
        top: 20px;
        left: 112px;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        font-size: 12px;
        text-align: center;
    }

    .seats>div {
        width: 100%;
        height: 85px;
    }

    .booking {
        background: url(icon/03D03.png);
    }

    .null {
        background: url(icon/03D02.png);
        position: relative;
    }

    .booking,
    .null {
        background-position: center;
        background-repeat: no-repeat;
    }

    .chk {
        position: absolute;
        bottom: 0;
        right: 0;
    }
</style>
<div class="box">
    <div class="seats">
        <?php
        for ($i = 0; $i < 20; $i++) {
            if (in_array($i, $booking)) {
                echo "<div class='booking'>";
            } else {
                echo "<div class='null'>";
            }
            echo "<div>";
            echo floor(($i / 5) + 1) . "排" . ($i % 5 + 1) . "號";
            echo "</div>";
            if (!in_array($i, $booking)) echo "<input type='checkbox' class='chk' value='$i'>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<div class="into">
    <div>你選擇的電影<span id="mov"></span></div>
    <div>你選擇的時間<span id="day"></span><span id="sess"></span></div>
    <div>已勾選<span id="num"></span>張票，最多四張</div>
    <div class="ct">
        <button onclick="$('#ord,#booking').toggle()">上一步</button>
        <button onclick="checkout()">確定</button>
    </div>
</div>
<script>
    let seats = [];
    $('.chk').on('change',function(){
        if($(this).prop('checked')){
            if(seats.length<4){
                seats.push($(this).val());
            }else{
                alert("最多四張喔");
                $(this).prop('checked',false);
            }
        }else{
            seats.splice(seats.indexOf($(this).val()),1);
        }
        $('#num').text(seats.length);
    })
    function checkout(){
        $.post("api/order.php",{seats,
                            movie : $('#movs option:selected').text(),
                            date : $('#days').val(),
                            session : $('#session').val(),
        },(res)=>{
            $('#booking').html(res);
        })
    }
</script>