// my-plugin/src/my-awesome-block/index.jsx
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import './assets/style.scss'; // Block frontend styles
import './assets/editor.scss'; // Block editor-specific styles

const Edit = () => {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<h1>{ __( 'My Awesome Block', 'my-plugin-textdomain' ) }</h1>
			<p>{ __( 'Hello from a Vite & React powered block!', 'my-plugin-textdomain' ) }</p>
		</div>
	);
};

const Save = () => {
	const blockProps = useBlockProps.save();
	return (
		<div { ...blockProps }>
			<p>{ __( 'Hello from the saved block!', 'my-plugin-textdomain' ) }</p>
		</div>
	);
};

registerBlockType( 'my-plugin/my-awesome-block', {
	apiVersion: 2,
	title: __( 'My Awesome Block', 'my-plugin-textdomain' ),
	icon: 'star',
	category: 'widgets',
	edit: Edit,
	save: Save,
} );