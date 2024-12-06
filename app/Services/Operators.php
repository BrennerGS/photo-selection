<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operators
{
    public static function DecryptValue($value)
    {
        try {
            $descriptografado = Crypt::decrypt($value);
        } catch (DecryptException) {
            //return redirect()->route('dashboard');
        }

        return $descriptografado;
    }

    public static function EncryptValue($value)
    {
        
        try {
            $criptografado = Crypt::encrypt($value);
        } catch (DecryptException) {
            return redirect()->route('dashboard');
        }

        return $criptografado;
    }
}
?>