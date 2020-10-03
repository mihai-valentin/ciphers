<?php


namespace App\Http\Controllers;


use App\Ciphers\AlgorithmFactory;
use App\Http\Requests\CipherRequestValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CiphersController extends Controller
{

    public function index(string $type)
    {
        return response(view('cipher', ['type' => $type]));
    }

    public function execute(Request $request)
    {
        try {
            $request = app(CipherRequestValidator::class)->handle($request);
        } catch (ValidationException $e) {
            return response(view('error', ['description' => $e->getMessage()]));
        }

        if ($request->operation_type === 'decrypt') {
            $result = AlgorithmFactory::get($request->type)->decrypt(
                $request->input_text,
                $request->key
            );
        } else {
            $result = AlgorithmFactory::get($request->type)->encrypt(
                $request->input_text,
                $request->key
            );
        }

        return response(view(
            'cipher',
            [
                'type'        => $request->type,
                'initialText' => $request->input_text,
                'key'         => $request->key,
                'result'      => $result
            ]
        ));
    }
}

