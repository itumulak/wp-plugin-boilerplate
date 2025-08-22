import { store } from '@wordpress/interactivity';

console.log('Newsletter sample view.js loaded ✅');

store('newsletter-sample', {
	state: {
		complete: false
	},
	actions: {
		handleSubmit: ({state}) => {
			console.log('form submitted');
			state.complete = true;
		}
	}
});
