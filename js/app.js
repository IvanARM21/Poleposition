import { } from './swiper.js';
import { loadPerfilButtons } from './perfil.js';
import { LoadMenuBtn } from './menu.js';
import { validacionLogin } from './validacion.js';

addEventListener("DOMContentLoaded", () => {
    loadPerfilButtons();
    LoadMenuBtn();
    validacionLogin();
});
