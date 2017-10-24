<?php

/**
 * Cargos Comissionados
 */
Breadcrumbs::register('admin.comissionados', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Cargos Comissionados', route('admin.comissionados'));
});

Breadcrumbs::register('admin.comissionados.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.comissionados');
    $breadcrumbs->push('Novo', route('admin.comissionados.create'));
});

Breadcrumbs::register('admin.comissionados.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.comissionados');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.comissionados.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.comissionados');
    $breadcrumbs->push('Exibir', '');
});




/**
 * Grau de Instrução
 */
Breadcrumbs::register('admin.instrucao', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Grau de Instrução', route('admin.instrucao'));
});

Breadcrumbs::register('admin.instrucao.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.instrucao');
    $breadcrumbs->push('Novo', route('admin.instrucao.create'));
});

Breadcrumbs::register('admin.instrucao.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.instrucao');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.instrucao.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.instrucao');
    $breadcrumbs->push('Exibir', '');
});




/**
 * Nomenclatura Cargo
 */
Breadcrumbs::register('admin.nomenclatura', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Nomenclatura de Cargo', route('admin.nomenclatura'));
});

Breadcrumbs::register('admin.nomenclatura.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.nomenclatura');
    $breadcrumbs->push('Novo', route('admin.nomenclatura.create'));
});

Breadcrumbs::register('admin.nomenclatura.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.nomenclatura');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.nomenclatura.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.nomenclatura');
    $breadcrumbs->push('Exibir', '');
});




/**
 * Regime de Trabalho
 */
Breadcrumbs::register('admin.regime', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Regime de Trabalho', route('admin.regime'));
});

Breadcrumbs::register('admin.regime.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.regime');
    $breadcrumbs->push('Novo', route('admin.regime.create'));
});

Breadcrumbs::register('admin.regime.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.regime');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.regime.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.regime');
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
 * Tipos de Cargos
 */
Breadcrumbs::register('admin.cargos', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Tipos de Cargos', route('admin.cargos'));
});

Breadcrumbs::register('admin.cargos.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.cargos');
    $breadcrumbs->push('Novo', route('admin.cargos.create'));
});

Breadcrumbs::register('admin.cargos.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.cargos');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.cargos.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.cargos');
    $breadcrumbs->push('Exibir', '');
});




/**
 * Linhas de Ônibus
 */
Breadcrumbs::register('admin.linhas', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Linhas de Ônibus', route('admin.linhas'));
});

Breadcrumbs::register('admin.linhas.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.linhas');
    $breadcrumbs->push('Novo', route('admin.linhas.create'));
});

Breadcrumbs::register('admin.linhas.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.linhas');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.linhas.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.linhas');
    $breadcrumbs->push('Exibir', '');
});




/**
 * Servidores
 */
Breadcrumbs::register('admin.servidores', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Servidores', route('admin.servidores'));
});

Breadcrumbs::register('admin.servidores.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.servidores');
    $breadcrumbs->push('Novo', route('admin.servidores.create'));
});

Breadcrumbs::register('admin.servidores.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.servidores');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('admin.servidores.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.servidores');
    $breadcrumbs->push('Exibir', '');
});


/**
 * Validação
 */
Breadcrumbs::register('admin.validacao', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Validações', route('admin.validacao'));
});

Breadcrumbs::register('admin.validacao.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.validacao');
    $breadcrumbs->push('Validar Servidor', '');
});