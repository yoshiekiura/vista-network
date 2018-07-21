<?php
header ("Content-Type:text/css");
$color = "#42475B"; // Change your Color Here

function checkhexcolor($color) {
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
    $color = "#".$_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
    $color = "#42475B";
}

?>

.support-bar,
.main-menu li ul.sub-menu li:hover a,
.service-wrapper,
.single-investor-wrapper,
table th,
.footer-section,
.footer-section:before,
.footer-section:after,
.single-shape-box,
table.dataTable th,
.pagination>li.active a,
.dt-buttons .dt-button,
.slicknav_menu
{
     background-color: <?php echo $color; ?>;
}

.header-section h1 span,
.social-link a svg
{
    color:<?php echo $color; ?>;
}
.single-shape-box:before 
{
    border-bottom-color:<?php echo $color; ?>;
}
.single-shape-box:after
{
    border-top-color:<?php echo $color; ?>;
}
.pagination>li.active a
{
    border-color:<?php echo $color; ?>;
}
