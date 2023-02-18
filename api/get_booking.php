<?php include_once "base.php";
$ords = $Ord->all(['movie' => $_GET['movie'], 'date' => $_GET['date'], 'session' => $_GET['session']]);
$bookings = [];

foreach ($ords as $ord) {
    $seat = unserialize($ord['seats']);
    $bookings = array_merge($bookings, $seat);
}
?>
<style>
    .hall {
        width: 540px;
        height: 360px;
        margin: auto;
        background: url(icon/03D04.png);
        position: relative;
    }

    .pic {
        width: 316px;
        height: 340px;
        position: absolute;
        left: 112px;
        top: 20px;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        text-align: center;
        font-size: 12px;
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
<div class="hall">
    <div class="pic">
        <?php
        for ($i = 0; $i < 20; $i++) {
            if (in_array($i, $bookings)) {
                echo "<div class='booking'>";
            } else {
                echo "<div class='null'>";
            }
            echo "<div>";
            echo floor(($i / 5) + 1) . "排" . ($i % 5 + 1) . "號";
            echo "</div>";
            if (!in_array($i, $bookings)) echo "<input type=checkbox class=chk value='$i'>";
            echo "</div>";
        }
        ?>
    </div>
</div>
<div>您訂購的電影是 <span id="mov"></span></div>
<div>您訂購的日期是<span id="date"></span> 時間 :<span id="sess"></span></div>
<div>已勾選<span id="num"></span>張，最多4張喔</div>
<div class="ct">
    <button onclick="$('#ord,#booking').toggle()">上一步</button>
    <button onclick="checkout()">確定</button>
</div>
<script>
    let seats = [];
    $('.chk').on('change', function() {
        if ($(this).prop('checked')) {
            if (seats.length >= 4) {
                alert("最多只能選四張喔")
                $(this).prop('checked', false)
            } else {
                seats.push($(this).val())
            }
        } else {
            seats.splice(seats.indexOf($(this).val()),1);
        }
        console.log(seats);
        $('#num').text(seats.length);
    })
    function checkout(){
        $.post("api/order.php",{
            seats,
            movie: $('#movs option:selected').text(),
            date: $('#days').val(),
            session: $('#session').val()
        },(res)=>{
            // console.log(res);
            $('#booking').html(res);
        })
    }
</script>