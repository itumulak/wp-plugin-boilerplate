import { store } from '@wordpress/interactivity';

const { state } = store('newsletter-sample', {
	state: {
		complete: false,
		loading: false,
		error: null,
	},
	actions: {
		handleSubmit: async() => {
			state.loading = true;

			const email = document.getElementById('newsletter-sample-email').value;

			try {
				const response = await fetch(
					'/wp-json/itumulak/v1/newsletter', {
						method: 'POST',
						body: JSON.stringify({ email }),
						headers: {
							'Content-type': "application/json; charset=UTF-8"
						}
					}
				);

				if ( response.ok ) {
					state.complete = true;
				} else {
					throw new Error('Subscription failed. Please try again.');
				}
			} catch (error) {
				console.log(error);
				state.error = 'Subscription failed. Please try again.';
			} finally {
				state.loading = false;
			}
		},
	},
});
