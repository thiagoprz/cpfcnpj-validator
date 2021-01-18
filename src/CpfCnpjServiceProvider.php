<?php

namespace Thiagoprz\CpfCnpjValidator;

use Illuminate\Support\ServiceProvider;


class CpfCnpjServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/lang/', 'cpfcnpj-validator');
        $message = trans('validation.cpfcnpj') != 'validation.cpfcnpj' ? trans('validation.cpfcnpj') : trans('cpf-validator::validation.cpfcnpj');
        Validator::extend('cpfcnpj', 'Thiagoprz\CpfCnpjValidator\CpfCnpj@passes', $message);
    }
}

