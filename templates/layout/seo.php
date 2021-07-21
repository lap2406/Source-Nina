<ul class="h-card hidden">
    <li class="h-fn fn"><?=$setting['ten'.$lang]?></li>
    <li class="h-org org"><?=$setting['ten'.$lang]?></li>
    <li class="h-tel tel"><?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?></li>
    <li><a class="u-url ul" href="<?=$config_base?>"><?=$config_base?></a></li>
</ul>
<h1 class="hidden-seoh"><?=$seo->getSeo('h1')?></h1>
<div id="loadding-ajax" style="display: none;"> <img src="assets/member/loading.svg"> <div class="text">Đang tải...</div></div>
<!-- <div class="mask">
	<span></span>
	<span></span>
	<span></span>
</div>
<div id="loading">
	<div class="logo_2">
		<span></span>
		<img onerror="this.src='<?=THUMBS?>/105x75x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>';" src="<?=THUMBS?>/105x75x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>" class="mw100" alt="Home">
	</div>
</div> -->