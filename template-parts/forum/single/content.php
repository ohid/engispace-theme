<?php 

// Exit if accessed directly
if ( !ABSPATH ) exit;

?>

<div class="es-forum-single-content-wrapper">
    <div class="es-content-area">
        <div class="es-content-title">
            <h3>Why does altering my managed bean's definition result in the constructor not being called?</h3>
        </div>
        <div class="es-content-entry">
            <p>I have a problem masking a phone input with jQuery and Masked Input Plugin.
            There are 2 possible formats:</p>
            <pre><code>(XX)XXXX-XXXX
(XX)XXXXX-XXXX</code></pre>
            <p>Is there any way to mask it accepting both cases? <br>
EDIT:<br>
I tried:</p>
<pre><code>$("#phone").mask("(99) 9999-9999"); 
$("#telf1").mask("(99) 9999*-9999");    
$("#telf1").mask("(99) 9999?-9999"); </code></pre>
    <p>But it doesn't works as I would like.<br>
The closest one was (xx)xxxx-xxxxx.<br>
I would like to get (xx)xxxx-xxxx when I type the 10th number, and (xx)xxxxx-xxxx when I type the 11th. Is it posible?</p>
        </div>
        <div class="es-content-comments">
            <ul>
                <li>
                    <span class="es-comment-comment">JHispa: please edit your answer, instead of adding code as a comment</span> -
                    <span class="es-comment-author">
                        <a href="#">Andre</a>
                    </span>
                    <span class="comment-date">
                        Jul 24 '12 at 15:06 
                    </span>
                </li>
                <li>
                    <span class="es-comment-comment">JHispa: please edit your answer, instead of adding code as a comment</span> -
                    <span class="es-comment-author">
                        <a href="#">Andre</a>
                    </span>
                    <span class="comment-date">
                        Jul 24 '12 at 15:06 
                    </span>
                </li>
                <li>
                    <span class="es-comment-comment">JHispa: please edit your answer, instead of adding code as a comment</span> -
                    <span class="es-comment-author">
                        <a href="#">Andre</a>
                    </span>
                    <span class="comment-date">
                        Jul 24 '12 at 15:06 
                    </span>
                </li>
                <li class="more-comments">
                    <a href="#">View more comments</a>
                </li>
            </ul>
            <div class="post-comment">
                <span class="es-author-img"><img src="<?php echo es_user_profile_avatar(); ?>" alt=""></span>
                <form action="">
                    <textarea name="comment" id="comment" placeholder="Write a comment"></textarea>
                    <button type="submit">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
    <div class="es-content-sidebar">
        <div class="es-forum-post-author">
            <div class="es-fpa-name">
                <span><img src="<?php echo es_user_profile_avatar(); ?>" alt=""></span>
                <a href="#">John Doe</a>
            </div>
            <div class="es-fpa-author-info">
                <ul>
                    <li><span>Engispace reputation:</span> 280</li>
                    <li><span>Position:</span> Senior Electrical Engineer</li>
                    <li><span>Company:</span> Google</li>
                </ul>
            </div>
            <div class="es-fpa-categories">
                <ul>
                    <li><a href="#">PHP</a></li>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">jQuery</a></li>
                </ul>
            </div>
            <div class="es-fpa-posted-date">
                <span>Posted: 24 Jul, 2024</span>
            </div>
        </div>
    </div>
</div>