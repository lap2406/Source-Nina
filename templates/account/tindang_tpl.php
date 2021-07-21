<div class="wrapuser">
   <form class="form-user validation-user" novalidate method="post" action="account/tai-khoan" enctype="multipart/form-data">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-3">
            <?php include TEMPLATE.account."/left_member_tpl.php"; ?>
         </div>
         <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-right">
            <h3 class="title-info">BĐS của tôi (<?=count($product)?>)</h3>
            <div class="clearfix"></div>
            <?php foreach ($product as $k => $v) {
            ?>
            <div class="item-bds clearfix" id="itembds-<?=$v['id']?>">
               <div class="row">
                  <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                     <div class="img-bds">
                        <img src="<?=THUMBS?>/300x250x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                        <?php if($v['duyettin']!=1){ ?>
                           <div class="tt-bds-c"> <i class="far fa-clock"></i> Tin chờ duyệt</div>
                        <?php }else{ ?>
                           <div class="tt-bds-d"><i class="far fa-clock"></i> Tin đã duyệt</div>
                        <?php } ?>
                        
                     </div>
                     <?php if($v['masp']){ ?>
                     <div class="matin-bds">Mã Tin: <?=$v['masp']?></div>
                  <?php } ?>
                  </div>
                  <div class="col-12 col-sm-6 col-md-6 col-lg-8">
                     <div class="name-dt-bds">
                        <a href="javascript:void(0)"><?=$v['ten'.$lang]?></a>
                     </div>
                     <div class="description-bds">
                        <?=$func->cutString($v['mota'.$lang],150)?>
                     </div>
                     <div class="price-bds-dt"><span>Giá: </span><?=$func->format_money($v['gia'])?></div>
                     <div class="tool-bds">
                        <?php if($v['masp']){ ?>
                        <a href="account/sua-tin/<?=$v['masp']?>"><i class="fas fa-edit"></i></a>
                     <?php } ?>
                        <a href="javascript:void(0)" onclick="DeleteTin('<?=$v['id']?>')"><i class="fas fa-trash-alt"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>
         <div class="clearfix"></div>
         <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
         </div>
      </div>
   </form>
</div>