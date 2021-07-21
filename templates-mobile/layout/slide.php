<div class="slider-banner">
  <?php if (count($slider)) { ?>
    <div class="slider" style="">
      <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1366px; height: 514px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
          <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
          <div style="position:absolute;display:block;background:url('./assets/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1366px; height: 514px; overflow: hidden;">
          <?php
          foreach ($slider as $k => $v) {
          ?>
            <div data-p="112.50" style="display: none;">
              <a  href="<?= $v['link'] ?>" target="_blank" title="<?= $v['ten' . $lang] ?>"> <img data-u="image" src="<?= THUMBS ?>/1366x514x1/<?= UPLOAD_PHOTO_L . $v['photo'] ?>" /></a>
            </div>
            
          <?php } ?>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
          <!-- bullet navigator item prototype -->
          <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
      </div>
    </div>
    
  <?php } ?>
</div>