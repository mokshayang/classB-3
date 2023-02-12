<h3 class="ct">線上訂票</h3>
<div class="ord">
    <table>
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
                <select id="sess"></select>
            </td>
        </tr>
    </table>
    <div class="ct">
        <button onclick="$('#ord,$booking').toggle();booking();">確認</button>
        <button onclick="">重置</button>
    </div>
</div>
<div id="booking">
    <div class="ct">
        <button onclick="$('#ord,$booking').toggle();">確定</button>
        <button>上一步</button>
    </div>
</div>