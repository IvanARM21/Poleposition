import { } from './swiper.js';
import { loadPerfilButtons } from './perfil.js';
import { LoadMenuBtn } from './menu.js';
import { validacionLogin } from './validacion.js';
import { loadVehicles } from './catalogo.js';
import { loadBuy } from './comprar.js';
import { loadInput } from './search.js';
import { } from './modalPerfil.js';

addEventListener("DOMContentLoaded", () => {
    loadPerfilButtons();
    LoadMenuBtn();
    validacionLogin();
    loadVehicles();

    loadBuy();
    loadInput();
});
