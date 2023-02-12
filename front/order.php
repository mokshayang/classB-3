<h3 class="ct">線上訂票</h3>

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
        <button onclick="$('#ord,#booking').toggle(); ">確認</button>
        <button onclick="">重置</button>
    </div>
</div>

<div id="booking" style="display:none">
    <div>你選擇的電影是 : <span id="mov"></span></div>
    <div>你選擇的日期是 :<span id="day"></span>場次為 : <span class="sess"></span></div>
    <div>你已選擇 <span id="tickets"> </span>張，最多可以購買四張。</div>
    <div class="ct">
        <button onclick="$('#ord,#booking').toggle();">上一步</button>
        <button onclick="checkout()">確定</button>
    </div>
</div>
<script>
    getMov();

//聯動是呼叫 : 
$('#movs').on('change',()=>{
    getDay($('#movs').val());
})
$('#days').on('change',()=>{
    getSess($('#movs').val(),$('#days').val());
})

    function getMov() {
        let params = location.href.split("?")[1].split("&");
        $.get("./api/get_movie.php", (res) => {
            $('#movs').html(res);
            if (params[1]) {
                $(`option[value=${params[1].split("=")[1]}]`).attr("selected", true);
            }
            getDay($('#movs').val());//連動式參數帶入
        })
    }
    function getDay(id){
        $.get("api/get_day.php",{id},(res)=>{
            $('#days').html(res)
        })
    }
    function getSess(id,date){
        $.get("api/get_session.php",{id,date},(res)=>{
            $('#session').html(res);
        })
    }
</script>