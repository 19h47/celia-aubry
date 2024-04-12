import { Piece } from "piecesjs";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

class Header extends Piece {
	constructor() {
		super("Header");
	}

	mount() {
		ScrollTrigger.create({
			start: "top -96px",
			end: 'max',
			onUpdate: ({ direction }) => {
				if (direction === 1) {
					gsap.to(this, { duration: 0.3, y: -100, ease: "none" });
				} else {
					gsap.to(this, { duration: 0.3, y: 0, ease: "none" });
				}
			},
		});
	}
}

customElements.define("c-header", Header);
