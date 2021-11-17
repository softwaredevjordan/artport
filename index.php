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
            
                <div class="post" id=>
                    <a href="<?php the_permalink(); ?>">
                    <button data-toggle="modal" onclick="javascript: return false;"  data-target="#<?php the_title() ?>">
                    <img class="images"  src="<?php the_post_thumbnail_url($size = 'medium') ?>" alt="">
                    </button>
                    <p class="title"><?php the_title() ?></p>
                    </a>   
                </div>
            

            <div class="modal" id="<?php the_title() ?>" role="dialog">
                <div class="modal-dialog">
                    <div class= "modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?php the_title() ?></h4>
                        </div>
                        <div class="modal-body">
                            <img src="<?php the_post_thumbnail_url($size = 'medium') ?>" alt="">
                        </div>
                        <div class="modal-footer"></div>
                        <p>alskjf</p>
                    </div>
                </div>
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