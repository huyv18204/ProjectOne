 <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) : ?>
 <div class="cart-container">
     <div></div>
     <div class="cart-columns-1">
         <?php
            $quantity = 0 ;
            $total = 0;
            foreach ($_SESSION['cart'] as $cart) {
                foreach ($cart as $value) {
                    if ($_SESSION['account']['id_user'] == $value['id_user']){
                        $quantity += $value['quantity'];
                        $total += $value['quantity'] * $value['price'];

                ?>
         <form action="" method="post">
             <div class="block-cart">

                 <input name="id_product" value="<?= $value['id_product'] ?>" type="hidden">
                 <input name="selectedProducts[]" class="checkbox-cart" type="checkbox">
                 <a href="index.php?act=deltailProduct&id=<?=$value['id_product']?>"><img src="upload/<?= $value['img_product'] ?>" alt=""></a>
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
                         <div class="adjust">
                             <button name="btnUpdateCart" onclick="reduceValue(this)">-</button>
                             <input readonly type="text" name="quantity" id="display" value="<?= $value['quantity'] ?>">
                             <button name="btnUpdateCart" onclick="increaseValue(this)">+</button>
                         </div>
                     </div>
                 </div>
                 <a class="bin" href="index.php?act=deleteProductInCart&id=<?=$value['id_product'] ?>">
                     <i class="fa-solid fa-trash fa-xl" style="color: #000000;"></i>
                 </a>
         </form>
     </div>
     <?php }}} ?>
 </div>
 <div class="cart-columns-2">
     <h3>THÔNG TIN TỔNG</h3>
     <p>---------------------------------------------------------------------------------</p>
     <div class="soluong">
         <h4>Số lượng hàng:</h4>
         <div><?= $quantity ?></div>
     </div>
     <div class="total">
         <h4>Tổng tiền:</h4>
         <div><?=$total ?> VNĐ</div>
     </div>
     <form action="" method="post">
         <button name="btn-orders" type="submit">
             <p>TIẾN HÀNH ĐẶT HÀNG</p>
         </button>
     </form>
 </div>
 <div></div>
 </div>
 <?php else : ?>
 <div class="cart-empty"><span>Giỏ hàng trống.</span></div>
 <?php endif; ?>

