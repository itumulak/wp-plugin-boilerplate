<div
    id="newsletter-sample"
    data-wp-interactivity="newsletter-sample"
    <?php echo get_block_wrapper_attributes(); ?>
>
	<?php if ($attributes['showTitle']): ?>
		<h2><?php echo $attributes['title']; ?></h2>
	<?php endif; ?>
	<?php if ($attributes['showDescription']): ?>
		<p><?php echo $attributes['description']; ?></p>
	<?php endif; ?>

	<div data-wp-bind--hidden="state.complete">
		<input id="newsletter-sample-email" name="newsletter_sample_email" type="email" placeholder="Email" required>
		<button data-wp-on--click="actions.handleSubmit" type="submit">Subscribe</button>
	</div>

	<div data-wp-bind--hidden="!state.complete">
		<p>✅ Thank you for signing up!</p>
	</div>

	<?php if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) : ?>
		<!-- DEBUG: Newsletter block rendered, interactivity attribute set -->
	<?php endif; ?>
</div>
