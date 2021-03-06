<?php namespace GetUpKid\ReapitForms;

use GetUpKid\ReapitForms\Elements\CheckGroup;
use GetUpKid\ReapitForms\Elements\FormGroup;
use GetUpKid\ReapitForms\Elements\GroupWrapper;
// use GetUpKid\ReapitForms\Elements\HelpBlock;
use GetUpKid\ReapitForms\Elements\InputGroup;
use AdamWathan\Form\FormBuilder;

class ReapitFormBuilder
{
    protected $builder;

    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    protected function formGroup($label, $name, $control)
    {
        $label = $this->builder->label($label)->addClass('el-label')->forId($name);
        $control->id($name);

        $formGroup = new FormGroup($label, $control);

        if ($this->builder->hasError($name)) {
            $formGroup->helpBlock($this->builder->getError($name));
            $formGroup->addClass('has-error');
        }

        return $this->wrap($formGroup);
    }

    protected function wrap($group)
    {
        return new GroupWrapper($group);
    }

    public function text($label, $name, $value = null)
    {
        $control = $this->builder->text($name)->value($value)->addClass('el-input');

        return $this->formGroup($label, $name, $control);
    }

    public function password($label, $name)
    {
        $control = $this->builder->password($name)->addClass('el-input');

        return $this->formGroup($label, $name, $control);
    }

    public function button($value, $name = null, $type = 'el-intent-primary')
    {
        return $this->builder->button($value, $name)->addClass('el-button')->addClass($type);
    }

    public function submit($value = 'Submit', $type = 'el-intent-primary')
    {
        return $this->builder->submit($value)->addClass('el-button')->addClass($type);
    }

    public function select($label, $name, $options = [])
    {
        $control = $this->builder->select($name, $options)->addClass('el-select');

        return $this->formGroup($label, $name, $control);
    }

    public function checkbox($label, $name)
    {
        $control = $this->builder->checkbox($name)->addClass('el-input');

        return $this->checkGroup($label, $name, $control);
    }

    public function inlineCheckbox($label, $name)
    {
        return $this->checkbox($label, $name)->inline();
    }

    protected function checkGroup($label, $name, $control)
    {
        $checkGroup = $this->buildCheckGroup($label, $name, $control);
        return $this->wrap($checkGroup->addClass('checkbox'));
    }

    protected function buildCheckGroup($label, $name, $control)
    {
        $label = $this->builder->label($label, $name)->after($control)->addClass('el-label');

        $checkGroup = new CheckGroup($label);

        if ($this->builder->hasError($name)) {
            $checkGroup->helpBlock($this->builder->getError($name));
            $checkGroup->addClass('has-error');
        }
        return $checkGroup;
    }

    public function radio($label, $name, $value = null)
    {
        if (is_null($value)) {
            $value = $label;
        }

        $control = $this->builder->radio($name, $value)->addClass('el-input');

        return $this->radioGroup($label, $name, $control);
    }

    public function inlineRadio($label, $name, $value = null)
    {
        return $this->radio($label, $name, $value)->inline();
    }

    protected function radioGroup($label, $name, $control)
    {
        $checkGroup = $this->buildCheckGroup($label, $name, $control);
        return $this->wrap($checkGroup->addClass('radio'));
    }

    public function textarea($label, $name)
    {
        $control = $this->builder->textarea($name)->addClass('el-text-area');

        return $this->formGroup($label, $name, $control);
    }

    public function date($label, $name, $value = null)
    {
        $control = $this->builder->date($name)->value($value)->addClass('el-input');

        return $this->formGroup($label, $name, $control);
    }

    public function dateTimeLocal($label, $name, $value = null)
    {
        $control = $this->builder->dateTimeLocal($name)->value($value);

        return $this->formGroup($label, $name, $control);
    }

    public function email($label, $name, $value = null)
    {
        $control = $this->builder->email($name)->value($value)->addClass('el-input');

        return $this->formGroup($label, $name, $control);
    }

    public function file($label, $name, $value = null)
    {
        $control = $this->builder->file($name)->value($value);
        $label = $this->builder->label($label, $name)->addClass('el-label')->forId($name);
        $control->id($name);

        $formGroup = new FormGroup($label, $control);

        if ($this->builder->hasError($name)) {
            $formGroup->helpBlock($this->builder->getError($name));
            $formGroup->addClass('has-error');
        }

        return $this->wrap($formGroup);
    }

    public function inputGroup($label, $name, $value = null)
    {
        $control = new InputGroup($name);
        if (!is_null($value) || !is_null($value = $this->getValueFor($name))) {
            $control->value($value);
        }

        return $this->formGroup($label, $name, $control);
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->builder, $method], $parameters);
    }
}
