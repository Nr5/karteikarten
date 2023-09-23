$(".menu > ul > li ").click(function (e) {
    // remove active from already active
    $(this).siblings().removeClass("active");
    // add active to clickead
    $(this).toggleClass("active");
    // if has sub menu oben it
    $(this).find("ul").slideToggle();
    //close other sub menu if any open
    $(this).siblings().find("ul").slideUp();
    //remove active class of sub mneu items
    $(this).siblings().find("ul").find("li").removeClass("active");

});

$(".menu-btn").click(function () {
    $(".sidebar").toggleClass("active");
})
