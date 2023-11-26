<body>
    <div class="container_purchase">
        <div class="menu_purchase">
            <ul id="menu_purchase">
                <li><a href="index.php?act=myOrders&status=0">Tất cả</a></li>
                <li><a href="index.php?act=myOrders&status=0">Đã thanh toán</a></li>
                <li><a href="index.php?act=myOrders&status=1">Chờ xác nhận</a></li>
                <li><a href="index.php?act=myOrders&status=2">Đang xử lí</a></li>
                <li><a href="index.php?act=myOrders&status=3">Đang vận chuyển</a></li>
                <li><a href="index.php?act=myOrders&status=5">Hoàn thành</a></li>
                <li><a href="index.php?act=myOrders&status=6">Đã Huỷ</a></li>
            </ul>
        </div>
        <?php foreach ($listOrders as $orders){
            extract($orders);
            $listOrdersProduct = listOrdersProduct($code_order);
            if($status == 1){
                $statusDiffirent = 'Chờ xác nhận';
            }elseif ($status == 2){
                $statusDiffirent = 'Đang xử lí';
            }elseif ($status == 3){
                $statusDiffirent = 'Đang vận chuyển';
            }elseif ($status == 4){
                $statusDiffirent = 'Giao hàng thành công';
            }elseif ($status == 6){
                $statusDiffirent = 'Huỷ bỏ';
            }elseif ($status == 5){
                $statusDiffirent = 'Hoàn tất';
            }
            ?>
        <div class="purchase">
            <div class="content_purchase">
                <div class="truck">
                    <i class="fa-solid fa-truck fa-s" style="color: #24aa99;"></i>
                    <span><?=$statusDiffirent ?></span>
                </div>
                <div class="linePurchase"></div>
                <div class="inFo-purchase">
                    <?php
                    foreach ($listOrdersProduct as $product){
                        extract($product)?>
                    <div class="myOrders">
                        <div><img src="upload/<?= $product['img_product'] ?>" alt=""></div>

                        <div>
                            <h3 class="title-purchase"><?=$product['name_product'] ?></h3>
                            <p>Số lượng: <?=$product['quantity'] ?></p>
                        </div>
                        <div class="total-purchase">
                            <span class="priceProduct-purchare"><?=$priceProduct?> VNĐ</span>
                            <span class="discount-purchare"><?=$discount ?> VNĐ</span>
                        </div>
                    </div>
                    <?php } ?>


                </div>
                <div class="linePurchase"></div>
                <div class="footer-purchase">
                    <div>
                        <span class="start-purchase"><span style="font-size: 20px;font-weight: bold">Thành
                                tiền:</span><span class="total-conclusion"><?= $total_money ?> VNĐ</span></span>
                    </div>
                    <div class="end-purchase">
                        <p class="date-purchase">Ngày đặt: <?=$date_order ?></p>

                        <?php if($status == 1 or $status == 2){?>
                        <div class="btn-purchase">
                            <form action="" method="post">
                                <input name="id_order" value="<?=$id_order?>" type="hidden">
                                <button name="detail_order" class="reBuy detail_order"><a href="index.php?act=myOrdersDetail&codeOrder=<?=$code_order?>">Chi tiết</a></button>
                                <button name="btnCancel" class="checkOrder">Huỷ Đơn Hàng</button>
                            </form>
                        </div>
                        <?php } elseif($status == 4) {?>
                        <div class="btn-purchase">
                            <form action="" method="post">
                                <input name="id_order" value="<?=$id_order?>" type="hidden">
                                <button name="btnSuccess" class="checkOrder">Đã Nhận Được Hàng</button>
                                <form>
                        </div>
                        <?php }elseif($status == 5){?>
                        <div class="btn-purchase">
                            <form action="" method="post">
                                <button name="detail_order"  class="reBuy detail_order"><a href="index.php?act=myOrdersDetail&codeOrder=<?=$code_order?>">Chi tiết</a></button>
                                <form>
                        </div>
                        <?php }elseif($status == 3){?>
                            <div class="btn-purchase">
                                <form action="" method="post">
                                    <button name="detail_order"  class="reBuy detail_order"><a href="index.php?act=myOrdersDetail&codeOrder=<?=$code_order?>">Chi tiết</a></button>
                                    <form>
                            </div>
                    <?php }?>

                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>