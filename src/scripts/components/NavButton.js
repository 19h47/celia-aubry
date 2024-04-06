import { Piece } from 'piecesjs'

export class NavButton extends Piece {
	constructor() {
		super('NavButton');
	}

	mount() {
		this.on('click', this, this.handleClick)
	}

	handleClick() {
		this.classList.toggle('is-active');
		this.call('toggle', {}, 'Nav');
	}
}

customElements.define('c-nav-button', NavButton);
