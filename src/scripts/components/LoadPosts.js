/* global celiaaubry */
import { Piece } from 'piecesjs'

class LoadPosts extends Piece {
	constructor() {
		super('LoadPosts');

		this.postType = this.getAttribute('data-post-type') || 'post';
		this.orderby = this.getAttribute('data-orderby') || 'post__in';
	}

	mount() {
		this.on('click', this.$('[data-filter]'), this.load);
	}

	unmount() {
		this.off('click', this.$('[data-filter]'), this.load);
	}

	async load({ target }) {
		this.$('[data-filter]').forEach($filter => $filter.classList.remove('is-active'));

		target.classList.add('is-active');

		this.locked();

		const response = await this.fetch();
		const data = await response.json();

		this.insert(data);
		this.unlocked();
	}

	fetch() {
		const url = new URL(celiaaubry.ajax_url);

		const params = {
			action: this.getAttribute('data-action') || 'load_posts',
			nonce: celiaaubry.nonce,
			postsPerPage: JSON.parse(this.getAttribute('data-posts-per-page')) || 6,
			postType: this.postType,
			orderby: this.orderby,
		};

		if (this.filters().length) {
			params.filters = JSON.stringify(this.filters());
		}

		Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

		return fetch(url);
	}

	filters() {
		const filters = [];

		this.$('[data-filter]').forEach(filter => {
			if (
				filter.value &&
				'BUTTON' === filter.tagName &&
				filter.classList.contains('is-active')
			) {
				filters.push({ taxonomy: filter.getAttribute('data-taxonomy', filter), term_id: filter.value });
			}
		});

		return filters;
	}

	insert({ html }) {
		if (!html) {
			return;
		}

		this.$('[data-container]')[0].innerHTML = JSON.parse(html);
	}

	locked() {
		this.$('[data-container]')[0].classList.add('opacity-50');
	}

	unlocked() {
		this.$('[data-container]')[0].classList.remove('opacity-50');
	}
}

customElements.define('c-load-posts', LoadPosts);
