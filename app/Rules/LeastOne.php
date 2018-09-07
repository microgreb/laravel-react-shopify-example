<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LeastOne implements Rule
{
    /**
     * @var
     */
    protected $attributeName;

    /**
     * LeastOne constructor
     * Create a new rule instance.
     *
     * @param $attributeName
     */
    public function __construct($attributeName)
    {
        $this->attributeName = $attributeName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ! ! collect($value)->firstWhere($this->attributeName, true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Group Leader is required.';
    }
}
