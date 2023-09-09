/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other plugins. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

'use strict';

import PropertyComponent from './components/PropertyComponent';
import NewsComponent from './components/NewsComponent';
import FeaturedAgentsComponent from './components/FeaturedAgentsComponent';
import TestimonialsComponent from './components/TestimonialsComponent';
import RealEstateReviewsComponent from './components/RealEstateReviewsComponent';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

vueApp.booting(vue => {
    vue.component('property-component', PropertyComponent);
    vue.component('news-component', NewsComponent);
    vue.component('featured-agents-component', FeaturedAgentsComponent);
    vue.component('testimonials-component', TestimonialsComponent);
    vue.component('real-estate-reviews-component', RealEstateReviewsComponent);

    vue.directive('slick', {
        inserted: function (element) {
            $(element).slick({
                slidesToShow: 3,
                infinite: true,
                rtl: $('body').prop('dir') === 'rtl',
                arrows: false,
                autoplay: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        },
    });
});
