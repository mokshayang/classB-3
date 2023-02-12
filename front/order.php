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

</script>