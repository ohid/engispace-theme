<?php 

// Exit if accessed directly
if ( !ABSPATH ) exit;

$top_nav = [
    [
        'title' => 'votes',
        'number' => 12,
        'active' => true
    ],
    [
        'title' => 'answers',
        'number' => 3,
    ],
    [
        'title' => 'viwes',
        'number' => 432,
    ],
    [
        'title' => 'bookmarks',
        'number' => 1,
    ]
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

