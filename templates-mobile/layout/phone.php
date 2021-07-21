<div class="toolbar">
    <ul>
        <li>
            <a id="goidien" href="tel:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline']); ?>" title="title">
                <img src="assets/images/icon-t1.png" alt="images"><br>
                <span>Gọi điện</span>
            </a>
        </li>
        <li>
            <a class="mes not-loading" target="_blank" href="<?= $optsetting['toado'] ?>">
                <img src="assets/images/icon-t5.png" alt="images"><br>
                <span>Chỉ đường</span>
            </a>
        </li>
        <li>
            <a id="nhantin" href="sms:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline']); ?>" title="title">
                <img src="assets/images/icon-t2.png" alt="images"><br>
                <span>Nhắn tin</span>
            </a>
        </li>
        <li>
            <a id="chatzalo" href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>" title="title">
                <img src="assets/images/icon-t3.png" alt="images"><br>
                <span>Chat zalo</span>
            </a>
        </li>

        <li>
            <a id="chatfb" href="<?= $optsetting['fanpage'] ?>" title="title">
                <img src="assets/images/icon-t4.png" alt="images"><br>
                <span>Chat facebook</span>
            </a>
        </li>

    </ul>
</div>


<script type="text/javascript" src="assets/js/jQuery.WCircleMenu-min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        /* Phone circle */
        $('#my-phone-circle').WCircleMenu({
            angle_start: -Math.PI,
            delay: 50,
            distance: 70,
            angle_interval: Math.PI / 4,
            easingFuncShow: "easeOutBack",
            easingFuncHide: "easeInBack",
            step: 5,
            openCallback: false,
            closeCallback: false,
        });

        /* Phone support */
        $('.support-content').hide();
        $('a.btn-support').click(function(e) {
            e.stopPropagation();
            $('.support-content').slideToggle();
        });
        $('.support-content').click(function(e) {
            e.stopPropagation();
        });
        $(document).click(function() {
            $('.support-content').slideUp();
        });
    })
</script>