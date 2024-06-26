import { Piece } from "piecesjs";
import { gsap } from "gsap";
import { disableScroll, enableScroll } from "../utils/scroll";

export class Nav extends Piece {
	constructor() {
		super("Nav");
	}

	toggle() {
		if (this.log) {
			console.log("Nav.toggle()", this.value);
		}

		this.value = !JSON.parse(this.value);
	}

	open() {
		// console.log('Nav.open()')

		this.classList.add("is-active");
		gsap.to(this, { autoAlpha: 1, duration: 0.3, ease: "power1.inOut" });

		// When Nav is open, disableScroll
		disableScroll();
	}

	close() {
		// console.log('Nav.close()')

		this.classList.remove("is-active");
		gsap.to(this, { autoAlpha: 0, duration: 0.3, ease: "power1.inOut" });

		// When Nav is closed, enableScroll
		enableScroll();
	}

	set value(value) {
		this.setAttribute("value", value);
	}

	get value() {
		return this.getAttribute("value");
	}

	static get observedAttributes() {
		return ["value"];
	}

	attributeChangedCallback(name, oldValue, newValue) {
		if (this.log) {
			console.log(`Attribute ${name} has been changed. From ${oldValue} to ${newValue}`);
		}

		if (JSON.parse(newValue) === false) {
			return this.close();
		}

		if (JSON.parse(newValue) === true) {
			return this.open();
		}
	}
}

customElements.define("c-nav", Nav);
