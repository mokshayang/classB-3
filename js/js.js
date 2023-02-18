function sw(table, id1, id2) {
    $.post("api/sw.php", { table, id1, id2 }, () => {
        location.reload();
    })
}
function show(id) {
    $.post("api/show.php", { id }, () => {
        location.reload();
    })
}
function del(table, id) {
    let chk = confirm("你確定要刪除嗎 ");
    if (chk) {
        $.post("api/show.php", { table, id }, () => {
            location.reload();
        })
    }
}