<body>
<div class="container-admin">
    <?php
    require_once 'views/sidebar.php';
    ?>
    <div class="col-2-admin">
        <div class="commodities-title">
            <h4>Quản lí khách hàng<h4>
        </div>
        <div class="commodities-container">
            <div class="function-commodities">
                <button class="add-commodities" type="submit"><a href="index.php?act=addUser">Tạo khách hàng mới</a>
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
                        <th>Mã khách hàng</th>
                        <th>Ảnh</th>
                        <th>Họ và tên</th>
                        <th>Tên tài khoản</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Vai trò</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <?php foreach ($listkh as $user) {
                        extract($user);
                        $path_edit = 'index.php?act=edit-kh&id=' . $id_user;
                        $path_del = 'index.php?act=del-kh&id=' . $id_user;
                        if ($role == 1) {
                            $role_user = "Quản trị viên";
                        } else {
                            $role_user = "Khách hàng";
                        }
                        echo '
                    <tbody class="product-list">
                    <tr>
                        <td width="10"><input type="checkbox"></td>
                        <td>' . $id_user . '</td>
                        <td><img src="../image/iphone.png" alt=""></td>
                        <td>' . $name . '</td>
                        <td>' . $account . '</td>
                        <td>' . $email . '</td>
                        <td>' . $phone . '</td>
                        <td>' . $address . '</td>
                        <td>' . $role_user . '</td>
                        <td>
                            <button class="delete">
                                <a href="' . $path_del . '"><i class="fas fa-trash-alt"></i></a>
                       </button>
                       <button class="edit">
                                <a href="index.php?act=editUser"><i class="fas fa-edit"></i></a>
                       </button>
                        </td>
                    </tr>
                    </tbody>
                    ';
                    } ?>

                </table>
                <div id="pagination"></div>
            </div>
        </div>
    </div>
</div>
</body>