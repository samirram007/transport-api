<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class RecordsNotFoundException extends Exception
{

    public function render($request){
        return response()->json([
            'status'=> false,
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ], $this->getCode());

    }
}
