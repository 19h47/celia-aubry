/* global celiaaubry */
import { Piece } from "piecesjs";

class LoadPosts extends Piece {
	constructor() {
		super("LoadPosts");

		this.postType = this.getAttribute("data-post-type") || "post";
		this.orderby = this.getAttribute("data-orderby") || "post__in";
	}

	mount() {
		this.on("click", this.$("[data-filter]"), this.handleClick);
	}

	unmount() {
		this.off("click", this.$("[data-filter]"), this.handleClick);
	}

	async load() {
		this.locked();

		const response = await this.fetch();
		const data = await response.json();

		this.insert(data);
		this.unlocked();
	}

	fetch() {
		const url = new URL(celiaaubry.ajax_url);

		const params = {
			action: this.getAttribute("data-action") || "load_posts",
			nonce: celiaaubry.nonce,
			postsPerPage: JSON.parse(this.getAttribute("data-posts-per-page")) || 6,
			postType: this.postType,
			orderby: this.orderby,
		};

		if (this.term_id) {
			params.filters = JSON.stringify([{ taxonomy: this.taxonomy, term_id: this.term_id }]);
		}

		Object.keys(params).forEach((key) => url.searchParams.append(key, params[key]));

		return fetch(url);
	}

	handleClick({ target }) {
		this.taxonomy = target.getAttribute("data-taxonomy");
		this.term_id = target.value;

		this.$("[data-filter]").forEach(($filter) => $filter.classList.remove("is-active"));

		target.classList.add("is-active");
	}

	insert({ html }) {
		if (!html) {
			return;
		}

		this.$("[data-container]")[0].innerHTML = JSON.parse(html);
	}

	locked() {
		this.$("[data-container]")[0].classList.add("opacity-50");
	}

	unlocked() {
		this.$("[data-container]")[0].classList.remove("opacity-50");
		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	set term_id(value) {
		this.setAttribute("term_id", value);
	}

	get term_id() {
		return this.getAttribute("term_id");
	}

	static get observedAttributes() {
		return ["term_id"];
	}

	attributeChangedCallback(name) {
		if ("term_id" === name) {
			this.load();
		}
	}
}

customElements.define("c-load-posts", LoadPosts);
