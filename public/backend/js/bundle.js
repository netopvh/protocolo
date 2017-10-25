/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/core/app.js":
/***/ (function(module, exports) {

/* ------------------------------------------------------------------------------
*
*  # Template JS core
*
*  Core JS file with default functionality configuration
*
*  Version: 1.2
*  Latest update: Dec 11, 2015
*
* ---------------------------------------------------------------------------- */

// Allow CSS transitions when page is loaded
$(window).on('load', function () {
    $('body').removeClass('no-transitions');
});

$(function () {

    // Disable CSS transitions on page load
    $('body').addClass('no-transitions');

    // ========================================
    //
    // Content area height
    //
    // ========================================


    // Calculate min height
    function containerHeight() {
        var availableHeight = $(window).height() - $('.page-container').offset().top - $('.navbar-fixed-bottom').outerHeight();

        $('.page-container').attr('style', 'min-height:' + availableHeight + 'px');
    }

    // Initialize
    containerHeight();

    // ========================================
    //
    // Heading elements
    //
    // ========================================


    // Heading elements toggler
    // -------------------------

    // Add control button toggler to page and panel headers if have heading elements
    $('.panel-footer').has('> .heading-elements:not(.not-collapsible)').prepend('<a class="heading-elements-toggle"><i class="icon-more"></i></a>');
    $('.page-title, .panel-title').parent().has('> .heading-elements:not(.not-collapsible)').children('.page-title, .panel-title').append('<a class="heading-elements-toggle"><i class="icon-more"></i></a>');

    // Toggle visible state of heading elements
    $('.page-title .heading-elements-toggle, .panel-title .heading-elements-toggle').on('click', function () {
        $(this).parent().parent().toggleClass('has-visible-elements').children('.heading-elements').toggleClass('visible-elements');
    });
    $('.panel-footer .heading-elements-toggle').on('click', function () {
        $(this).parent().toggleClass('has-visible-elements').children('.heading-elements').toggleClass('visible-elements');
    });

    // Breadcrumb elements toggler
    // -------------------------

    // Add control button toggler to breadcrumbs if has elements
    $('.breadcrumb-line').has('.breadcrumb-elements').prepend('<a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>');

    // Toggle visible state of breadcrumb elements
    $('.breadcrumb-elements-toggle').on('click', function () {
        $(this).parent().children('.breadcrumb-elements').toggleClass('visible-elements');
    });

    // ========================================
    //
    // Navbar
    //
    // ========================================


    // Navbar navigation
    // -------------------------

    // Prevent dropdown from closing on click
    $(document).on('click', '.dropdown-content', function (e) {
        e.stopPropagation();
    });

    // Disabled links
    $('.navbar-nav .disabled a').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Show tabs inside dropdowns
    $('.dropdown-content a[data-toggle="tab"]').on('click', function (e) {
        $(this).tab('show');
    });

    // ========================================
    //
    // Element controls
    //
    // ========================================


    // Reload elements
    // -------------------------

    // Panels
    $('.panel [data-action=reload]').click(function (e) {
        e.preventDefault();
        var block = $(this).parent().parent().parent().parent().parent();
        $(block).block({
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #ddd'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

        // For demo purposes
        window.setTimeout(function () {
            $(block).unblock();
        }, 2000);
    });

    // Sidebar categories
    $('.category-title [data-action=reload]').click(function (e) {
        e.preventDefault();
        var block = $(this).parent().parent().parent().parent();
        $(block).block({
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.5,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #000'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none',
                color: '#fff'
            }
        });

        // For demo purposes
        window.setTimeout(function () {
            $(block).unblock();
        }, 2000);
    });

    // Light sidebar categories
    $('.sidebar-default .category-title [data-action=reload]').click(function (e) {
        e.preventDefault();
        var block = $(this).parent().parent().parent().parent();
        $(block).block({
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #ddd'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

        // For demo purposes
        window.setTimeout(function () {
            $(block).unblock();
        }, 2000);
    });

    // Collapse elements
    // -------------------------

    //
    // Sidebar categories
    //

    // Hide if collapsed by default
    $('.category-collapsed').children('.category-content').hide();

    // Rotate icon if collapsed by default
    $('.category-collapsed').find('[data-action=collapse]').addClass('rotate-180');

    // Collapse on click
    $('.category-title [data-action=collapse]').click(function (e) {
        e.preventDefault();
        var $categoryCollapse = $(this).parent().parent().parent().nextAll();
        $(this).parents('.category-title').toggleClass('category-collapsed');
        $(this).toggleClass('rotate-180');

        containerHeight(); // adjust page height

        $categoryCollapse.slideToggle(150);
    });

    //
    // Panels
    //

    // Hide if collapsed by default
    $('.panel-collapsed').children('.panel-heading').nextAll().hide();

    // Rotate icon if collapsed by default
    $('.panel-collapsed').find('[data-action=collapse]').addClass('rotate-180');

    // Collapse on click
    $('.panel [data-action=collapse]').click(function (e) {
        e.preventDefault();
        var $panelCollapse = $(this).parent().parent().parent().parent().nextAll();
        $(this).parents('.panel').toggleClass('panel-collapsed');
        $(this).toggleClass('rotate-180');

        containerHeight(); // recalculate page height

        $panelCollapse.slideToggle(150);
    });

    // Remove elements
    // -------------------------

    // Panels
    $('.panel [data-action=close]').click(function (e) {
        e.preventDefault();
        var $panelClose = $(this).parent().parent().parent().parent().parent();

        containerHeight(); // recalculate page height

        $panelClose.slideUp(150, function () {
            $(this).remove();
        });
    });

    // Sidebar categories
    $('.category-title [data-action=close]').click(function (e) {
        e.preventDefault();
        var $categoryClose = $(this).parent().parent().parent().parent();

        containerHeight(); // recalculate page height

        $categoryClose.slideUp(150, function () {
            $(this).remove();
        });
    });

    // ========================================
    //
    // Main navigation
    //
    // ========================================


    // Main navigation
    // -------------------------

    // Add 'active' class to parent list item in all levels
    $('.navigation').find('li.active').parents('li').addClass('active');

    // Hide all nested lists
    $('.navigation').find('li').not('.active, .category-title').has('ul').children('ul').addClass('hidden-ul');

    // Highlight children links
    $('.navigation').find('li').has('ul').children('a').addClass('has-ul');

    // Add active state to all dropdown parent levels
    $('.dropdown-menu:not(.dropdown-content), .dropdown-menu:not(.dropdown-content) .dropdown-submenu').has('li.active').addClass('active').parents('.navbar-nav .dropdown:not(.language-switch), .navbar-nav .dropup:not(.language-switch)').addClass('active');

    // Main navigation tooltips positioning
    // -------------------------

    // Left sidebar
    $('.navigation-main > .navigation-header > i').tooltip({
        placement: 'right',
        container: 'body'
    });

    // Collapsible functionality
    // -------------------------

    // Main navigation
    $('.navigation-main').find('li').has('ul').children('a').on('click', function (e) {
        e.preventDefault();

        // Collapsible
        $(this).parent('li').not('.disabled').not($('.sidebar-xs').not('.sidebar-xs-indicator').find('.navigation-main').children('li')).toggleClass('active').children('ul').slideToggle(250);

        // Accordion
        if ($('.navigation-main').hasClass('navigation-accordion')) {
            $(this).parent('li').not('.disabled').not($('.sidebar-xs').not('.sidebar-xs-indicator').find('.navigation-main').children('li')).siblings(':has(.has-ul)').removeClass('active').children('ul').slideUp(250);
        }
    });

    // Alternate navigation
    $('.navigation-alt').find('li').has('ul').children('a').on('click', function (e) {
        e.preventDefault();

        // Collapsible
        $(this).parent('li').not('.disabled').toggleClass('active').children('ul').slideToggle(200);

        // Accordion
        if ($('.navigation-alt').hasClass('navigation-accordion')) {
            $(this).parent('li').not('.disabled').siblings(':has(.has-ul)').removeClass('active').children('ul').slideUp(200);
        }
    });

    // ========================================
    //
    // Sidebars
    //
    // ========================================


    // Mini sidebar
    // -------------------------

    // Toggle mini sidebar
    $('.sidebar-main-toggle').on('click', function (e) {
        e.preventDefault();

        // Toggle min sidebar class
        $('body').toggleClass('sidebar-xs');
    });

    // Sidebar controls
    // -------------------------

    // Disable click in disabled navigation items
    $(document).on('click', '.navigation .disabled a', function (e) {
        e.preventDefault();
    });

    // Adjust page height on sidebar control button click
    $(document).on('click', '.sidebar-control', function (e) {
        containerHeight();
    });

    // Hide main sidebar in Dual Sidebar
    $(document).on('click', '.sidebar-main-hide', function (e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-main-hidden');
    });

    // Toggle second sidebar in Dual Sidebar
    $(document).on('click', '.sidebar-secondary-hide', function (e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-secondary-hidden');
    });

    // Hide detached sidebar
    $(document).on('click', '.sidebar-detached-hide', function (e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-detached-hidden');
    });

    // Hide all sidebars
    $(document).on('click', '.sidebar-all-hide', function (e) {
        e.preventDefault();

        $('body').toggleClass('sidebar-all-hidden');
    });

    //
    // Opposite sidebar
    //

    // Collapse main sidebar if opposite sidebar is visible
    $(document).on('click', '.sidebar-opposite-toggle', function (e) {
        e.preventDefault();

        // Opposite sidebar visibility
        $('body').toggleClass('sidebar-opposite-visible');

        // If visible
        if ($('body').hasClass('sidebar-opposite-visible')) {

            // Make main sidebar mini
            $('body').addClass('sidebar-xs');

            // Hide children lists
            $('.navigation-main').children('li').children('ul').css('display', '');
        } else {

            // Make main sidebar default
            $('body').removeClass('sidebar-xs');
        }
    });

    // Hide main sidebar if opposite sidebar is shown
    $(document).on('click', '.sidebar-opposite-main-hide', function (e) {
        e.preventDefault();

        // Opposite sidebar visibility
        $('body').toggleClass('sidebar-opposite-visible');

        // If visible
        if ($('body').hasClass('sidebar-opposite-visible')) {

            // Hide main sidebar
            $('body').addClass('sidebar-main-hidden');
        } else {

            // Show main sidebar
            $('body').removeClass('sidebar-main-hidden');
        }
    });

    // Hide secondary sidebar if opposite sidebar is shown
    $(document).on('click', '.sidebar-opposite-secondary-hide', function (e) {
        e.preventDefault();

        // Opposite sidebar visibility
        $('body').toggleClass('sidebar-opposite-visible');

        // If visible
        if ($('body').hasClass('sidebar-opposite-visible')) {

            // Hide secondary
            $('body').addClass('sidebar-secondary-hidden');
        } else {

            // Show secondary
            $('body').removeClass('sidebar-secondary-hidden');
        }
    });

    // Hide all sidebars if opposite sidebar is shown
    $(document).on('click', '.sidebar-opposite-hide', function (e) {
        e.preventDefault();

        // Toggle sidebars visibility
        $('body').toggleClass('sidebar-all-hidden');

        // If hidden
        if ($('body').hasClass('sidebar-all-hidden')) {

            // Show opposite
            $('body').addClass('sidebar-opposite-visible');

            // Hide children lists
            $('.navigation-main').children('li').children('ul').css('display', '');
        } else {

            // Hide opposite
            $('body').removeClass('sidebar-opposite-visible');
        }
    });

    // Keep the width of the main sidebar if opposite sidebar is visible
    $(document).on('click', '.sidebar-opposite-fix', function (e) {
        e.preventDefault();

        // Toggle opposite sidebar visibility
        $('body').toggleClass('sidebar-opposite-visible');
    });

    // Mobile sidebar controls
    // -------------------------

    // Toggle main sidebar
    $('.sidebar-mobile-main-toggle').on('click', function (e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-mobile-main').removeClass('sidebar-mobile-secondary sidebar-mobile-opposite sidebar-mobile-detached');
    });

    // Toggle secondary sidebar
    $('.sidebar-mobile-secondary-toggle').on('click', function (e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-mobile-secondary').removeClass('sidebar-mobile-main sidebar-mobile-opposite sidebar-mobile-detached');
    });

    // Toggle opposite sidebar
    $('.sidebar-mobile-opposite-toggle').on('click', function (e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-mobile-opposite').removeClass('sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-detached');
    });

    // Toggle detached sidebar
    $('.sidebar-mobile-detached-toggle').on('click', function (e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-mobile-detached').removeClass('sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-opposite');
    });

    // Mobile sidebar setup
    // -------------------------

    $(window).on('resize', function () {
        setTimeout(function () {
            containerHeight();

            if ($(window).width() <= 768) {

                // Add mini sidebar indicator
                $('body').addClass('sidebar-xs-indicator');

                // Place right sidebar before content
                $('.sidebar-opposite').insertBefore('.content-wrapper');

                // Place detached sidebar before content
                $('.sidebar-detached').insertBefore('.content-wrapper');

                // Add mouse events for dropdown submenus
                $('.dropdown-submenu').on('mouseenter', function () {
                    $(this).children('.dropdown-menu').addClass('show');
                }).on('mouseleave', function () {
                    $(this).children('.dropdown-menu').removeClass('show');
                });
            } else {

                // Remove mini sidebar indicator
                $('body').removeClass('sidebar-xs-indicator');

                // Revert back right sidebar
                $('.sidebar-opposite').insertAfter('.content-wrapper');

                // Remove all mobile sidebar classes
                $('body').removeClass('sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-detached sidebar-mobile-opposite');

                // Revert left detached position
                if ($('body').hasClass('has-detached-left')) {
                    $('.sidebar-detached').insertBefore('.container-detached');
                }

                // Revert right detached position
                else if ($('body').hasClass('has-detached-right')) {
                        $('.sidebar-detached').insertAfter('.container-detached');
                    }

                // Remove visibility of heading elements on desktop
                $('.page-header-content, .panel-heading, .panel-footer').removeClass('has-visible-elements');
                $('.heading-elements').removeClass('visible-elements');

                // Disable appearance of dropdown submenus
                $('.dropdown-submenu').children('.dropdown-menu').removeClass('show');
            }
        }, 100);
    }).resize();

    // ========================================
    //
    // Other code
    //
    // ========================================


    // Plugins
    // -------------------------

    // Popover
    $('[data-popup="popover"]').popover();

    // Tooltip
    $('[data-popup="tooltip"]').tooltip();

    //Select2
    $('.select').select2({
        minimumResultsForSearch: Infinity
    });

    // Select with search
    $('.select-search').select2();

    // Default initialization
    $(".styled, .multiselect-container input").uniform({
        radioClass: 'choice'
    });

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        language: 'pt-BR'
    });

    // Primary file input
    $(".file-styled-primary").uniform({
        fileButtonClass: 'action btn bg-blue',
        fileButtonHtml: 'Selecione os Arquivos',
        fileDefaultHtml: 'Nenhum arquivo foi selecionado'
    });

    //
    // Contextual colors
    //

    // Primary
    $(".control-primary").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-primary-600 text-primary-800'
    });

    // Danger
    $(".control-danger").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-danger-600 text-danger-800'
    });

    // Success
    $(".control-success").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-success-600 text-success-800'
    });

    // Warning
    $(".control-warning").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-warning-600 text-warning-800'
    });

    // Info
    $(".control-info").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-info-600 text-info-800'
    });

    // Styled file input
    $(".file-styled").uniform({
        fileButtonClass: 'action btn bg-blue'
    });

    // Switchery toggles
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });

    $('table[data-form="deleteForm"]').on('click', '.form-delete', function (e) {
        e.preventDefault();
        var $form = $(this);
        $('#confirm').modal({ backdrop: 'static', keyboard: false }).on('click', '#delete-btn', function () {
            $form.submit();
        });
    });

    // Basic example
    $('.listbox').bootstrapDualListbox({
        nonSelectedListLabel: 'Todas Permissões',
        selectedListLabel: 'Permissões Selecionadas',
        filterPlaceHolder: 'Pesquisar',
        moveAllLabel: 'Mover Tudo',
        removeAllLabel: 'Remover Tudo',
        infoText: 'Mostrando todos os {0}',
        infoTextEmpty: 'Lista Vazia'
    });

    // Multiple selection
    $('.listbox-no-selection').bootstrapDualListbox({
        preserveSelectionOnMove: 'moved',
        moveOnSelect: false
    });

    // Setup validation
    // ------------------------------

    // Initialize
    var validator = $(".form-validate-jquery").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function highlight(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function unhighlight(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function errorPlacement(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                } else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo(element.parent().parent().parent());
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                        error.appendTo(element.parent());
                    }

                    // Inline checkboxes, radios
                    else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                            error.appendTo(element.parent().parent());
                        }

                        // Input group, styled file input
                        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                                error.appendTo(element.parent().parent());
                            } else {
                                error.insertAfter(element);
                            }
        },
        validClass: "validation-valid-label",
        rules: {
            password: {
                minlength: 5
            },
            repeat_password: {
                equalTo: "#password"
            },
            email: {
                email: true
            },
            repeat_email: {
                equalTo: "#email"
            },
            minimum_characters: {
                minlength: 10
            },
            maximum_characters: {
                maxlength: 10
            },
            minimum_number: {
                min: 10
            },
            maximum_number: {
                max: 10
            },
            number_range: {
                range: [10, 20]
            },
            url: {
                url: true
            },
            date: {
                date: true
            },
            date_iso: {
                dateISO: true
            },
            numbers: {
                number: true
            },
            digits: {
                digits: true
            },
            creditcard: {
                creditcard: true
            },
            basic_checkbox: {
                minlength: 2
            },
            styled_checkbox: {
                minlength: 2
            },
            switchery_group: {
                minlength: 2
            },
            switch_group: {
                minlength: 2
            },
            documentos: {
                required: true,
                extension: "pdf|doc|docx"
            }
        }
    });

    // Reset form
    $('#reset').on('click', function () {
        validator.resetForm();
    });

    $('.textarea').ckeditor();

    $(".upper").bind('keyup', function (e) {
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            // I have tried setting those
            e.keyCode = newKey;
            e.charCode = newKey;
        }

        $(".upper").val($(".upper").val().toUpperCase());
    });

    //Variável de tradução
    var dt_trans = {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }

        /**
        *
        *   DEPARTAMENTO MODULE
        *
        */
    };var departamento = $('#tbl_departamento');
    if (departamento.length) {
        departamento.DataTable({
            serverSide: true,
            processing: true,
            language: dt_trans,
            ajax: '/dashboard/departamento/data',
            columns: [{ data: 'id', width: '30px' }, { data: 'descricao' }, { data: 'action', orderable: false, searchable: false, width: '115px' }]
        });
    }

    /**
    *
    *   TIPO DOCUMENTOS MODULE
    *
    */
    var tipoDocumento = $('#tbl_tp_documento');
    if (tipoDocumento.length) {
        tipoDocumento.DataTable({
            serverSide: true,
            processing: true,
            language: dt_trans,
            ajax: '/dashboard/tipodoc/data',
            columns: [{ data: 'id', width: '30px' }, { data: 'descricao' }, { data: 'action', orderable: false, searchable: false, width: '115px' }]
        });
    }

    /**
    *
    *   DOCUMENTOS MODULE
    *
    */
    var documento = $('#tbl_documento');
    if (documento.length) {
        var oTable = documento.DataTable({
            dom: "<'row'<'col-xs-12'<'col-xs-12'l>>r>" + "<'row'<'col-xs-12't>>" + "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            serverSide: true,
            processing: true,
            language: dt_trans,
            ajax: {
                url: '/dashboard/documento/data',
                data: function data(d) {
                    d.numero = $('#numero').val();
                    d.ano = $('#ano').val();
                    d.id_tipo_doc = $('#id_tipo_doc').val();
                }
            },
            columns: [{ data: 'numero', name: 'documentos.numero', width: '80px' }, { data: 'ano', name: 'documentos.ano', width: '100px' }, { data: 'assunto', name: 'documentos.assunto' }, { data: 'tipo', name: 'tipo_documentos.descricao' }, { data: 'data_doc', name: 'documentos.data_doc', width: '180px' }, { data: 'action', orderable: false, searchable: false, width: '130px' }]
        });

        $('#search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    }

    var formDocumento = $('#form_documento');
    if (formDocumento.length) {
        //Changed Value dropdown
        $('input:radio[name=int_ext]').change(function () {
            if (this.value === 'I') {
                $('#setdep').collapse('show');
                $('#orgsec').collapse('hide');
                $("select[name=id_departamento]").prop('required', true);
                $("select[name=id_secretaria]").prop('required', false);
            } else if (this.value === 'E') {
                $('#setdep').collapse('hide');
                $('#orgsec').collapse('show');
                $("select[name=id_departamento]").prop('required', false);
                $("select[name=id_secretaria]").prop('required', true);
            }
        });
        //Onload Values
        if ($('input:radio[name=int_ext]:checked').val() === 'N') {
            $('#nomenclaturacargo').collapse('show');
            $("input[name=nomenclatura_id]").prop('required', true);
        } else if ($('input:radio[name=int_ext]:checked').val() === 'S') {
            $('#nomenclaturacargo').collapse('hide');
            $("input[name=nomenclatura_id]").prop('required', false);
        }
    }

    var linkFile = $('button.file');
    var docs = $('iframe.docs-show');

    linkFile.click(function () {
        docs.attr("href", "");
        docs.attr("src", $(this).data("url"));
    });
});

