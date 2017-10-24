let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.js([
    'resources/assets/js/core/app.js',
    'resources/assets/js/pages/layout_fixed_custom.js',
    'resources/assets/js/plugins/ui/ripple.min.js'
], 'backend/js/bundle.js')
    .version();

mix.js([
    'resources/assets/js/plugins/forms/styling/switchery.min.js',
    'resources/assets/js/plugins/pickers/datepicker.js',
    'resources/assets/js/plugins/pickers/datepicker.pt_BR.min.js',
    'resources/assets/js/plugins/forms/inputs/duallistbox.min.js',
    'resources/assets/js/plugins/notifications/sweet_alert.min.js',
    'resources/assets/js/plugins/notifications/bootbox.min.js',
    'resources/assets/js/plugins/forms/styling/uniform.min.js',
    'resources/assets/js/plugins/ui/moment/moment.js',
    'resources/assets/js/plugins/forms/mask/inputmask/dist/jquery.inputmask.bundle.js',
    'resources/assets/js/plugins/visualization/jquery.media.js',
], 'backend/js/theme.js')
    .version();

mix.copy('resources/assets/js/plugins/forms/selects/select2/dist/js/select2.min.js','public/backend/js/plugins/select2.min.js');
mix.copy('resources/assets/js/plugins/forms/selects/select2/dist/js/i18n/pt-BR.js','public/backend/js/plugins/select2.pt-BR.js');
mix.copy('resources/assets/js/plugins/forms/validation/validate.min.js','public/backend/js/plugins/jquery.validate.min.js');
mix.copy('resources/assets/js/plugins/forms/validation/additional_methods.min.js','public/backend/js/plugins/additional-methods.min.js');
mix.copy('resources/assets/js/plugins/forms/validation/localization/messages_pt_BR.min.js','public/backend/js/plugins/messages_pt_BR.min.js');
mix.copy('resources/assets/js/plugins/ui/nicescroll.min.js','public/backend/js/plugins/nicescroll.min.js');
mix.copy('resources/assets/js/plugins/tables/datatables/datatables.min.js','public/backend/js/plugins/datatables.min.js');
mix.copy('resources/assets/js/plugins/tables/datatables/extensions/buttons.min.js','public/backend/js/plugins/buttons.min.js');
