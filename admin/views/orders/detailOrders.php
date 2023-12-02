<body>
    <div class="container-admin">
        <?php require_once 'views/sidebar.php'; ?>
        <div class="col-2-admin">
            <div class="commodities-title">
                <h4>Chi tiết đơn hàng<h4>
            </div>
            <div class="commodities-container">
                <div class="line-commodities"></div>
                <div class="table-commodities">
                    <table class="commodities">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="product-list">
                            <?php
                    $total_money = 0;
                    foreach ($listOrdersDetail as $value) {
                        extract($value);
                        $total = $quantity * $price;
                        $total_money += $total;
                        echo '
                    <tr>
                        <td>' . $code_order . '</td>
                        <td>' . $name_product . '</td>
                        <td>'.$quantity.'</td>
                        <td>' . number_format($price, 0, '.', '.') . '</td>
                        <td>' . number_format($total, 0, '.', '.') . '</td>';?>
                    <?php } ?>

                        </tbody>
                    </table>
                    <div>
                        <div style="margin-top: 15px;padding-bottom: 15px"><span style="font-size: 18px;font-weight: bold">Tổng tiền:
                                <span style="color: red"><?=number_format($total_money, 0, '.', '.') ?> VNĐ</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>