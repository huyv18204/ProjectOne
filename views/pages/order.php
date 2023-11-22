<div class="cart-container">
    <div></div>
    <div class="cart-columns-1">
        <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) : ?>
        <?php
        $quantity = 0 ;
        $total = 0;
        foreach ($_SESSION['cart'] as $cart) : ?>
        <?php foreach ($cart as $value) : ?>
        <?php ;
        $quantity += $value['quantity'];
        $total += $value['quantity'] * $value['price'];
        ?>
        <form action="" method="post">
            <div class="block-cart">

                <input name="id_product" value="<?= $value['id_product'] ?>" type="hidden">
                <input class="checkbox-cart" type="checkbox">
                <img src="upload/<?= $value['img_product'] ?>" alt="">
                <div class="inFor_product">
                    <div class="name-product-cart">
                        <h4>Tên sản phẩm:</h4>
                        <p><?= $value['name_product'] ?></p>
                    </div>
                    <div class="name-price-cart">
                        <h4>Giá:</h4>
                        <p><?= $value['price'] ?></p>
                    </div>
                    <div class="quantity-product-cart">
                        <h4>Số lượng:</h4>
                        <p><?= $value['quantity'] ?></p>
                    </div>
                </div>
        </form>
    </div>
    <?php endforeach; ?>
    <?php endforeach; ?>

    <?php else : ?>
<!--        <p>Giỏ hàng trống.</p>-->
    <?php endif; ?>
</div>
    <div class="cart-columns-2">
        <form action="index.php?act=order" method="post">
            <div>
                <h3>THÔNG TIN ĐẶT HÀNG</h3>
                <div class="data-order">
                    <input name="name_order" type="text" placeholder="  Họ và tên">
                    <input name="phone_order" type="text" placeholder="  Số điện thoại">
                    <input name="email_order" type="text" placeholder="  Email">
                    <input name="address_order" type="text" placeholder="  Địa chỉ">
                    <input name="takeNode" type="text" placeholder="  Ghi chú">
                </div>
            </div>
            <div class="pay">
                <h3>PHƯƠNG THỨC THANH TOÁN</h3>
                <div><input value="0" name="pay" type="radio"> Thanh toán khi nhận hàng</div>
                <div> <input value="1" name="pay" type="radio"> Thanh toán bằng thẻ tín dụng</div>
            </div>
            <h4 class="total-pay">TỔNG TIỀN: <?= $total ?> VNĐ </h4>
            <input name="total" value="<?= $total ?>" type="hidden">
            <div class="adjust-pay">
                <?php
                if (empty($_SESSION['cart'])){?>
                <input name="btn-submit" type="submit" value="Đặt Hàng" class="btn-pay">
                <?php }else{ ?>
                <input onclick="notify()" name="btn-submit" type="submit" value="Đặt Hàng" class="btn-pay">
                <?php } ?>
            </div>
        </form>

    </div>
    <div></div>
</div>
<script>
    function notify(){
        alert("Đặt hàng thành công")
    }
</script>
