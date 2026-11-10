import { Piece } from "piecesjs";

const offset = 96;

class Header extends Piece {
	constructor() {
		super("Header");
	}

	mount() {
		this.scrollY = window.scrollY;
		this.on("scroll", window, this.handleScroll);
	}

	unmount() {
		this.off("scroll", window, this.handleScroll);
	}

	handleScroll() {
		const { scrollY } = window;
		const hidden = scrollY > offset && scrollY > this.scrollY;

		this.classList.toggle("is-hidden", hidden);
		this.scrollY = scrollY;
	}
}

customElements.define("c-header", Header);
