<h3 class="ct">線上訂票</h3>
<style>
    table{
        width: 30%;
        text-align: center;
        margin: auto;
    }
</style>
<div id="ord">
    <table>
        <tr>
            <td>電影 :</td>
            <td>
                <select name="" id="movs"></select>
            </td>
        </tr>
        <tr>
            <td>日期 :</td>
            <td>
                <select name="" id="days"></select>
            </td>
        </tr>
        <tr>
            <td>場次 :</td>
            <td>
                <select name="" id="session"></select>
            </td>
        </tr>
    </table>
    <div class="ct">
        <button onclick="$('#ord,#booking').toggle(),booking()">確定</button>
        <button>重置</button>
    </div>
</div>
<div id="booking" style="display:none">
 
</div>
<script>
    getMov();

 

    function booking(){
        let into = {
                movie:$('#movs option:selected').text(),
                date:$('#days').val(),
                session:$('#session').val(),
        }
        $.get("api/booking.php",into,(res)=>{
            $('#booking').html(res);
            $('#mov').text(into.movie)
            $('#day').text(into.date)
            $('#sess').text(into.session)
        })
    }

    function getMov(){
        let mov = $('#movs');
        let par = location.href.split("?")[1].split("&");
        console.log(par[1].split("=")[1]);
        $.get("api/get_movie.php",(res)=>{
            mov.html(res);
            if(par[1]) $(`option[value=${par[1].split("=")[1]}]`).prop('selected',true);
            getDay(mov.val());
            mov.on('click',()=> getDay(mov.val()));
        })
    }
    function getDay(id){
        let day =$('#days');
        $.get("api/get_day.php",{id},(res)=>{
            day.html(res);
            getSess(id,day.val())
            day.on('change',()=>getSess(id,day.val()))
        })
    }
    function getSess(id,date){
        $.get("api/get_session.php",{id,date},(res)=>{
            $('#session').html(res);
        })
    }
</script>
