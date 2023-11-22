
<body>
<div class="container-admin">
    <?php
    require_once 'views/sidebar.php';
    ?>
    <div class="col-2-admin">
        <div class="commodities-title">
            <h4>Quản lí đơn hàng<h4>
        </div>
        <div class="commodities-container">
            <div class="function-commodities">
                <button class="add-commodities" type="submit"><a href="index.php?act=addProduct">Tạo sản phẩm
                        mới</a>
                </button>
                <button class="select-all-commodities" type="submit"><a href="">Chọn tất cả</a></button>
                <button class="unchecker-commodities" type="submit"><a href="">Bỏ chọn tất cả</a></button>
                <button class="delete-all-commodities" type="submit"><a href="">Xoá tất cả</a></button>
            </div>
            <div class="line-commodities"></div>
            <div class="table-commodities">
                <table class="commodities">
                    <thead>
                    <tr>
                        <th width="10"><input type="checkbox"></th>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <tbody class="product-list">
                    <?php
                    foreach ($listOrders as $value) {
                        extract($value);
                        if($status == 0){
                            $statusDiffirent = 'Chưa thanh toán';
                        }else{
                            $statusDiffirent = 'Đã thanh toán';
                        }
                        $path_detail = 'index.php?act=detailOrders&codeOder=' . $code_order;
                        $path_updateStatus = 'index.php?act=updateStatus&codeOder=' . $code_order;
                        echo '
                    <tr>
                        <td width="10"><input type="checkbox"></td>
                        <td>' . $code_order . '</td>
                        <td>' . $name_user . '</td>
                         <td>'.$address.'</td>
                        <td>' . $email . '</td>
                        <td>'.$phone.'</td>
                        <td>'.$date_order.'</td>
                        <td>' . $statusDiffirent . '</td>
                        <td>
                                            ';?>
                        <?php if($status == 1){ ?>
                        <button class="edit">
                            <a href="<?= $path_detail?>"><i class="fas fa-edit"></i></a>
                        </button>
                            <?php }else{ ?>
                            <button class="delete">
                                <a href="javascript:confirmSuccess('<?php echo $path_updateStatus?>')"><i class="fa-solid fa-check" style="color: #59c065;"></i></i></a>
                            </button>
                            <button class="edit">
                                <a href="<?= $path_detail?>"><i class="fas fa-edit"></i></a>
                            </button>
                            <?php } ?>

                        </td>
                        <?php
                    } ?>
                    </tbody>
                </table>
                <div id="pagination"></div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function confirmSuccess(delUrl) {
        if (confirm("Thay đổi trạng thái đơn hàng?")) {
            document.location = delUrl;
        }
    }
</script>