<?php

if ( $settings->team_filter != 'name' && empty($settings->team_role) ) { 
    echo '<h2>Please choose a valid Team Member Role</h2>'; 
} else { 

?>
    
<div class="team-members">
    
    <?php 

    $teamMembers = $settings->team_members;

    // WP_Query arguments
    if ( $settings->team_filter == 'name' ) {
        $args = array(
            'post_name__in'         => $settings->team_members,
            'post_type'             => array( 'team' ),
            'posts_per_page'        => -1,
        );
    } else {
        $args = array(
            'post_type'             => array( 'team' ),
            'posts_per_page'        => -1,
        );        
    }

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post(); 

            $images = rwmb_meta( 'member_profile_picture', 'size=team-portfolio&limit=1'); 
            $name = rwmb_meta( 'member_name' );
            $firstName = $name['member_first_name'];
            $lastName = $name['member_last_name']; 
            $position = rwmb_meta( 'member_job_role' ); 
            $description = rwmb_meta( 'member_desc_bio' ); 
            $icons = rwmb_meta( 'member_links' ); 

            foreach ( $images as $image ) {
                $portfolio_image = $image['url'];
            }
            
            if ( $settings->team_filter == 'name' ) {
            ?>

            <div class="card">

                <a href="<?php the_permalink(); ?>">

                    <div class="card-header">

                        <img src="<?php echo $portfolio_image; ?>">

                    </div><!-- end card-header -->

                    <div class="card-content">

                        <div class="card-title">

                            <h3><?php echo $firstName; ?> <?php echo $lastName; ?></h3>
                            <h5><?php echo $position; ?></h5>

                        </div><!-- end card-title -->

                        <div class="card-summary">

                            <p><?php echo $description; ?></p>

                        </div><!-- end card-summary -->

                        <div class="card-meta">

                            <?php foreach ($icons as $icon) { ?>

                                <?php if ($icon['member_link_type'] == 'email') { ?>

                                    <a href="mailto:<?php echo $icon['member_social_url']; ?>" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>    

                                <?php } elseif ($icon['member_link_type'] == 'phone') { ?>

                                    <a href="tel:<?php echo $icon['member_social_url']; ?>" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>    

                                <?php } elseif ($icon['member_link_type'] == 'skype') { ?>

                                    <a href="skype:<?php echo $icon['member_social_url']; ?>?call" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>     

                                <?php } else { ?>

                                    <a href="<?php echo $icon['member_social_url']; ?>" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>    

                                <?php } ?>  

                            <?php } ?>

                        </div><!-- end card-meta -->

                    </div><!-- end card-content -->
                </a>

            </div><!-- end card -->

            <?php } else {
                
                if ( $position == $settings->team_role ) { 
        
            ?>
                    

            <div class="card">

                <a href="<?php the_permalink(); ?>">

                    <div class="card-header">

                        <img src="<?php echo $portfolio_image; ?>">

                    </div><!-- end card-header -->

                    <div class="card-content">

                        <div class="card-title">

                            <h3><?php echo $firstName; ?> <?php echo $lastName; ?></h3>
                            <h5><?php echo $position; ?></h5>

                        </div><!-- end card-title -->

                        <div class="card-summary">

                            <p><?php echo $description; ?></p>

                        </div><!-- end card-summary -->

                        <div class="card-meta">

                            <?php foreach ($icons as $icon) { ?>

                                <?php if ($icon['member_link_type'] == 'email') { ?>

                                    <a href="mailto:<?php echo $icon['member_social_url']; ?>" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>    

                                <?php } elseif ($icon['member_link_type'] == 'phone') { ?>

                                    <a href="tel:<?php echo $icon['member_social_url']; ?>" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>    

                                <?php } elseif ($icon['member_link_type'] == 'skype') { ?>

                                    <a href="skype:<?php echo $icon['member_social_url']; ?>?call" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>     

                                <?php } else { ?>

                                    <a href="<?php echo $icon['member_social_url']; ?>" title="<?php echo $icon['member_social_title']; ?>">

                                        <span class="fa <?php echo $icon['member_social_icon']; ?>"></span>

                                    </a>    

                                <?php } ?>  

                            <?php } ?>

                        </div><!-- end card-meta -->

                    </div><!-- end card-content -->
                </a>

            </div><!-- end card -->
    
                <?php }
                
            }

        }
    } else {
        echo '<h2>Please choose a valid Team Member</h2>';
    }

    // Restore original Post Data
    wp_reset_postdata();

    ?>
    
</div>

<?php } ?>