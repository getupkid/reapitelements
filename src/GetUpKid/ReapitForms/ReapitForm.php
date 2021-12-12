<?php namespace GetUpKid\ReapitForms;

class ReapitForm
{
    protected $builder;
    protected $basicFormBuilder;

    public function __construct(ReapitFormBuilder $basicFormBuilder)
    {
        $this->basicFormBuilder = $basicFormBuilder;
    }

    public function open()
    {
        $this->builder = $this->basicFormBuilder;
        return $this->builder->open();
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->builder, $method], $parameters);
    }
}
