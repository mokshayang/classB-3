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
        <button onclick="$('#ord,#booking').toggle(); booking();">確認</button>
        <button onclick="">重置</button>
    </div>
</div>

<div id="booking" style="display:none">

    <div class="ct">
        <button onclick="$('#ord,#booking').toggle();">上一步</button>
        <button onclick="checkout()">確定</button>
    </div>
</div>
<script>
    getMov();

    function booking() {
        let info = {
            'movie': $('#movs option:selected').text(),
            'date': $('#days').val(),
            'session': $('#session').val(),
        }
        $.get("api/get_booking.php", info, (res) => {
            $('#booking').html(res);
            $('#mov').text(info.movie);
            $('#day').text(info.date);
            $('#sess').text(info.session);
        })
    }

    function getMov() {
        let par = location.href.split("?")[1].split("&")
        let mov = $('#movs');
        // console.log(par);
        $.get("api/get_movie.php", (res) => {
            mov.html(res)
            console.log(par[1]);
            if ((par[1])) $(`option[value=${par[1].split("=")[1]}]`).prop('selected', true)
            getDay(mov.val());
            mov.on('change', () => getDay(mov.val()))
        })
    }
    function getDay(id){
        let day = $('#days')
        $.get("api/get_day.php",{id},(res)=>{
            day.html(res);
            getSess(id,day.val());
            day.on('change',()=>getSess(id,day.val()))
        })
    }
    function getSess(id,date){
        $.get("api/get_session.php",{id,date},(res)=>{
            $('#session').html(res)
        })
    }
    //另一個區塊 : booking
</script>