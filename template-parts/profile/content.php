<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php
    // Get the profile being viewed
    $username = get_query_var('profile_username');
    $viewed_user = get_user_by('login', $username);
    $viewed_user_id = $viewed_user instanceof \WP_User ? $viewed_user->ID : 0;
    $current_user_id = get_current_user_id();
    
    // Check if user is viewing their own profile
    $is_own_profile = ( $current_user_id && $current_user_id === $viewed_user_id );
    
    $profile_content_tabs = [
        [
            'page' => 'questions',
            'title' => esc_html__( 'Forum Questions', 'engispace' ),
        ],
        [
            'page' => 'comments_and_answer',
            'title' => esc_html__( 'Comments & Answer', 'engispace' ),
        ],
    ];
    
    // Only add courses tab if viewing own profile
    if ( $is_own_profile ) {
        array_unshift( $profile_content_tabs, [
            'page' => 'courses',
            'title' => esc_html__( 'Courses', 'engispace' ),
        ]);
    }
?>

<div class="es-profile-content-tabs">
    <ul>
        <?php
            foreach( $profile_content_tabs as $page ) {
                // Determine the correct profile base URL
                $profile_base_url = $username 
                    ? get_home_url() . '/profile/' . $username 
                    : get_home_url() . '/profile';

                $url = add_query_arg( [
                    'tab' => $page['page'],
                    'intent' => 'view_content',
                ], $profile_base_url );

                printf(
                    '<li class="%s"><a href="%s">%s</a></li>',
                    es_get_course_current_tab_class( $page['page'], $is_own_profile ? 'courses' : 'questions' ),
                    $url,
                    $page['title'],
                );
            }
        ?>
    </ul>
</div>

<div class="es-profile-page-content">
    <?php
        // Set default tab - courses if viewing own profile, otherwise questions
        $default_tab = $is_own_profile ? 'courses' : 'questions';
        $current_page = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : $default_tab;
        
        // Prevent access to courses tab if not viewing own profile
        if ( $current_page === 'courses' && !$is_own_profile ) {
            $current_page = 'questions';
        }
        $intent = isset( $_GET['intent'] ) ? sanitize_text_field( $_GET['intent'] ) : 'view_content';

        if ( $intent === 'view_content' ) {
            get_template_part( 'template-parts/profile/' . $current_page );
        }
        if ( $intent === 'update_course_meta_data' ) {
            get_template_part( 'template-parts/profile/update-course-metadata' );
        }
    ?>
</div>