<body>
<div id="container-success">
<div class="container-success">
    <h2>Đặt Hàng Thành Công!</h2>
    <p>Cảm ơn vì đã mua hàng. Đơn hàng của bạn đã được đặt thành công.</p>
    <button onclick="redirectToHome()">Đơn Hàng</button>
</div>
</div>
<script>
    function redirectToHome() {
        window.location.href = "index.php?act=myOrders&status=All";
    }
</script>
</body>

