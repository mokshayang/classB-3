<?php include_once "base.php";
dd($_POST);
foreach ($_POST['id'] as $k => $id) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $Tp->del($id);
    } else {
        $row = $Tp->find($id);
        $row['name'] = $_POST['name'][$k];
        $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
        $row['ani'] = $_POST['ani'][$k];
        $Tp->save($row);
    }
}
to("../back.php?do=tp");
