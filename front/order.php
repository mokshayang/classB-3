<div class="ct">線上訂票</div>

<div id="ord">
    <table style="width:50%;text-align:center;margin:auto">
        <tr>
            <td>電影 :</td>
            <td>
                <select id="movs"></select>
            </td>
        </tr>
        <tr>
            <td>日期 :</td>
            <td>
                <select id="days"></select>
            </td>
        </tr>
        <tr>
            <td>場次 :</td>
            <td>
                <select id="session"></select>
            </td>
        </tr>
    </table>
    <br>
    <div class="ct">
        <button onclick="$('#ord,#booking').toggle(); getBooking();">確認</button>
        <button onclick="">重置</button>
    </div>
</div>

<div id="booking" style="display:none">
 
</div>
<script>
    getMov();

//另一個區塊 : booking
function getBooking(){
    $.get("./api/get_booking.php",(res)=>{

        $('#booking').html(res);
        $('#mov').text($('#movs option:selected').text());
        $('#day').text($('#days option:selected').val());
        $('#sess').text($('#session option:selected').val());
    })
}
    function getMov() {
        let params = location.href.split("?")[1].split("&");//[do=order , id=xxx]
        $.get("./api/get_movie.php", (res) => {
            $('#movs').html(res);
            if (params[1]) {//id=xxx
                $(`option[value=${params[1].split("=")[1]}]`).attr("selected", true);
            }
            //聯動式呼叫 :
            getDay($('#movs').val());//初始值
            $('#movs').on('change',()=>getDay($('#movs').val()))//onchange
        })
    }

    function getDay(id) {
        $.get("api/get_day.php", {id}, (res) => {
            $('#days').html(res)
            //聯動式呼叫 :
            getSess(id, $('#days').val());//初始值
            $('#days').on('change',()=>getSess(id,$('#days').val()));//onchange
        })
    }
    
    function getSess(id, date) {
        $.get("api/get_session.php", {id,date}, (res) => {
            $('#session').html(res);
        })
    }
</script>