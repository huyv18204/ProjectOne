<body>
<div class="container-admin">
    <?php
    require_once 'views/sidebar.php';
    ?>
    <div class="col-2-admin">
        <div class="commodities-title">
            <h4>Quản lí danh mục<h4>
        </div>
        <div class="commodities-container">
            <div class="function-commodities">
                <button class="add-commodities" type="submit"><a href="index.php?act=addCategory">Tạo danh mục mới</a>
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
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <tbody class="product-list">
                            <tr>
                        <td width="10"><input type="checkbox"></td>
                        <td>1</td>
                        <td>IPHONE 15 SERIES</td>
                        <td>

                       <button class="delete">
                                <a href=""><i class="fas fa-trash-alt"></i></a>
                       </button>
                       <button class="edit">
                                <a href="index.php?act=editCategory"><i class="fas fa-edit"></i></a>
                       </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div id="pagination"></div>
            </div>
        </div>
    </div>
</div>
</body>