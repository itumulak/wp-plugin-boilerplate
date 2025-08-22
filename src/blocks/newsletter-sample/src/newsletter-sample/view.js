import { store } from '@wordpress/interactivity';

const { state } = store('newsletter-sample', {
	state: {
		complete: false,
	},
	actions: {
		handleSubmit: () => {
			console.log('form submitted');
			state.complete = true;
		},
	},
});
