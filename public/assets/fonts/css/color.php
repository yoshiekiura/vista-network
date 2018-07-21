<?php
header ("Content-Type:text/css");
$color = "#746EF1"; // Change your Color Here

function checkhexcolor($color) {
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
    $color = "#".$_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
    $color = "#746EF1";
}

?>

nav.main-menu ul li.active{
        border-bottom-color:<?php echo $color; ?>;
}

nav.main-menu li ul.sub-menu {
    box-shadow: 0px 5px 10px <?php echo $color; ?>;
}



.head-slider .owl-nav div,
.about-community .section-title h2 span,
.discunt-text h3,
.top-investor .color-text,
.slider-activation .owl-nav div,
.testimoanial-top-text p,
.section-title .color-text

{
    color:<?php echo $color; ?>;
}



.head-slider .owl-nav div:hover,
.head-slider .owl-dots div.active,
.about-right-img .hover,
.service-wrapper:hover,
ul.investor-social li:hover,
.scroll-to-top a,
.slider-activation .owl-dots div.active,
.slider-activation .owl-nav div:hover,
button.submit-btn,
.preloader,
.social-link a:hover,
input[type="submit"],
.single-shape-box.color-onvestor,
button.submit-btn,
button.submit-btn:hover
{
    background-color: <?php echo $color; ?>;
}


ul.investor-social li:hover,
.profile-pic img,
button.submit-btn,
button.submit-btn:hover
{
    border-color:<?php echo $color; ?>;
}


.slider-activation:before

{
    box-shadow: 1px -8px 3px -2px <?php echo $color; ?>;
}

.slider-activation:after
{
        box-shadow: 1px 8px 3px -2px <?php echo $color; ?>;
}

.color-onvestor.single-shape-box:before {
    border-bottom: 50px solid <?php echo $color; ?>;
}
.color-onvestor.single-shape-box:after {
    border-top: 50px solid <?php echo $color; ?>;
}

<!--.main-center{-->
<!--box-shadow: 0 0 35px --><?php //echo $color; ?><!--;-->
<!--}-->
