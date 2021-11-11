<?php 
get_header();
?>
<div class="flex-column" >
    <div class=" loop d-flex" id="mixed-loop">
        <?php 
        
        $mainLoop = new WP_Query(array(
            'post_per_page' => -1,
            'post_type' => array('art','concepts')
        ));
    
        while($mainLoop->have_posts()) {
            $mainLoop->the_post();
            ?>    
    
                
                <div class="post">
                    <a href="<?php the_permalink(); ?>">
                    <img class="images"  src="<?php the_post_thumbnail_url($size = 'medium') ?>" alt="">
                    <p class="title"><?php the_title() ?></p>
                    </a>   
                </div>

         <?php
        }
        wp_reset_postdata();
        ?>    
    </div>      

   
</div>
       
<?php   
get_footer(); 
?> 