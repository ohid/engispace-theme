<div class="es-forum-answers-section">
    <div class="es-forum-answers">
        <div class="es-comment-title">2 Answers</div>
        <div class="es-forum-answers-list">
            <div class="es-forum-answer">
                <div class="es-answer-reputation"></div>
                <div class="es-answer-content">
                    <div class="es-answer-author">
                        <span class="es-author-img"><img src="<?php echo es_user_profile_avatar(); ?>" alt=""></span>
                        <div class="es-right">
                            <span class="es-author-name"><a href="#">John Doe</a></span>
                            <span class="es-posted-date">July 24, 2023</span>
                        </div>
                    </div>
                    <div class="es-answer-text">
                        <p>Yes, it is possible. You can use the following code to achieve that:</p>
                    </div>
                </div>
            </div>

            <div class="es-forum-answer">
                <div class="es-answer-reputation"></div>
                <div class="es-answer-content">
                    <div class="es-answer-author">
                        <span class="es-author-img"><img src="<?php echo es_user_profile_avatar(); ?>" alt=""></span>
                        <div class="es-right">
                            <span class="es-author-name"><a href="#">John Doe</a></span>
                            <span class="es-posted-date">July 24, 2023</span>
                        </div>
                    </div>
                    <div class="es-answer-text">
                        <pre><code>$("#phone").mask("(99) 9999?9-9999");
$("#phone").on("blur", function() {
    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );
    if( last.length == 3 ) {
        var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
        var lastfour = move + last;
        var first = $(this).val().substr( 0, 9 );

        $(this).val( first + '-' + lastfour );
    }
});</code></pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="es-form-post-answer">
            <div class="es-comment-title">
                Your answer
            </div>
            <div class="es-post-answer-editor" id="es-post-answer-editor">
            </div>
            <div class="es-post-answer-submit">
                <button class="es-btn-orange"><?php esc_html_e( 'Post your answer', 'engispace-theme' ); ?></button>
            </div>
        </div>
    </div>
    <div class="es-forum-answers-sidebar">
        <div class="es-forum-related-questions">
            <div class="es-sidebar-title">
                <h4>Related questions</h4>
            </div>
        </div>
        <div class="es-forum-related-questions-list">
            <ul>
                <li>
                    <span class="es-post-answers">0</span><a href="#">How to create a custom WordPress theme?</a>
                </li>
                <li>
                    <span class="es-post-answers">0</span><a href="#">How to create a custom WordPress theme?</a>
                </li>
                <li>
                    <span class="es-post-answers">0</span><a href="#">How to create a custom WordPress theme?</a>
                </li>
                <li>
                    <span class="es-post-answers">0</span><a href="#">How to create a custom WordPress theme?</a>
                </li>
            </ul>
        </div>
    </div>
</div>