<h3 class="ct">線上訂票</h3>
<style>
    #ord table{
        width: 30%;
        margin: auto;
    }
</style>
<div id="ord">
    <table>
        <tr>
            <td>電影 : </td>
            <td><select name="" id="movs"></select></td>
        </tr>
        <tr>
            <td>日期 :</td>
            <td><select name="" id="days"></select></td>
        </tr>
        <tr>
            <td>場次</td>
            <td><select name="" id="session"></select></td>
        </tr>
    </table>
    <div class="ct">
        <button onclick="$('#ord,#booking').toggle()">確定</button>
        <button>重置</button>
    </div>

</div>
<div id="booking" style="display:none">
    <div>您選擇的電影 : <span id="mov"></span></div>
    <div>您選擇的日期 : <span id="day"></span> ，場次是 <span id="sess"></span></div>
    <div>已勾選<span id="num"></span>張，最多四張</div>
    <div class="ct">
        <button onclick="$('#ord,#booking').toggle()">上一步</button>
        <button>確定</button>
    </div>
</div>
<script>
getMovs();
    function getMovs(){
        let movs = $('#movs');
        let par = location.href.split("?")[1].split("&");
        $.get("api/get_movie.php",(res)=>{
            movs.html(res);
            if(par[1]) $(`#movs option[value=${par[1].split("=")[1]}]`).prop('selected',true);
            getDays(movs.val());
            movs.on('click',()=> getDays(movs.val()))
        })
    }
    function getDays(id){
        let days = $('#days');

        $.get("api/get_days.php",{id},(res)=>{
            days.html(res)
            getSess(id,days.val());
            days.on('click',()=> getSess(id,days.val()))
        })
    }
    function getSess(id,date){
        $.get("api/get_session.php",{id,date},(res)=>{
            $('#session').html(res);
        })
    }
</script>