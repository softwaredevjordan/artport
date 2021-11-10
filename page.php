<?php 
get_header();
?>

<h1><?php the_title() ?></h1>
<img src="<?php echo get_theme_file_uri();?>/img/screenshot.png" alt="">
<div class="content">
<?php the_content() ?>
</div>
<?php    
get_footer();   
?>
