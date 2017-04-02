<?php
    $name_font = $settings->name_font;
    $name_color = $settings->name_color;
    $role_font = $settings->role_font;
    $role_color = $settings->role_color;
    $bio_font = $settings->bio_font;
    $bio_color = $settings->bio_color;
    $icon_color = $settings->icon_color;
    $icon_color_hover = $settings->icon_color_hover;
?>
.card-title h3 {
    font-family: <?php echo $name_font['family']; ?>;
    font-weight: <?php echo $name_font['weight']; ?>;
    color: #<?php echo $name_color; ?>;
}
.card-title h5 {
    font-family: <?php echo $role_font['family']; ?>;
    font-weight: <?php echo $role_font['weight']; ?>;
    color: #<?php echo $role_color; ?>;
}
.card-meta a {
    color: #<?php echo $icon_color; ?>;
}
.card-meta a:hover {
    color: #<?php echo $icon_color_hover; ?>;
}
.card-summary p {
    font-family: <?php echo $bio_font['family']; ?>;
    font-weight: <?php echo $bio_font['weight']; ?>;
    color: #<?php echo $bio_color; ?>;
}