/***/ }),

/***/ "./resources/assets/js/pages/layout_fixed_custom.js":
/***/ (function(module, exports) {

/* ------------------------------------------------------------------------------
*
*  # Sticky sidebar with custom scrollbar
*
*  Specific JS code additions for layout_sidebar_sticky_custom.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function () {

    // Mini sidebar
    // -------------------------

    // Setup
    function miniSidebar() {
        if ($('body').hasClass('sidebar-xs')) {
            $('.sidebar-main.sidebar-fixed .sidebar-content').on('mouseenter', function () {
                if ($('body').hasClass('sidebar-xs')) {

                    // Expand fixed navbar
                    $('body').removeClass('sidebar-xs').addClass('sidebar-fixed-expanded');
                }
            }).on('mouseleave', function () {
                if ($('body').hasClass('sidebar-fixed-expanded')) {

                    // Collapse fixed navbar
                    $('body').removeClass('sidebar-fixed-expanded').addClass('sidebar-xs');
                }
            });
        }
    }

    // Initialize
    miniSidebar();

    // Toggle mini sidebar
    $('.sidebar-main-toggle').on('click', function (e) {

        // Initialize mini sidebar 
        miniSidebar();
    });

    // Nice scroll
    // ------------------------------

    // Setup
    function initScroll() {
        $(".sidebar-fixed .sidebar-content").niceScroll({
            mousescrollstep: 100,
            cursorcolor: '#ccc',
            cursorborder: '',
            cursorwidth: 3,
            hidecursordelay: 100,
            autohidemode: 'scroll',
            horizrailenabled: false,
            preservenativescrolling: false,
            railpadding: {
                right: 0.5,
                top: 1.5,
                bottom: 1.5
            }
        });
    }

    // Remove
    function removeScroll() {
        $(".sidebar-fixed .sidebar-content").getNiceScroll().remove();
        $(".sidebar-fixed .sidebar-content").removeAttr('style').removeAttr('tabindex');
    }

    // Initialize
    initScroll();

    // Remove scrollbar on mobile
    $(window).on('resize', function () {
        setTimeout(function () {
            if ($(window).width() <= 768) {

                // Remove nicescroll on mobiles
                removeScroll();
            } else {

                // Init scrollbar
                initScroll();
            }
        }, 100);
    }).resize();
});

/***/ }),

