<?php namespace GetUpKid\ReapitForms\Facades;

use Illuminate\Support\Facades\Facade;

class ReapitForm extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'form';
    }
}
