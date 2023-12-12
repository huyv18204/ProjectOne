var showButton = document.getElementById("showButton");
var categoryList = document.getElementById("categoryList");

// Hiển thị hoặc ẩn menu con khi click vào nút
showButton.addEventListener("click", function (event) {
    if (categoryList.style.display === "none" || categoryList.style.display === "") {
        categoryList.style.display = "block";
    } else {
        categoryList.style.display = "none";
    }
    event.stopPropagation();
});

// Ẩn menu con khi click ra ngoài
window.addEventListener("click", function () {
    categoryList.style.display = "none";
});

$(document).ready(function () {
    $('.row-product').slick(
        {
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false
        }
    );

});

$(document).ready(function () {
    $('.banner').slick(
        {
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: false
        }
    );

});

$('.img-deltail-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.img-deltail-nav'
});
$('.img-deltail-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.img-deltail-for',
    // dots: true,
    // centerMode: true,
    focusOnSelect: true,
    arrows: false
});