/***/ "./resources/assets/js/plugins/ui/ripple.min.js":
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/* ------------------------------------------------------------------------------
*
*  # LegitRipple
*
* ---------------------------------------------------------------------------- */

!function (t) {
	t.fn.ripple = function (e) {
		if (this.length > 1) return this.each(function (n, i) {
			t(i).ripple(e);
		});if (e = e || {}, this.off(".ripple").data("unbound", !0), e.unbind) return this;var n = function n() {
			return d && !d.data("unbound");
		};this.addClass("legitRipple").removeData("unbound").on("tap.ripple", function (e) {
			n() || (d = t(this), w(e.coords));
		}).on("dragstart.ripple", function (t) {
			g.allowDragging || t.preventDefault();
		}), t(document).on("move.ripple", function (t) {
			n() && b(t.coords);
		}).on("end.ripple", function () {
			n() && y();
		}), t(window).on("scroll.ripple", function (t) {
			n() && y();
		});var i,
		    o,
		    a,
		    r,
		    s = function s(t) {
			return !!t.type.match(/^touch/);
		},
		    l = function l(t, e) {
			return s(t) && (t = c(t.originalEvent.touches, e)), [t.pageX, t.pageY];
		},
		    c = function c(e, n) {
			return t.makeArray(e).filter(function (t, e) {
				return t.identifier == n;
			})[0];
		},
		    p = 0,
		    u = function u(t) {
			"touchstart" == t.type && (p = 3), "scroll" == t.type && (p = 0);var e = p && !s(t);return e && p--, !e;
		};this.on("mousedown.ripple touchstart.ripple", function (e) {
			u(e) && (i = s(e) ? e.originalEvent.changedTouches[0].identifier : -1, o = t(this), a = t.Event("tap", { coords: l(e, i) }), ~i ? r = setTimeout(function () {
				o.trigger(a), r = null;
			}, g.touchDelay) : o.trigger(a));
		}), t(document).on("mousemove.ripple touchmove.ripple mouseup.ripple touchend.ripple touchcancel.ripple", function (e) {
			var n = e.type.match(/move/);r && !n && (clearTimeout(r), r = null, o.trigger(a)), u(e) && (s(e) ? c(e.originalEvent.changedTouches, i) : !~i) && t(this).trigger(n ? t.Event("move", { coords: l(e, i) }) : "end");
		}).on("contextmenu.ripple", function (t) {
			u(t);
		}).on("touchmove", function () {
			clearTimeout(r), r = null;
		});var d,
		    f,
		    h,
		    m,
		    g = {},
		    v = 0,
		    x = function x() {
			var n = { fixedPos: null, get dragging() {
					return !g.fixedPos;
				}, get adaptPos() {
					return g.dragging;
				}, get maxDiameter() {
					return Math.sqrt(Math.pow(h[0], 2) + Math.pow(h[1], 2)) / d.outerWidth() * Math.ceil(g.adaptPos ? 100 : 200) + "%";
				}, scaleMode: "fixed", template: null, allowDragging: !1, touchDelay: 100, callback: null };t.each(n, function (t, n) {
				g[t] = t in e ? e[t] : n;
			});
		},
		    w = function w(e) {
			h = [d.outerWidth(), d.outerHeight()], x(), m = e, f = t("<span/>").addClass("legitRipple-ripple"), g.template && f.append(("object" == _typeof(g.template) ? g.template : d.children(".legitRipple-template").last()).clone().removeClass("legitRipple-template")).addClass("legitRipple-custom"), f.appendTo(d), D(e, !1);var n = f.css("transition-duration").split(","),
			    i = [parseFloat(n[0]) + "s"].concat(n.slice(1)).join(",");f.css("transition-duration", i).css("width", g.maxDiameter), f.on("transitionend webkitTransitionEnd oTransitionEnd", function () {
				t(this).data("oneEnded") ? t(this).off().remove() : t(this).data("oneEnded", !0);
			});
		},
		    b = function b(t) {
			var e;if (v++, "proportional" === g.scaleMode) {
				var n = Math.pow(v, v / 100 * .6);e = n > 40 ? 40 : n;
			} else if ("fixed" == g.scaleMode && Math.abs(t[1] - m[1]) > 6) return void y();D(t, e);
		},
		    y = function y() {
			f.css("width", f.css("width")).css("transition", "none").css("transition", "").css("width", f.css("width")).css("width", g.maxDiameter).css("opacity", "0"), d = null, v = 0;
		},
		    D = function D(e, n) {
			var i = [],
			    o = g.fixedPos === !0 ? [.5, .5] : [(g.fixedPos ? g.fixedPos[0] : e[0] - d.offset().left) / h[0], (g.fixedPos ? g.fixedPos[1] : e[1] - d.offset().top) / h[1]],
			    a = [.5 - o[0], .5 - o[1]],
			    r = [100 / parseFloat(g.maxDiameter), 100 / parseFloat(g.maxDiameter) * (h[1] / h[0])],
			    s = [a[0] * r[0], a[1] * r[1]],
			    l = g.dragging || 0 === v;if (l && "inline" == d.css("display")) {
				var c = t("<span/>").text("Hi!").css("font-size", 0).prependTo(d),
				    p = c.offset().left;c.remove(), i = [e[0] - p + "px", e[1] - d.offset().top + "px"];
			}l && f.css("left", i[0] || 100 * o[0] + "%").css("top", i[1] || 100 * o[1] + "%"), f.css("transform", "translate3d(-50%, -50%, 0)" + (g.adaptPos ? "translate3d(" + 100 * s[0] + "%, " + 100 * s[1] + "%, 0)" : "") + (n ? "scale(" + n + ")" : "")), g.callback && g.callback(d, f, o, g.maxDiameter);
		};return this;
	}, t.ripple = function (e) {
		t.each(e, function (e, n) {
			t(e).ripple(n);
		});
	}, t.ripple.destroy = function () {
		t(".legitRipple").removeClass("legitRipple").add(window).add(document).off(".ripple"), t(".legitRipple-ripple").remove();
	};
}(jQuery);

