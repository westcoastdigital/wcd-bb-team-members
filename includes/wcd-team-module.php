<?php 

class WCDTeamClass extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'Team Members', 'wcd-team' ),
            'description'     => __( 'Add Team Members to your website', 'wcd-team' ),
            'category'        => __( 'Custom Modules', 'wcd-team' ),
            'dir'             => WCD_TEAM_DIR . '/',
            'url'             => WCD_TEAM_URL . '/',
            'partial_refresh' => true,
        ));
        
        $this->add_css( 'font-awesome' );
        
    }
}

FLBuilder::register_module( 'WCDTeamClass', array(
    'content-tab'      => array(
        'title'         => __( 'Content', 'wcd-team' ),
        'sections'      => array(
            'content-section'  => array(
                'title'         => __( 'Choose Team Members', 'wcd-team' ),
                'fields'        => array(
                    
                    'team_filter' => array(
                        'type'          => 'select',
                        'label'         => __( 'Filter by Name or Role?', 'wcd-team' ),
                        'default'       => 'name',
                        'options'       => array(
                            'name'      => __( 'Name', 'wcd-team' ),
                            'role'      => __( 'Role', 'wcd-team' )
                        ),
                        'toggle'        => array(
                            'name'      => array(
                                'fields'        => array( 'team_members' ),
                            ),
                            'role'      => array(
                                'fields'        => array( 'team_role' ),
                            ),
                        )
                    ), // end team_filter
                    
                    'team_members' => array(
                        'type'          => 'select',
                        'label'         => __( 'Team Members', 'wcd-team' ),
                        'options'       => wcd_team_options(),
                        'multi-select'  => true,
                        'description'   => __( '<br />Hold control or command to select multiple members', 'wcd-team' ),
                    ), // end team_members
                    
                    'team_role' => array(
                        'type'          => 'text',
                        'label'         => __( 'Team Role', 'wcd-team' ),
                        'description'   => __( '<br />Verify team positions <a href="' . admin_url( 'edit.php?post_type=team' ) . '" target="_blank">here</a>', 'wcd-team' ),
                    ), // end team_role
                    
                ) // end fields
            ) // end content-section
        ) // end sections
    ), // end content-tab
    
    'style-tab'      => array(
        'title'         => __( 'Style', 'wcd-team' ),
        'sections'      => array(
            'style-section'  => array(
                'title'         => __( 'Style Team Member Cards', 'wcd-team' ),
                'fields'        => array(
                    
                    'name_font' => array(
                        'type'          => 'font',
                        'label'         => __( 'Name Font', 'wcd-team' ),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'default'
                        )
                    ), // end name_font
                    
                    'name_color' => array(
                        'type'         => 'color',
                        'label'        => __('Name Color', 'wcd-team'),
                        'preview'      => array(
                            'type'         => 'css',
                            'selector'     => '.card-title h3',
                            'property'     => 'color'
                        ),
                        'show_reset'    => true
                    ), // end name_color
                    
                    'role_font' => array(
                        'type'          => 'font',
                        'label'         => __( 'Role Font', 'wcd-team' ),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'default'
                        )
                    ), // end role_font
                    
                    'role_color' => array(
                        'type'         => 'color',
                        'label'        => __('Role Color', 'wcd-team'),
                        'preview'      => array(
                            'type'         => 'css',
                            'selector'     => '.card-title h5',
                            'property'     => 'color'
                        ),
                        'default'   => 'cccccc',
                        'show_reset'    => true
                    ), // end role_color
                    
                    'bio_font' => array(
                        'type'          => 'font',
                        'label'         => __( 'Description Font', 'wcd-team' ),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'default'
                        )
                    ), // end bio_font
                    
                    'bio_color' => array(
                        'type'         => 'color',
                        'label'        => __('Description Color', 'wcd-team'),
                        'preview'      => array(
                            'type'         => 'css',
                            'selector'     => '.card-summary p',
                            'property'     => 'color'
                        ),
                        'show_reset'    => true
                    ), // end role_color
                    
                    'icon_color' => array(
                        'type'         => 'color',
                        'label'        => __('Icon Color', 'wcd-team'),
                        'preview'      => array(
                            'type'         => 'css',
                            'selector'     => '.card-meta a',
                            'property'     => 'color'
                        ),
                        'show_reset'    => true
                    ), // end icon_color
                    
                    'icon_color_hover' => array(
                        'type'         => 'color',
                        'label'        => __('Icon Color - Hover', 'wcd-team'),
                        'preview'      => array(
                            'type'         => 'css',
                            'selector'     => '.card-meta a:hover',
                            'property'     => 'color'
                        ),
                        'show_reset'    => true
                    ), // end icon_color_hover
                    
                ) // end fields
            ) // end style-section
        ) // end sections
    ), // end style-tab
    
) ); 

function wcd_team_options ( $posts = array( '' => 'Choose team member') ) { 
    
    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'team',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $post ) {
            $title = $post->post_title;
            $slug = $post->post_name;
            $posts += array(
                $slug => $title
            );
        }
    }   
    return apply_filters( 'wcd_team_options', $posts );
}