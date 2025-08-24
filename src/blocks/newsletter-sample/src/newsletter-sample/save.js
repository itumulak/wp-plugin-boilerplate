import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function save({attributes}) {
	const { title, showTitle, description, showDescription } = attributes;

	return (
		<div { ...useBlockProps.save() }>
			{ showTitle && <h2>{ title }</h2> }
			{ showDescription && <p>{ description }</p> }
			<form>
				<input
					id="newsletter-email"
					name="newsletter_email"
					type="email"
					placeholder={__('Email', 'newsletter-sample')}
					required
				/>
				<button type="submit">
					{ __('Subscribe', 'newsletter-sample') }
				</button>
			</form>
		</div>
	);
}
