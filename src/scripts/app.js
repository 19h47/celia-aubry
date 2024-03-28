import { load } from 'piecesjs';

import.meta.glob('../img/**/*');

load('c-add', () => import(`/src/scripts/components/Add.js`));
