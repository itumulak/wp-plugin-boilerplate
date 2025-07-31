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
} from "@wordpress/components";

import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	try {
		const { title, showTitle, description, showDescription } = attributes;

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
								value={title || ''}
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
								value={description || ''}
								onChange={(value) => setAttributes({ description: value })}
							/>
						)}
					</PanelBody>
				</InspectorControls>

				<div {...useBlockProps()}>
					{__('Newsletter Sample – hello from the editor!', 'newsletter-sample')}
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
