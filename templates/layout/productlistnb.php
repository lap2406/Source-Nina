<?php
$loadMoreList = array(
    'first' => '10', // số item hiện ra ban đầu
    'load'  => '5', // số item load thêm ra mỗi lần click
    'table' => 'product',
    'type'  => 'san-pham',
    'thumb' => '230x250x2',
);
$loadMore_list = $d->rawQuery("SELECT id, ten$lang, mota$lang, tenkhongdauvi, tenkhongdauen FROM table_" . $loadMoreList['table'] . "_list WHERE type = '" . $loadMoreList['type'] . "' AND noibat>0 AND hienthi>0 ORDER BY stt ASC");
?>
<?php if (isset($listshowhome) && count($listshowhome) > 0) { ?>
    <section id="block-<?= $loadMoreList['type'] ?>" class="block-50">
        <div class="container">
            <?php foreach ($loadMore_list as $key_list => $value_list) {
                $LML_count_sql = $d->rawQueryOne("SELECT count(id) as soluong FROM table_" . $loadMoreList['table'] . " WHERE type='" . $loadMoreList['type'] . "' AND noibat>0 AND hienthi>0 AND id_list = '" . $value_list['id'] . "'");
                $LML_count = $LML_count_sql['soluong'] - $loadMoreList['first'];
            ?>
                <?php if (!empty($LML_count_sql)) { ?>
                    <div class="container-loadMoreList">
                        <div class="global-title">
                            <?= '<h3>' . $value_list['ten' . $lang] . '</h3>' ?>
                            <?= '<p>' . $slogan['ten' . $lang] . '</p>' ?>
                        </div>
                        <div class="loadMoreList-list loadMoreList-<?= $loadMoreList['type'] ?>-<?= $value_list['id'] ?> flexbox jcs" data-page="-1" data-first="<?= $loadMoreList['first'] ?>" data-load="<?= $loadMoreList['load'] ?>" data-idl="<?= $value_list['id'] ?>" data-table="<?= $loadMoreList['table'] ?>" data-type="<?= $loadMoreList['type'] ?>" data-thumb="<?= $loadMoreList['thumb'] ?>" data-com="<?= $value_list[$sluglang] ?>">
                        </div>
                        <div class="loadMoreList-plus btn-main">
                            <?= '<a href="javascript:void(0);" title="Xem tất cả sản phẩm" class="loadMoreList-btn">Xem thêm sản phẩm <span class="loadMoreList-count">(<b>' . $LML_count . '</b>)</span></a>' ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
<?php } ?>