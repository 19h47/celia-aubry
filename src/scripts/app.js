import { load } from 'piecesjs';

import.meta.glob('../img/**/*');

load('c-load-posts', () => import(`/src/scripts/components/LoadPosts.js`));
load('c-scroll', () => import(`/src/scripts/components/Scroll.js`));
load('c-header', () => import(`/src/scripts/components/Header.js`));
load('c-nav', () => import(`/src/scripts/components/Nav.js`));
load('c-nav-button', () => import(`/src/scripts/components/NavButton.js`));
load('c-accordion', () => import(`/src/scripts/components/Accordion.js`));
