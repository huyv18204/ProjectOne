<body>
<div class="container-admin">
    <?php
    require_once 'views/sidebar.php';
    ?>
    <div class="col-2-admin">
        <div class="commodities-title">
            <h4>Thêm hàng hoá<h4>
        </div>
        <div class="notification"></div>
        <div class="table-commodities">
            <form action="index.php?act=addProduct" method="post" enctype="multipart/form-data">
                <table class="commodities">
                    <tbody class="product-list">
                    <tr>
                        <td>Tên sản phẩm</td>
                        <td><input name="name-product" type="text"></td>
                    </tr>
                    <tr>
                        <td>Ảnh</td>
                        <td><input name="img" type="file" accept="upload/*"></td>
                    </tr>
                    <tr>
                        <td>Giá tiền</td>
                        <td><input name="price" type="number"></td>
                    </tr>
                    <tr>
                        <td>Danh mục</td>
                        <td><select style="width: 100%" name="category" id="">
                                <option value="0"> Chọn danh mục</option>
<!--                                --><?php
//                                foreach ($listdm as $value) {
//                                    extract($value);
//                                    echo '<option value="' . $id_danhmuc . '">' . $ten_danhmuc . '</option>';
//                                } ?>
                                <option value="1">Iphone 15 ProMax</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Mô tả</td>
                        <td><textarea rows="10" cols="80" name="decription"></textarea></td>
                    </tr>
                    </tbody>
                </table>
                <div class="add">
                    <button class="btn-list" type="submit"><a href="index.php?act=listProduct">Danh sách sản phẩm</a>
                    </button>
                    <button name="btn-add" class="btn-add" type="submit">Thêm</button>
                </div>
            </form>
        </div>


    </div>
</div>
</div>
</body>