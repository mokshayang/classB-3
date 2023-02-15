<?php include_once "base.php";

$ords = $Ord->all([
                'movie'=>$_GET['movie'],
                'date'=>$_GET['date'],
                'session'=>$_GET['session'],
]);
$booking = [];
foreach($ords as $ord){
    $seat = unserialize($ord['seats']);
    $booking = array_merge($booking,$seat);
}
?>
<style>
.box{
    width: 540px;
    height: 370px;
    background: url(icon/03D04.png);
    position: relative;
    margin: auto;
}
.pic{
    width: 316px;
    height: 340px;
    position: absolute;
    top: 20px;
    right: 112px;
    display: grid;
    grid-template-columns: repeat(5,1fr);
    text-align: center;
    font-size: 12px;
    background: #00000060;
}
.booking{
    background: url(icon/03D03.png);
}
.null{
    background: url(icon/03D02.png);
    position: relative;
}
.booking,.null{
    background-position: center;
    background-repeat: no-repeat;
}
.chk{
    position: absolute;
    bottom: 0;
    right: 0;
}
</style>
<div class="box">
    <div class="pic">
        <?php
        for($i=0;$i<20;$i++){
            if(in_array($i,$booking)){
            echo "<div class='booking'>";
            }else{
            echo "<div class='null'>";
            }
                echo "<div>";
                echo floor(($i/5)+1)."排".($i%5+1)."號";
                echo "</div>";
            if(!in_array($i,$booking)) echo "<input type='checkbox' class='chk' value='$i'>";
            echo "</div>";
        }
        ?>
    </div>
</div>
<!-- 放置DOM -->
<div>你選擇的電影 : <span id="mov"></span></div>
<div>你選擇的日期 : <span id="day"></span> 時間 : <span id="sess"></span></div>
<div>已勾選 : <span id="num"></span>張，最多四張</div>
<div class="ct">
        <button onclick="$('#ord,#booking').toggle();">上一步</button>
        <button onclick="checkout()">確定</button>
    </div>
<script>
    let seats = [];
    $('.chk').on('change',function(){
        if($(this).prop('checked')){
           if(seats.length>=4){
            alert("最多四張喔 !")
            $(this).prop('checked',false)
           }else{
            seats.push($(this).val());
           }
        }else{
            seats.splice(seats.indexOf($(this).val()))
        }
        console.log(seats);
        $('#num').text(seats.length)
    })
</script>