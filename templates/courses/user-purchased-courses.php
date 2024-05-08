<?php

// Build the courses array
$courses_array = [
    [
        'title' => 'Node.js: The Complete Guide to Build RESTful APIs',
        'category' => 'Unity Programing',
        'original_price' => '50.99',
        'discounted_price' => '5.99',
        'currency' => '$',
        'rating' => '5',
        'img' => THEME_URI . '/assets/img/node-js-course-banner.png',
        'img@2x' => THEME_URI . '/assets/img/node-js-course-banner@2x.png',
        'description' => 'Obtain Modern C++ Object-Oriented Programming and STL skills that are extremely in demand in the job market.',
        'lectures' => 29,
        'duration' => '20 hours',
        'level' => 'Beginner level'
    ],
    [
        'title' => 'The Complete React Web Developer Course (with full guide)',
        'category' => 'Tropical Control Systems',
        'original_price' => '50.99',
        'discounted_price' => '5.99',
        'currency' => '$',
        'rating' => '5',
        'img' => THEME_URI . '/assets/img/node-js-course-banner.png',
        'img@2x' => THEME_URI . '/assets/img/node-js-course-banner@2x.png',
        'description' => 'Obtain Modern C++ Object-Oriented Programming and STL skills that are extremely in demand in the job market.',
        'lectures' => 29,
        'duration' => '20 hours',
        'level' => 'Beginner level'
    ],
    [
        'title' => 'CSS - The Complete Guide (including Flexbox, Guide, Sass)',
        'category' => 'IO Configuration',
        'original_price' => '50.99',
        'discounted_price' => '5.99',
        'currency' => '$',
        'rating' => '5',
        'img' => THEME_URI . '/assets/img/node-js-course-banner.png',
        'img@2x' => THEME_URI . '/assets/img/node-js-course-banner@2x.png',
        'description' => 'Obtain Modern C++ Object-Oriented Programming and STL skills that are extremely in demand in the job market.',
        'lectures' => 29,
        'duration' => '20 hours',
        'level' => 'Beginner level'
    ],
];

$cart_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M15 1.66602C14.6117 1.66602 14.275 1.93352 14.1875 2.31185L13.3758 5.83268H2.50002C2.24335 5.83268 2.00085 5.95185 1.84335 6.15352C1.68502 6.35602 1.62918 6.61935 1.69168 6.86852L3.35835 13.5352C3.45085 13.906 3.78418 14.166 4.16668 14.166H12.5C12.8884 14.166 13.225 13.8985 13.3125 13.521L15.6625 3.33268H18.3334V1.66602H15Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M5.00004 15C4.08004 15 3.33337 15.7467 3.33337 16.6667C3.33337 17.5883 4.08004 18.3333 5.00004 18.3333C5.92004 18.3333 6.66671 17.5883 6.66671 16.6667C6.66671 15.7467 5.92004 15 5.00004 15Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.6667 15C10.7467 15 10 15.7467 10 16.6667C10 17.5883 10.7467 18.3333 11.6667 18.3333C12.5867 18.3333 13.3333 17.5883 13.3333 16.6667C13.3333 15.7467 12.5867 15 11.6667 15Z" fill="white"/></svg>';

$lectures_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M14.1667 16.6667V13.3333L16.6667 15L14.1667 16.6667ZM15 10C12.2425 10 10 12.2425 10 15C10 17.7575 12.2425 20 15 20C17.7575 20 20 17.7575 20 15C20 12.2425 17.7575 10 15 10Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M5 16.6667H8.55167C8.41417 16.1333 8.33333 15.5767 8.33333 15C8.33333 11.3183 11.3175 8.33333 15 8.33333V0.833333C15 0.373333 14.6267 0 14.1667 0H5V16.6667Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M3.33333 0H0.833333C0.373333 0 0 0.373333 0 0.833333V15.8333C0 16.2933 0.373333 16.6667 0.833333 16.6667H3.33333V0Z" fill="#A9B7C7"/></svg>';

