<div
	id="newsletter-sample"
	data-wp-interactive="newsletter-sample"
	<?php echo get_block_wrapper_attributes(); ?>
>
	<?php if ($attributes['showTitle']): ?>
		<h2><?php echo esc_html($attributes['title']); ?></h2>
	<?php endif; ?>
	<?php if ($attributes['showDescription']): ?>
		<p><?php echo esc_html($attributes['description']); ?></p>
	<?php endif; ?>

	<div data-wp-bind--hidden="state.complete">
		<input id="newsletter-sample-email" name="newsletter_sample_email" type="email" placeholder="Email" required>
		<button data-wp-on--click="actions.handleSubmit" type="button">Subscribe</button>
	</div>

	<div data-wp-bind--hidden="!state.complete">
		<p>✅ Thank you for signing up!</p>
	</div>
</div>
