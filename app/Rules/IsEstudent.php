<?php

namespace App\Rules;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class IsEstudent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //
        if($value!=null){
            $user=User::where('email',$value)->first();
            if($user!=null){
                $estudiante=Estudiante::where('user_id',$user->id)->first();
                if($estudiante==null){
                    return false;
                }else{
                    return true;
                }
            }else{
                return false;
            }
            
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este correo no pertenece a un Estudiante inscrito';
    }
}
