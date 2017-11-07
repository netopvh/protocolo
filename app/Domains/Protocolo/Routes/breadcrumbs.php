<?php

/**
 * Departamentos
 */
Breadcrumbs::register('admin.departamento', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Departamentos', route('admin.departamento'));
});
Breadcrumbs::register('admin.departamento.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.departamento');
    $breadcrumbs->push('Novo', route('admin.departamento.create'));
});
Breadcrumbs::register('admin.departamento.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.departamento');
    $breadcrumbs->push('Editar', '');
});




/**
 * Tipo de Documento
 */
Breadcrumbs::register('admin.tipo_documento', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Tipos de Documentos', route('admin.tipo_documento'));
});
Breadcrumbs::register('admin.tipo_documento.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tipo_documento');
    $breadcrumbs->push('Novo', route('admin.tipo_documento.create'));
});
Breadcrumbs::register('admin.tipo_documento.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tipo_documento');
    $breadcrumbs->push('Editar', '');
});



/**
 * Tipo de Documento
 */
Breadcrumbs::register('admin.documento', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Documentos', route('admin.documento'));
});
Breadcrumbs::register('admin.documento.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.documento');
    $breadcrumbs->push('Novo', route('admin.documento.create'));
});
Breadcrumbs::register('admin.documento.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.documento');
    $breadcrumbs->push('Editar', '');
});
Breadcrumbs::register('admin.documento.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.documento');
    $breadcrumbs->push('Exibir', '');
});



/**
 * Secretarias
 */
Breadcrumbs::register('admin.secretarias', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Secretarias', route('admin.secretarias'));
});

Breadcrumbs::register('admin.secretarias.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.secretarias');
    $breadcrumbs->push('Novo', route('admin.secretarias.create'));
});

Breadcrumbs::register('admin.secretarias.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.secretarias');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.secretarias.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.secretarias');
    $breadcrumbs->push('Exibir', '');
});



/**
 * Tramitação
 */
Breadcrumbs::register('admin.tramitacao', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Tramitação', route('admin.tramitacao'));
});
Breadcrumbs::register('admin.tramitacao.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tramitacao');
    $breadcrumbs->push('Novo', route('admin.documento.create'));
});
Breadcrumbs::register('admin.tramitacao.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tramitacao');
    $breadcrumbs->push('Editar', '');
});
Breadcrumbs::register('admin.tramitacao.doc.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tramitacao');
    $breadcrumbs->push('Documento', '');
});

Breadcrumbs::register('admin.tramitacao.movimentar', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tramitacao');
    $breadcrumbs->push('Movimentar', '');
});