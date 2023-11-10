<body>
<div class="container-admin">
    <?php
    require_once 'views/sidebar.php';
    ?>
    <div class="col-2-admin">
        <div class="commodities-title">
            <h4>Quản lí bình luận<h4>
        </div>
        <div class="commodities-container">
            <div class="line-commodities"></div>
            <div class="table-commodities">
                <table class="commodities">
                    <thead>
                    <tr>
                        <th width="10"><input type="checkbox"></th>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Sản phẩm</th>
                        <th>Người bình luận</th>
                        <th>Ngày bình luận</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($list_comment as $comment) {
                        extract($comment);
                        $path_del = 'index.php?act=del-comment&id=' . $id;
                        echo '

                                            <tbody class="product-list">
                    <tr>
                        <td width="10"><input type="checkbox"></td>
                        <td>' . $id . '</td>
                        <td>' . $content . '</td>
                        <td>' . $ten_sanpham . '</td>
                        <td>' . $name . '</td>
                        <td>' . $date_comment . '</td>
                        <td><button class="delete">
                                <a href="' . $path_del . '"><i class="fas fa-trash-alt"></i></a>
                       </button></td>
                    </tr>
                    </tbody>

                        ';
                    }
                    ?>

                </table>
                <div id="pagination"></div>
            </div>
        </div>
    </div>
</div>
</body>