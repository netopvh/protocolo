<?php
// Home

Breadcrumbs::register('admin.home', function ($breadcrumbs) {
    $breadcrumbs->push('Início', route('admin.home'));
});