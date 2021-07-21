<div class="wrap-cart">
    <div class="container">
        <div class="">
            <form class="form-cart validation-cart" novalidate method="post" action="" enctype="multipart/form-data">
                <div class="cart-container justify-content-between ">
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart'])) { ?>
                        
                        <div class="bottom-cart">
                            <div class="section-cart">
                                <p class="title-cart"><?= hinhthucthanhtoan ?>:</p>
                                <div class="information-cart">
                                    <?php foreach ($httt as $key => $value) { ?>
                                        <div class="payments-cart custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payments-<?= $value['id'] ?>" name="payments" value="<?= $value['id'] ?>" required>
                                            <label class="payments-label custom-control-label" for="payments-<?= $value['id'] ?>" data-payments="<?= $value['id'] ?>"><?= $value['ten' . $lang] ?></label>
                                            <div class="payments-info payments-info-<?= $value['id'] ?> transition"><?= str_replace("\n", "<br>", $value['mota' . $lang]) ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <p class="title-cart"><?= thongtingiaohang ?>:</p>
                                <div class="information-cart">
                                    <div class="input-double-cart w-clear">
                                        <div class="input-cart">
                                            <input type="text" class="form-control" id="ten" name="ten" placeholder="<?= hoten ?>" required />
                                            <div class="invalid-feedback"><?= vuilongnhaphoten ?></div>
                                        </div>
                                        <div class="input-cart">
                                            <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?= sodienthoai ?>" required />
                                            <div class="invalid-feedback"><?= vuilongnhapsodienthoai ?></div>
                                        </div>
                                    </div>
                                    <div class="input-cart">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                                        <div class="invalid-feedback"><?= vuilongnhapdiachiemail ?></div>
                                    </div>
                                    <div class="input-triple-cart w-clear">
                                        <div class="input-cart">
                                            <select class="select-city-cart custom-select" required id="city" name="city">
                                                <option value=""><?= tinhthanh ?></option>
                                                <?php for ($i = 0; $i < count($city); $i++) { ?>
                                                    <option value="<?= $city[$i]['id'] ?>"><?= $city[$i]['ten'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback"><?= vuilongchontinhthanh ?></div>
                                        </div>
                                        <div class="input-cart">
                                            <select class="select-district-cart select-district custom-select" required id="district" name="district">
                                                <option value=""><?= quanhuyen ?></option>
                                            </select>
                                            <div class="invalid-feedback"><?= vuilongchonquanhuyen ?></div>
                                        </div>
                                        <div class="input-cart">
                                            <select class="select-wards-cart select-wards custom-select" required id="wards" name="wards">
                                                <option value=""><?= phuongxa ?></option>
                                            </select>
                                            <div class="invalid-feedback"><?= vuilongchonphuongxa ?></div>
                                        </div>
                                    </div>
                                    <div class="input-cart">
                                        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?= diachi ?>" required />
                                        <div class="invalid-feedback"><?= vuilongnhapdiachi ?></div>
                                    </div>
                                    <div class="input-cart">
                                        <textarea class="form-control" id="yeucaukhac" name="yeucaukhac" placeholder="<?= yeucaukhac ?>" /></textarea>
                                    </div>
                                </div>
                                <input type="submit" class="btn-cart btn btn-primary btn-lg btn-block" name="thanhtoan" value="<?= thanhtoan ?>" disabled>
                            </div>
                        </div>
                    <?php } else { ?>
                        <a href="" class="empty-cart text-decoration-none">
                            <i class="fa fa-cart-arrow-down"></i>
                            <p><?= khongtontaisanphamtronggiohang ?></p>
                            <span><?= vetrangchu ?></span>
                        </a>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>