<?php

namespace App\Rules;

use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckMiembrosGE implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mensaje = [];
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
        $validado = true;
        $estudiante1 = $this->getEstudiante($value[0]);
        if(empty($estudiante1))
        {
            $this->mensaje[] = $value[0] . ': El correo de representante legal no pertenece a un estudiante registrado';
            $validado = false;
        }
        else
        {   
            $grupo_id1 = $estudiante1->grupo()->value('id');
            foreach($value as $miembro)
            {
                $estudiante2 = $this->getEstudiante($miembro);
                if(empty($estudiante2))
                {
                    $this->mensaje[] = $miembro . ': El correo de miembro no pertenece a un estudiante registrado';
                    $validado = false;
                }
                else
                {
                    $grupo_id2 = $estudiante2->grupo()->value('id');
                    if($grupo_id1 !== $grupo_id2)
                    {
                        $this->mensaje[] = $miembro . ': Todos los miembros deben estar inscritos en el mismo grupo';
                        $validado = false;
                    }
                }
            }
        }
        return $validado;
    }
    
    /**
     * Obtener el estudiante asociado a un correo.
     *
     * @return string
     */
    private function getEstudiante($email)
    {
        $user = User::where('email','=',$email)->first();
        if(empty($user))
        {
            return [];
        }
        else
        {
            return $user->estudiante;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->mensaje;
    }
}
