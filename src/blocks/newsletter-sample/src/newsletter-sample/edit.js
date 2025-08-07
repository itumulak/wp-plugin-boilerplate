import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	TextareaControl,
	ToggleControl,
	Button
} from "@wordpress/components";
import { useState } from '@wordpress/element';

import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	try {
		const { title, showTitle, description, showDescription } = attributes;
		const [email, setEmail] = useState('');

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Settings', 'newsletter-sample')}>
						<ToggleControl
							checked={!!showTitle}
							label={__('Show title', 'newsletter-sample')}
							onChange={(value) => setAttributes({ showTitle: value })}
						/>
						{showTitle && (
							<TextControl
								label={__('Title', 'newsletter-sample')}
								value={title || 'Subscribe to our Newsletter'}
								onChange={(value) => setAttributes({ title: value })}
							/>
						)}

						<ToggleControl
							checked={!!showDescription}
							label={__('Show description', 'newsletter-sample')}
							onChange={(value) => setAttributes({ showDescription: value })}
						/>
						{showDescription && (
							<TextareaControl
								label={__('Description', 'newsletter-sample')}
								placeholder={ __('Add description here...', 'newsletter-sample') }
								value={description || 'Sign up to our newsletter and get the latest news.'}
								onChange={(value) => setAttributes({ description: value })}
							/>
						)}
					</PanelBody>
				</InspectorControls>

				<div {...useBlockProps()}>
					{showTitle && <h2>{__(title, 'newsletter-sample')}</h2>}
					{showDescription && <p>{__(description, 'newsletter-sample')}</p>}
					<TextControl type="email" placeholder="Enter your email address" onChange={(e) => setEmail(e.target.value)} />
					<Button variant="primary">Subscribe</Button>
				</div>
			</>
		);
	} catch (error) {
		console.error('Block render error:', error);
		return (
			<div {...useBlockProps()} style={{ color: 'red' }}>
				Error loading block. Check console for details.
			</div>
		);
	}
}
