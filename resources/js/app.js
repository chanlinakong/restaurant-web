import './bootstrap';

import Alpine from 'alpinejs';

import cartStore from './cartStore';

import menuCarousel from './menu-carousel';


Alpine.data(
    'menuCarousel',
    menuCarousel
);


window.Alpine = Alpine;


Alpine.store(
    'cart',
    cartStore
);


Alpine.start();