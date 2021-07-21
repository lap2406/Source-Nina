<div id="menu_head">
  <div class="container">
    <div class="menu-main">
      <div id="left" class="">
        <div class="khung_danhmuc">
          <div class="thanh clear">
            <p><img class="mr-3" src="./assets/images/bars.png" alt=""> Danh mục sản phẩm</p>
          </div>
          <div class="danhmuc" id="danhmuc">
            <ul>
              <?php if (count($splistmenu)) { ?>
                <?php for ($i = 0; $i < count($splistmenu); $i++) {
                  $spcatmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_cat where id_list = ? and hienthi > 0 order by stt,id desc", array($splistmenu[$i]['id'])); ?>
                  <li>
                    <a class="transition" title="<?= $splistmenu[$i]['ten' . $lang] ?>" href="<?= $splistmenu[$i][$sluglang] ?>">
                      <?= $splistmenu[$i]['ten' . $lang] ?>
                      <?php if (count($spcatmenu) > 0) { ?>
                        <i class="fas fa-chevron-right"></i>
                      <?php } ?>
                    </a>
                    <?php if (count($spcatmenu) > 0) { ?>
                      <ul>
                        <?php for ($j = 0; $j < count($spcatmenu); $j++) {
                          $spitemmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_item where id_cat = ? and hienthi > 0 order by stt,id desc", array($spcatmenu[$j]['id'])); ?>
                          <li>
                            <a class="transition" title="<?= $spcatmenu[$j]['ten' . $lang] ?>" href="<?= $spcatmenu[$j][$sluglang] ?>">
                              <?= $spcatmenu[$j]['ten' . $lang] ?>
                            </a>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>
        </div>

      </div>
      <nav class="menu">
        <div class="menu-main">
          <ul id="main-nav" class="main-nav align-items-center">
            <li><a class="transition <?php if ($com == '' || $com == 'index') echo 'active'; ?>" href="" title="<?= trangchu ?>">
                <i class="fas fa-home-lg"></i>
              </a>
            </li>
            <li><a class="transition <?php if ($com == 'gioi-thieu') echo 'active'; ?>" href="gioi-thieu" title="<?= gioithieu ?>">
                <?= gioithieu ?>
              </a>
            </li>
            <li>
              <a class="transition <?php if ($com == 'san-pham') echo 'active'; ?>" href="san-pham" title="Sản phẩm">
                Sản phẩm
              </a>

            </li>
            <li><a class="transition <?php if ($com == 'khuyenmai') echo 'active'; ?>" href="khuyenmai" title="Khuyến mãi">
                Khuyến mãi
              </a>
            </li>
            <li><a class="transition <?php if ($com == 'tin-tuc') echo 'active'; ?>" href="tin-tuc" title="Tin tức">
                Tin tức
              </a>
            </li>

            <li><a class="transition <?php if ($com == 'lien-he') echo 'active'; ?>" href="lien-he" title="<?= lienhe ?>">
                <?= lienhe ?>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

  </div>
</div>