<?php
include "ajax_config.php";

$page  = $_GET['page'];
$first = $_GET['first'];
$table = $_GET['table'];
$type  = $_GET['type'];
$thumb = $_GET['thumb'];

$idList = (isset($_GET['idl']) && $_GET['idl'] > 0) ? htmlspecialchars($_GET['idl']) : 0;
if ($idList) {
    $check_idl = 'and id_list = ' . $_GET['idl'];
} else {
    $check_idl = '';
}

if ($page == '-1') {
    $start = $page + 1;
    $load  = $first;
} else {
    $load  = $_GET['load'];
    $start = $first + ($page * $load);
}

$limit = 'LIMIT ' . $start . ',' . $load;

if ($table == 'product') {
    $select = ', gia, giasi';
} else {
    $select = ', ngaytao';
}

$ajax_sql = $d->rawQuery("SELECT ten$lang, mota$lang, tenkhongdauvi, tenkhongdauen, id, photo  $select  FROM table_$table WHERE type='" . $type . "' AND noibat>0 AND hienthi>0 $check_idl ORDER BY stt ASC $limit");

?>
<div class="row mlr-5">
    <?php foreach ($ajax_sql as $k => $v) {
        $func->showProduct($v, $options = array('class' => 'col-6 mb-3 plr-5'), $k);
    }
    ?>
</div>