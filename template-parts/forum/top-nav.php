<?php 

// Exit if accessed directly
if ( !ABSPATH ) exit;

// Get and update view count
$answer_count = es_get_question_answer_count();
$view_count = es_get_question_view_count();

$top_nav = [
    // [
    //     'title' => 'votes',
    //     'number' => 12,
    //     'active' => true
    // ],
    [
        'title' => 'answers',
        'number' => $answer_count,
    ],
    [
        'title' => 'views',
        'number' => $view_count,
    ],
    // [
    //     'title' => 'bookmarks',
    //     'number' => 1,
    // ]
];

?>

<div class="es-forum-top-nav">
    <ul>
        <?php
            foreach ( $top_nav as $nav ) {
                $active = $nav['active'] ? 'active' : '';
                echo sprintf( '<li class="es-top-nav-item %s"><strong>%s</strong> %s</li>', $active, $nav['number'], $nav['title'] );
            }
        ?>
    </ul>
</div>

