<div class="product-container-main">
    <div class="product-col-1">
        <div class="main-product">
            <div class="product-list">
                <?php foreach ($list_sp as $value) {
                    extract($value);
//                    $path_deltail = 'index.php?act=deltail&id=' . $id_sanpham;
                    echo '
                         <div class="product">
                        <span class="discount">Giảm 16%</span>
                        <div class="img-product">
                            <a href=""><img src="upload/' . $img_product . '" alt=""></a>
                        </div>
                        <div class="price-product">
                            <s class="price-old">29,000,000<p>VNĐ</p></s>

                            <div class="price-new">' . $price . '<p>VNĐ</p>
                            </div>
                        </div>
                        <h4><a href="">' . $name_product . '</a></h4>
                    </div>
';
                } ?>


            </div>
        </div>
    </div>
    <div class="product-col-2">
        <div class="nav-bar-product">
            <ul class="nav-bar-product-menu">
                <?php
                foreach ($list_dm as $dm) {
                    extract($dm);
                    $path_deltail = 'index.php?act=category&id=' . $id_category;
                    echo '
                <li>
                    <img src="image/navbar_1.svg" alt="">
                    <a href="' . $path_deltail . '">' . $name_category . '</a>
                </li>
                ';
                }
                ?>
            </ul>
        </div>
    </div>
</div>