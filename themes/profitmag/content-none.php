<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ProfitMag
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nada Encontrado', 'profitmag' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Preparado para publicar sua primeira postagem? <a href="%1$s">Comece aqui</a>.', 'profitmag' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Desculpe, mas nada foi encontrado em seus termos de pesquisa. Por favor, tente novamente com palavras-chave diferentes.', 'profitmag' ); ?></p>
			

		<?php else : ?>

			<p><?php _e( 'Parece que nós não podemos encontrar o que você está buscando. Tente buscar mais uma vez.', 'profitmag' ); ?></p>
			

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
