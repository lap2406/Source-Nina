<?php
include "ajax_config.php";

/* Paginations */
include LIBRARIES . "class/class.PaginationsAjax.php";
$pagingAjax = new PaginationsAjax();
$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
$eShow = htmlspecialchars($_GET['eShow']);
$idList = (isset($_GET['idList']) && $_GET['idList'] > 0) ? htmlspecialchars($_GET['idList']) : 0;
$dataType = (isset($_GET['data-type']) ) ? htmlspecialchars($_GET['data-type']) : 1;
$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
$start = ($p - 1) * $pagingAjax->perpage;
$pageLink = "ajax/ajax_product.php?perpage=" . $pagingAjax->perpage;
$tempLink = "";
$where = "";

/* Math url */
if ($dataType) {
	$tempLink .= "&data=" . $dataType;
	$where .= " and $dataType > 0" ;
}
$tempLink .= "&p=";
$pageLink .= $tempLink;

/* Get data */
$sql = "select ten$lang, tenkhongdauvi, mota$lang, tenkhongdauen, id, photo, gia, giasi, type from #_product where type='san-pham' $where and noibat > 0 and hienthi > 0 order by stt,id desc";
$sqlCache = $sql . " limit $start, $pagingAjax->perpage";
$items = $cache->getCache($sqlCache, 'result', 0);
/* Count all data */
$countItems = count($cache->getCache($sql, 'result', 0));
/* Get page result */
$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);
?>
<?php if ($countItems) { ?>
	<div class="row mlr-10">
		<?php
		foreach ($items as $k => $v) { 
			$func->showProduct($v,$options =array('class'=>'col-xl-3 col-md-6 col-sm-6 col-6 mb-3 '),$k);
		} ?>
	</div>
	<div class="pagination-ajax">
		<a href="<?=$dataType?>">Xem tất cả >></a>
	</div>
<?php } ?>