import { Piece } from 'piecesjs'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

class Scroll extends Piece {
	constructor() {
		super('Scroll');
	}

	mount() {
		let mm = gsap.matchMedia();

		mm.add("(min-width: 1280px)", () => {
			gsap.to(this, {
				yPercent: -50,
				ease: "none",
				scrollTrigger: {
					trigger: this.parentElement,
					scrub: true
				},
			});
		});

	}
}

customElements.define('c-scroll', Scroll);
