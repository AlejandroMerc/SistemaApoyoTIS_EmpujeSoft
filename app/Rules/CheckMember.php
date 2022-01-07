<?php

namespace App\Rules;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CheckMember implements Rule
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
                if($estudiante!=null){
                    if($estudiante->grupoempresa_id==null){
                        return true;
                    }else{
                        return false;
                    }
                }
                
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
        return 'Este estudiante ya pertenece a una Grupo Empresa';
    }
}
