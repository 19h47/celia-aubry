import { Piece } from 'piecesjs'
import { gsap } from 'gsap'
import { disableScroll, enableScroll } from '../utils/scroll';


export class Nav extends Piece {
	constructor() {
		super('Nav');
	}

	toggle() {
		console.log('Nav.toggle()', this.value);
		this.value = !JSON.parse(this.value)
	}

	open() {
		// console.log('Nav.open()')

		this.classList.add('is-active');
		gsap.to(this, { autoAlpha: 1 });

		// When Nav is open, disableScroll
		disableScroll();
	}

	close() {
		// console.log('Nav.close()')

		this.classList.remove('is-active');
		gsap.to(this, { autoAlpha: 0 });

		// When Nav is closed, enableScroll
		enableScroll();
	}

	set value(value) {
		this.setAttribute('value', value);
	}

	get value() {
		return this.getAttribute('value');
	}

	static get observedAttributes() {
		return ['value'];
	}

	attributeChangedCallback(name, oldValue, newValue) {
		console.log(`Attribute ${name} has changed. From ${oldValue} to ${newValue}`);

		if (JSON.parse(newValue) === false) {
			return this.close();
		}

		if (JSON.parse(newValue) === true) {
			return this.open();
		}
	}
}

customElements.define('c-nav', Nav);