$duration_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.293 13.707L9.293 10.707C9.105 10.52 9 10.266 9 10V5H11V9.586L13.707 12.293L12.293 13.707ZM10 1C5.038 1 1 5.038 1 10C1 14.962 5.038 19 10 19C14.962 19 19 14.962 19 10C19 5.038 14.962 1 10 1Z" fill="#A9B7C7"/></svg>';

$level_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M18.7059 5.92081L10.3725 1.75414C10.1384 1.63664 9.86171 1.63664 9.62671 1.75414L1.29337 5.92081C1.12504 6.00497 0.997541 6.14914 0.922541 6.30664C0.871707 6.40747 0.833374 6.57997 0.833374 6.66664V11.47C0.833374 11.93 1.20587 12.3033 1.66671 12.3033C2.12671 12.3033 2.50004 11.93 2.50004 11.47V7.63914L10.0117 10.7683L18.6425 7.43997C18.9467 7.31831 19.1525 7.02914 19.1659 6.70081C19.1792 6.37247 18.9992 6.06747 18.7059 5.92081Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10.0001 12.3608C9.89091 12.3608 9.78175 12.3392 9.67925 12.2967L4.16675 10V12.5117C4.16675 12.8267 4.34508 13.115 4.62758 13.2567C6.05675 13.9717 7.52925 14.8558 10.0001 14.8558C12.4692 14.8558 13.9459 13.97 15.3726 13.2567C15.6551 13.115 15.8334 12.8267 15.8334 12.5117V10.1767L10.2992 12.3058C10.2026 12.3425 10.1017 12.3608 10.0001 12.3608Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M1.66671 13.332C1.20671 13.332 0.833374 13.7054 0.833374 14.1654V15.832C0.833374 16.292 1.20671 16.6654 1.66671 16.6654C2.12671 16.6654 2.50004 16.292 2.50004 15.832V14.1654C2.50004 13.7054 2.12671 13.332 1.66671 13.332Z" fill="#A9B7C7"/></svg>';
?>

<div class="es-user-purchased-courses-area">
    <div class="es-site-container">
        <div class="es-purchased-bar">
            <span class="purchased-label">Purchased</span>
            <a href="#">Start Selling</a>
        </div>

        <div class="es-site-courses-grid">
            <?php
                foreach( $courses_array as $course ) {
                    echo '<div class="es-course-item">';
                        echo '<a href="#">';
                            es_img_with_srcset(
                                $course['img'],
                                $course['img@2x'],
                                $course['title']
                            );
                        echo '</a>';

                        echo '<div class="es-course-details-wrap">';
                            printf(
                                '<a href="%s"><h4>%s</h4></a>',
                                '#',
                                esc_html( es_get_course_title_trimmed($course['title'], 7) )
                            );
                            printf(
                                '<a href="%s"><p>%s</p></a>',
                                '#',
                                esc_html( $course['category'] )
                            );
                            echo '<div class="es-course-price">';
                                echo '<div class="es-course-price-wrap">';
                                    printf('<ins>%s</ins>', $course['currency'] . $course['discounted_price']);
                                    printf('<del>%s</del>', $course['currency'] . $course['original_price']);
                                echo '</div>';
                                echo '<div class="es-course-rating">';

                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="es-course-details">';
                            printf(
                                '<a href="%s"><h4>%s</h4></a>',
                                '#',
                                esc_html( $course['title'] )
                            );
                            printf(
                                '<a href="%s"><p class="es-course-details-category">%s</p></a>',
                                '#',
                                esc_html( $course['category'] )
                            );
                            printf('<p class="es-course-description">%s</p>', esc_html( $course['description'] ));

                            echo '<div class="es-course-meta-data">';
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $lectures_icon . '39 lectures'
                                );
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $duration_icon . '3.5 hours'
                                );
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $level_icon . 'Beginner level'
                                );
                            echo '</div>';

                            printf(
                                '<a href="%s" class="es-add-to-cart-icon">%s</a>',
                                '#',
                                '<span class="es-cart-icon">' . $cart_icon . '</span>' . ' Add to cart'
                            );
                        echo '</div>';

                    echo '</div>';
                }
            ?>
        </div>
    </div>
</div>