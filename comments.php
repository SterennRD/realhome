<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf( _nx( '1 réponse', '%1$s réponses', get_comments_number(), 'comments title', 'twentythirteen' ),
                number_format_i18n( get_comments_number() ) );
            ?>
        </h2>

        <ul class="comment-list">
            <?php wp_list_comments( 'type=comment&callback=mytheme_comment' ); ?>
        </ul>


        <?php
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentythirteen' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentythirteen' ) ); ?></div>
            </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php
    $comment_args = array(
        'label_submit'      => __( 'Envoyer' ),

        'comment_field' =>  '<p class="comment-form-comment"><textarea class="comment-textarea" id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="Votre message">' .
            '</textarea></p>',

        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
    );
    comment_form($comment_args); ?>

</div><!-- #comments -->