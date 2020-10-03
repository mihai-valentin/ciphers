<?php


namespace App\Http\Requests;


use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CipherRequestValidator
{
    use ProvidesConvenienceMethods;

    /**
     * @param Request $request
     * @return Request
     * @throws ValidationException
     */
    public function handle(Request $request): Request
    {
        $this->validate(
            $request,
            [
                'type'           => 'required',
                'input_text'     => 'required|max:255',
                'key'            => 'required',
                'operation_type' => 'required',
                'cipher'         => 'required'
            ]
        );

        return $request;
    }
}
