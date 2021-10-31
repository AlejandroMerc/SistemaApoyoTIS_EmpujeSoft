<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CodigoInscripcionGrupo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($codigo_inscripcion)
    {
        $this->codigo_inscripcion = $codigo_inscripcion;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->codigo_inscripcion === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El codigo de inscripcion es incorrecto';
    }
}
