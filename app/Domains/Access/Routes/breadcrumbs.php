<?php


/**
 * Usuários
 */
Breadcrumbs::register('admin.users', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Usuários', route('admin.users'));
});
Breadcrumbs::register('admin.users.add', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push('Novo', route('admin.users.create'));
});
Breadcrumbs::register('admin.users.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push('Editar', '');
});



/**
 * Roles
 */
Breadcrumbs::register('admin.roles', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Perfis de Acesso', route('admin.roles'));
});
Breadcrumbs::register('admin.roles.add', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push('Novo', route('admin.roles.create'));
});
Breadcrumbs::register('admin.roles.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push('Editar', '');
});



/**
 * Auditor
 */
Breadcrumbs::register('admin.auditor', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Auditoria e Logs', route('admin.auditor'));
});

/**
 * Auditor
 */
Breadcrumbs::register('admin.account', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('Configurações de Conta', route('admin.account'));
});