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
        }
        else {

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
        }
        else {

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

        }
        else {

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
        }
        else {

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
            }
            else {

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
    let elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function (html) {
        let switchery = new Switchery(html);
    });

    $('table[data-form="deleteForm"]').on('click', '.form-delete', function (e) {
        e.preventDefault();
        let $form = $(this);
        $('#confirm').modal({backdrop: 'static', keyboard: false})
            .on('click', '#delete-btn', function () {
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
    $('.listbox-sec').bootstrapDualListbox({
        nonSelectedListLabel: 'Todas Secretarias',
        selectedListLabel: 'Secretarias Selecionadas',
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
    let validator = $(".form-validate-jquery").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function (error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else {
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
            }

            else {
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

        $(".upper").val(($(".upper").val()).toUpperCase());
    });

    //Fix Datatable Width
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // var target = $(e.target).attr("href"); // activated tab
        // alert (target);
        $($.fn.dataTable.tables(true)).css('width', '100%');
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    });

    //Variável de tradução
    let dt_trans = {
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
    };

    /**
     *
     *   DEPARTAMENTO MODULE
     *
     */
    let departamento = $('#tbl_departamento');
    if (departamento.length) {
        departamento.DataTable({
            serverSide: true,
            processing: true,
            language: dt_trans,
            ajax: '/dashboard/departamento/data',
            columns: [
                {data: 'id', width: '30px'},
                {data: 'descricao'},
                {data: 'action', orderable: false, searchable: false, width: '115px'}
            ]
        });
    }

    /**
     *
     *   TIPO DOCUMENTOS MODULE
     *
     */
    let tipoDocumento = $('#tbl_tp_documento');
    if (tipoDocumento.length) {
        tipoDocumento.DataTable({
            serverSide: true,
            processing: true,
            language: dt_trans,
            ajax: '/dashboard/tipodoc/data',
            columns: [
                {data: 'id', width: '30px'},
                {data: 'descricao'},
                {data: 'action', orderable: false, searchable: false, width: '115px'}
            ]
        });
    }


    /**
     *
     *   DOCUMENTOS MODULE
     *
     */

    //CONTADORES DE STATUS
    function reloadCounters() {
        $.ajax({
            url: '/dashboard/tramitacao/counters',
            type: "GET",
            success: function (data) {
                $('#setor').html(data.noSetor);
                $('#pendente').html(data.pendentes);
                $('#arquivado').html(data.arquivado);
                $('#enviado').html(data.enviados);
            }
        });
    }

    //DASHBOARD TABLE
    let dashboardTbl = $('#tbl_dashboard');
    if (dashboardTbl.length) {
        let oTableDash = dashboardTbl.DataTable({
            dom: "<'row'<'col-xs-12'<'col-xs-12'>>r>" +
            "<'row'<'col-xs-12't>>" +
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            serverSide: true,
            processing: true,
            responsive: true,
            language: dt_trans,
            ajax: '/documentos',
            columns: [
                {data: 'numero', name: 'documentos.numero', width: '80px'},
                {data: 'prioridade', name: 'documentos.prioridade'},
                {data: 'tipo', name: 'tipo_documentos.descricao'},
                {data: 'origem'},
                {data: 'data_doc', name: 'documentos.data_doc', width: '180px'},
                {data: 'action', orderable: false, searchable: false, width: '70px'}
            ],
            rowCallback: function( row, data, dataIndex ) {
                if ( data.prioridade == 3 ) {
                    $('td:eq(1)', row).html( '<span class="label label-danger">ALTA</span>' );
                }else if( data.prioridade == 2 ){
                    $('td:eq(1)', row).html( '<span class="label label-info">MÉDIA</span>' );
                }else if( data.prioridade == 1 ){
                    $('td:eq(1)', row).html( '<span class="label label-success">BAIXA</span>' );
                }
            }
        });

        let tbDashboard = $('table[data-form="tbDashboard"]');

        let title = $('.modal-title');
        let body = $('.modal-body');
        tbDashboard.on('click', '.receber', function (e) {
            e.preventDefault();
            title.html('');
            title.html('Recebimento de documentos');
            $('#title-modal').show();
            $('.despacho').hide();
            let data = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $(this).data('id'),
                action: 'R'
            };
            $('#confirm').modal({backdrop: 'static', keyboard: false})
                .on('click', '#confirm-btn', function () {
                    $.ajax({
                        url: '/dashboard/tramitacao/action',
                        type: "POST",
                        data: data,
                        dataType: "json",
                        success: function () {
                            oTableDash.draw();
                            $('#confirm').modal('hide');
                            reloadCounters();
                        }
                    });
                });
        });
    }

    //DOCUMENTOS NO SETOR
    let documento = $('#tbl_documento');
    if (documento.length) {
        let oTable = documento.DataTable({
            dom: "<'row'<'col-xs-12'<'col-xs-12'>>r>" +
            "<'row'<'col-xs-12't>>" +
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            serverSide: true,
            processing: true,
            responsive: true,
            language: dt_trans,
            ajax: {
                url: '/dashboard/tramitacao/data',
                data: function (d) {
                    d.numero = $('#numero').val();
                    d.ano = $('#ano').val();
                    d.id_tipo_doc = $('#id_tipo_doc').val();
                },
                complete: function () {
                    reloadCounters();
                }
            },
            columns: [
                {data: 'numero', name: 'documentos.numero', width: '80px'},
                {data: 'assunto', name: 'documentos.assunto'},
                {data: 'tipo', name: 'tipo_documentos.descricao'},
                {data: 'origem'},
                {data: 'data_doc', name: 'documentos.data_doc', width: '180px'},
                {data: 'action', orderable: false, searchable: false, width: '165px'}
            ]
        });

        $('#search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    }

    //DOCUMENTOS PENDENTES
    let documentoPend = $('#tbl_doc_pendentes');
    if (documentoPend.length) {
        let oTableP = documentoPend.DataTable({
            dom: "<'row'<'col-xs-12'<'col-xs-12'>>r>" +
            "<'row'<'col-xs-12't>>" +
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            serverSide: true,
            processing: true,
            responsive: true,
            language: dt_trans,
            ajax: {
                url: '/dashboard/tramitacao/pendente',
                data: function (d) {
                    d.numero = $('#numeroPendete').val();
                    d.ano = $('#anoPendente').val();
                },
                complete: function () {
                    reloadCounters();
                }
            },
            columns: [
                {data: 'numero', name: 'documentos.numero', width: '80px'},
                {data: 'assunto', name: 'documentos.assunto'},
                {data: 'tipo', name: 'tipo_documentos.descricao'},
                {data: 'origem'},
                {data: 'data_doc', name: 'documentos.data_doc', width: '180px'},
                {data: 'action', orderable: false, searchable: false, width: '130px'}
            ]
        });

        $('#search-form-pend').on('submit', function (e) {
            oTableP.draw();
            e.preventDefault();
        });

        let tbPendente = $('table[data-form="tbPendente"]');

        tbPendente.on('click', '.receber', function (e) {
            e.preventDefault();
            let docId = $(this).data('id');
            $('#recebimento').modal({backdrop: 'static', keyboard: false})
                .on('click', '#confirm-recebe', function () {
                    $.ajax({
                        url: '/dashboard/tramitacao/action/receber',
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: docId
                        },
                        dataType: "json",
                        success: function () {
                            oTableP.draw();
                            $('#recebimento').modal('hide');
                            reloadCounters();
                        }
                    });
                });
        });

        tbPendente.on('click', '.devolver', function (e) {
            e.preventDefault();
            let docId = $(this).data('id');
            $('#devolucao').modal({backdrop: 'static', keyboard: false})
                .on('click', '#confirm-devolucao', function () {
                    let instance = CKEDITOR.instances['editor'].getData();
                    $.ajax({
                        url: '/dashboard/tramitacao/action/devolver',
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: docId,
                            despacho: instance
                        },
                        dataType: "json",
                        success: function () {
                            oTableP.draw();
                            $('#devolucao').modal('hide');
                            reloadCounters();
                        }
                    });

                });
        });
    }

    //DOCUMENTOS ARQUIVADOS
    let documentoArquiv = $('#tbl_doc_arquivado');
    if (documentoArquiv.length) {
        let oTableA = documentoArquiv.DataTable({
            dom: "<'row'<'col-xs-12'<'col-xs-12'>>r>" +
            "<'row'<'col-xs-12't>>" +
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            serverSide: true,
            processing: true,
            responsive: true,
            language: dt_trans,
            ajax: {
                url: '/dashboard/tramitacao/arquivados',
                data: function (d) {
                    d.numero = $('#numeroArquivado').val();
                    d.ano = $('#anoArquivado').val();
                },
                complete: function () {
                    reloadCounters();
                }
            },
            columns: [
                {data: 'numero', name: 'documentos.numero', width: '80px'},
                {data: 'assunto', name: 'documentos.assunto'},
                {data: 'tipo', name: 'tipo_documentos.descricao'},
                {data: 'origem'},
                {data: 'data_doc', name: 'documentos.data_doc', width: '180px'},
                {data: 'action', orderable: false, searchable: false, width: '130px'}
            ]
        });

        $('#search-form-arquiv').on('submit', function (e) {
            oTableA.draw();
            e.preventDefault();
        });
    }

    //DOCUMENTOS ENVIADOS
    let documentEnviado = $('#tbl_doc_enviado');
    if (documentEnviado.length) {
        let oTableEnv = documentEnviado.DataTable({
            dom: "<'row'<'col-xs-12'<'col-xs-12'>>r>" +
            "<'row'<'col-xs-12't>>" +
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            serverSide: true,
            processing: true,
            responsive: true,
            language: dt_trans,
            ajax: {
                url: '/dashboard/tramitacao/enviados',
                data: function (d) {
                    d.numero = $('#numeroEnviado').val();
                    d.ano = $('#anoEnviado').val();
                },
                complete: function () {
                    reloadCounters();
                }
            },
            columns: [
                {data: 'numero', name: 'documentos.numero', width: '60px'},
                {data: 'assunto', name: 'documentos.assunto'},
                {data: 'tipo', name: 'tipo_documentos.descricao'},
                {data: 'destino'},
                {data: 'data_doc', name: 'documentos.data_doc', width: '180px'},
                {data: 'action', orderable: false, searchable: false, width: '130px'}
            ]
        });

        $('#search-form-enviado').on('submit', function (e) {
            oTableEnv.draw();
            e.preventDefault();
        });
    }


    let getDespacho = $('.despacho');
    getDespacho.on("click", function (e) {
        let tramitacaoId = $(this).data('id');
        let body = $('.modal-body');
        $.ajax({
            url: '/dashboard/tramitacao/despacho',
            type: "GET",
            data: {
                id: tramitacaoId
            },
            dataType: "json",
            success: function (response) {
                body.html('');
                body.html('<div class="well">'+ response.data.despacho +'</div>');
                //alert(response.data);
                $('#modal-despacho').modal({backdrop: 'static', keyboard: false});
            }
        });
    });

    let formDocumento = $('#form_documento');
    if (formDocumento.length) {
        //Modificador de Procedência
        let rdIntExt = $('input:radio[name=int_ext]');
        rdIntExt.change(function () {
            if (this.value === 'I') {
                $('#tipodoc').collapse('hide');
                $('#setdep').collapse('show');
                $('#orgsec').collapse('hide');
                $("select[name=id_departamento]").prop('required', true);
                $("input:radio[name=tipo_tram]").prop('required', false);
                $("select[name=id_secretaria]").prop('required', false);
            }
            else if (this.value === 'E') {
                $('#tipodoc').collapse('show');
                $('#setdep').collapse('hide');
                $('#orgsec').collapse('hide');
                $("select[name=id_departamento]").prop('required', false);
                $("input:radio[name=tipo_tram]").prop('required', true);
                $("select[name=id_secretaria]").prop('required', false);
            }
        });
        //Onload Values
        if ($('input:radio[name=int_ext]:checked').val() === 'I') {
            $('#tipodoc').collapse('hide');
            $('#setdep').collapse('show');
            $('#orgsec').collapse('hide');
            $("select[name=id_departamento]").prop('required', true);
            $("input:radio[name=tipo_tram]").prop('required', false);
            $("select[name=id_secretaria]").prop('required', false);
        }
        else if ($('input:radio[name=int_ext]:checked').val() === 'E') {
            $('#tipodoc').collapse('show');
            $('#setdep').collapse('hide');
            $('#orgsec').collapse('hide');
            $("select[name=id_departamento]").prop('required', false);
            $("input:radio[name=tipo_tram]").prop('required', true);
            $("select[name=id_secretaria]").prop('required', false);
        }

        //Modificador de Tipo de Tramitacao
        let rdTipo = $('input:radio[name=tipo_tram]');
        rdTipo.change(function () {
            if (this.value === 'C') {
                $('#setdep').collapse('show');
                $('#orgsec').collapse('show');
                $("#setdep").insertAfter("#orgsec");
                $("select[name=id_departamento]").prop('required', true);
                $("select[name=id_secretaria]").prop('required', false);
            }
            else if (this.value === 'O') {
                $('#setdep').collapse('show');
                $('#orgsec').collapse('show');
                $("#orgsec").insertAfter("#setdep");
                $("select[name=id_departamento]").prop('required', false);
                $("select[name=id_secretaria]").prop('required', false);
            }
        });
        //Onload Values
        if ($('input:radio[name=tipo_tram]:checked').val() === 'C') {
            $('#setdep').collapse('show');
            $('#orgsec').collapse('show');
            $("select[name=id_departamento]").prop('required', true);
            $("select[name=id_secretaria]").prop('required', false);
        }
        else if ($('input:radio[name=int_ext]:checked').val() === 'S') {
            $('#setdep').collapse('show');
            $('#orgsec').collapse('show');
            $("select[name=id_departamento]").prop('required', false);
            $("select[name=id_secretaria]").prop('required', false);
        }

        let seclist = $('#seclist');
        let tipo_doc = $('select[name="id_tipo_doc"]');

        tipo_doc.on('change',function () {
            if($(this).val() == 11){
                seclist.collapse('show');
                $('#orgsec').collapse('hide');

            }else if($(this).val() == 13){
                seclist.collapse('show');
                $('#orgsec').collapse('hide');
            }else{
                $('.listbox-sec').bootstrapDualListbox('refresh',true);
                seclist.collapse('hide');
                $('#orgsec').collapse('show');
            }
        });

        let btnTram = $('#btn_tramitacao');

        formDocumento.submit(function () {
            if (validator.numberOfInvalids() < 1) {
                btnTram.prop('disabled', true);
            }
        });
    }


    //LOCALIZAR DOCUMENTO NO SISTEMA DE FORMA PUBLICA
    $('#filter-form').on('submit', function (e) {
        e.preventDefault();
        $('#ajaxResponse').collapse('hide');
        $('#table-content').html('');
        $.ajax({
            url: '/dashboard/tramitacao/consulta',
            type: "GET",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if(response.status === 'error'){
                    $('#ajaxResponse').collapse('show');
                    $('#consulta').collapse('hide');
                }else{
                    $('#consulta').collapse('show');
                    $.each(response.data, function(key, value){
                        $('#table-content').append('<tr>' +
                            '<td>'+ value.numero+'/'+ value.ano +'</td>' +
                            '<td>'+ value.tipo_doc +'</td>' +
                            '<td>'+ value.assunto +'</td>' +
                            '<td>'+ value.data_doc +'</td>' +
                            '<td>' +
                            '<a href="/dashboard/tramitacao/'+ value.id+'/consulta"><i class="icon-eye-plus"></i></a>' +
                            '</td>');
                    });
                }
            }
        });
    })


});
