function sw(table, id1, id2) {
    $.get("api/sw.php", { table, id1, id2 }, () => {
        location.reload();
    })
}
function del(table, id) {
    let chk = confirm("確定要刪除嗎")
    if (chk) {
        $.get("api/del.php", { table, id }, () => {
            location.reload();
        })
    }
}
function show(id) {
    $.get("api/show.php", { id }, () => {
        location.reload();
    })
}