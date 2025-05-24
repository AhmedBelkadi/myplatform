import '../css/app.css';
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import 'select2';
import 'select2/dist/css/select2.css';

// Initialisation de Select2
$(document).ready(function() {
    $('#permissions').select2(); // Sélecteur pour le champ des permissions
});