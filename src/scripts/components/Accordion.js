import { Piece } from 'piecesjs'
import A from '@19h47/accordion';

class Accordion extends Piece {
	constructor() {
		super('Accordion');
	}

	mount() {
		this.accordion = new A(this);
		this.accordion.init();
	}
}

customElements.define('c-accordion', Accordion);