// Initialization
// ------------------------------

$(function () {

	// Ripple effect
	$(".btn:not(.disabled):not(.multiselect.btn-default):not(.bootstrap-select .btn-default):not(.file-drag-handle), .navigation li:not(.disabled) a, .nav > li:not(.disabled) > a, .sidebar-user-material-menu > a, .sidebar-user-material-content > a, .select2-selection--single[class*=bg-], .breadcrumb-elements > li:not(.disabled) > a, .wizard > .actions a, .ui-button:not(.ui-dialog-titlebar-close), .ui-tabs-anchor:not(.ui-state-disabled), .plupload_button:not(.plupload_disabled), .fc-button, .pagination > li:not(.disabled) > a, .pagination > li:not(.disabled) > span, .pager > li:not(.disabled) > a, .pager > li:not(.disabled) > span").ripple({
		dragging: false,
		adaptPos: false,
		scaleMode: false
	});

	// Unbind ripple in Datepaginator
	$('.dp-item, .dp-nav, .sidebar-xs .sidebar-main .navigation > li > a').ripple({ unbind: true });

	$(document).on('click', '.sidebar-control', function () {
		if ($('body').hasClass('sidebar-xs')) {
			$('.sidebar-main .navigation > li > a').ripple({ unbind: true });
		} else {
			$('.sidebar-main .navigation > li > a').ripple({ unbind: false });
		}
	});
});

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/core/app.js");
__webpack_require__("./resources/assets/js/pages/layout_fixed_custom.js");
module.exports = __webpack_require__("./resources/assets/js/plugins/ui/ripple.min.js");


/***/ })

/******/ });