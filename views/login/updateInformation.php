<div class="auth-wrapper">
    <h2 class="auth-title">
        Hồ sơ của tôi
    </h2>
    <div class="updateInfo-container">
        <div class="information">
            <div class="auth-updateInfo">
                <form class="login-form" method="post" action="">
                    <div class="inFor">
                        <div>
                            <lable>Tên Tài Khoản: </lable>
                        </div>
                        <div class="inFor_input"><input name="account" readonly type="text"
                                                        class="form-updateInfo" value="" placeholder=""></div>
                    </div>
                    <div class="inFor">
                        <div>
                            <lable>Họ Và Tên:</lable>
                        </div>
                        <div><input class="inFor_input" name="name" type="text" class="form-updateInfo" value=""
                                    placeholder=""></div>
                    </div>
                    <div class="inFor">
                        <div>
                            <lable>Email:</lable>
                        </div>
                        <div><input class="inFor_input" name="email" type="email" class="form-updateInfo" value=""
                                    placeholder=""></div>
                    </div>
                    <div class="inFor">
                        <div>
                            <lable>Số Điện Thoại:</lable>
                        </div>
                        <div><input class="inFor_input" name="phone" type="text" class="form-updateInfo" value=""
                                    placeholder=""></div>
                    </div>
                    <div class="inFor">
                        <div>
                            <lable>Mậu Khẩu:</lable>
                        </div>
                        <div><a href="index.php?act=change_pass"><input class="inFor_input" name="pass"
                                                                        type="password" class="form-updateInfo" value="" readonly placeholder=""></a>
                        </div>
                    </div>
                    <div class="inFor">
                        <div>
                            <lable>Địa Chỉ:</lable>
                        </div>
                        <div><input class="inFor_input" name="address" type="text" class="form-updateInfo" value=""
                                    placeholder=""></div>
                    </div>
                    <div class="footer-updateInfo">
                        <div></div>
                        <input type="hidden" name="id_user" value="">
                        <input name="btn-updateInfo" type="submit" value="Cập Nhật" class="">
                    </div>
                </form>
            </div>
        </div>
        <div class="img-inFormation">
            <form action="">
                <div>
                    <img src="image/user.png" alt="">
                    <button type="submit">Đổi Ảnh</button>
                </div>
            </form>
        </div>
    </div>
</div>