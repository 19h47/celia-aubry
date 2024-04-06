import { Piece } from 'piecesjs'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

class Header extends Piece {
	constructor() {
		super('Header');
	}

	mount() {
		const body = document.body;

		ScrollTrigger.create({
			trigger: body,
			start: 'top -96px',
			onUpdate: self => {
				if (self.direction === 1) {
					gsap.to(this, { duration: 0.3, y: -100 });
				} else {
					gsap.to(this, { duration: 0.3, y: 0 });
				}
			},
			onLeaveBack: () => {
				gsap.to(this, { duration: 0.3, y: 0 });
			},
		});

	}
}

customElements.define('c-header', Header);
