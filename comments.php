<?php

/**

 * The template for displaying Comments

 *

 * The area of the page that contains comments and the comment form.

 */



/*

 * If the current post is protected by a password and the visitor has not yet

 * entered the password we will return early without loading the comments.

 */

if ( post_password_required() ) {

	return;

}

?>

<div id="comments" class="comments-area with_background overflow-hidden with_padding big-padding">



	<?php if ( have_comments() ) : ?>

        <h3 class="comments-title"><?php esc_html_e( 'Opiniones', 'Diftinto' ); ?></h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">

				<?php dotdigital_paging_comments_nav(); ?>

			</nav><!-- #comment-nav-above -->

		<?php endif; // Check for comment navigation. ?>



		<ol class="comment-list">

			<?php

			wp_list_comments( array(

				'walker'      => dotdigital_return_comments_walker(),

				'style'       => 'ol',

				'short_ping'  => true,

				'avatar_size' => 90,

			) );

			?>

		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">

				<?php dotdigital_paging_comments_nav(); ?>

			</nav><!-- #comment-nav-below -->

		<?php endif; // Check for comment navigation. ?>

	<?php endif; // have_comments() ?>

		<?php if ( ! comments_open() ) : ?>

			<p class="no-comments"><?php esc_html_e( 'Los comentarios estan cerrados', 'Diftinto' ); ?></p>

		<?php endif; //comments_open() ?>

		<?php

		//fields are hooked in inc/hooks.php

		if ( have_comments() ) {

			$title_reply = sprintf( _n( 'Un Comentario en este tema', '%1$s Comentarios en este tema', get_comments_number(), 'Diftinto' ), number_format_i18n( get_comments_number() ) );

		} else {

			$title_reply = esc_html__( '¿ Y tú que opinas?', 'Difitinto' );

		}

		$args = array(

			'comment_field'        => is_user_logged_in() ? '<div class="col-sm-12"><div class="form-group comment-form-comment"><label for="comment">' . _x( 'Tu Opinión', 'noun', 'Diftinto' ) . '</label> <textarea id="comment"  class="form-control" name="comment" cols="45" rows="5"  aria-required="true" required="required"></textarea></div></div>' : '',

			'logged_in_as'         => '<div class="col-sm-12 darklinks"><p class="logged-in-as">' .

			                          sprintf(

			                          /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */

				                          '<a href="%1$s" aria-label="%2$s">' . esc_html__( 'Registrado como %3$s', 'Diftinto' ) . '</a>. <a href="%4$s">' . esc_html__( 'Terminar Sesión', 'dotdigital' ) . '</a>',

				                          get_edit_user_link(),

				                          /* translators: %s: user name */

				                          esc_attr( sprintf( esc_html__( 'Registrado como %s. Edit your profile.', 'dotdigital' ), $user_identity ) ),

				                          $user_identity,

				                          wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) )

			                          ) . '</p></div>',

			'comment_notes_before' => wp_kses_post( '<p class="pre-text">Tu correo electrónico no sera publicado. Mil gracias por tu opión </p>' ),

			'class_form'           => 'comment-form row columns_padding_10',

			'cancel_reply_link'    => esc_html__( 'Cancelar Respuesta', 'dotdigital' ),

			'label_submit'         => esc_html__( 'Enviar', 'Diftinto' ),

			'title_reply'          => $title_reply,

			'title_reply_before'   => '<h3>',

			'title_reply_after'    => '</h3>',

			'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="theme_button wide_button large_height color1 %3$s" value="%4$s" /><input type="reset" id="reset_%2$s" class="theme_button wide_button inverse color1 large_height" value="' . esc_html__( 'Limpiar Formulario', 'Diftinto' ) . '" />',

			'submit_field'         => '<div class="col-sm-12"><p class="form-submit text-left">%1$s %2$s</p></div>',

			'format'               => 'html5',

		);



		comment_form( $args ); ?>

</div><!-- #comments -->