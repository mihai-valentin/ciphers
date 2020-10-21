<?php

namespace App\Http\Controllers;

use App\Hashes\Demonstration\LogInAction;
use App\Hashes\Sha256;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

/**
 * Class HashDemonstrationController
 * @package App\Http\Controllers
 */
class HashDemonstrationController extends Controller
{
    /**
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return response(view('login_form'));
    }

    /**
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function login(Request $request)
    {
        if (!empty($request->login) && !empty($request->password)) {
            $match = app(LogInAction::class)->handle($request->login, $request->password);
            if ($match) {
                return response(view(
                    'login_success',
                    ['hash' => app(Sha256::class)->apply($request->password)]
                ));
            }
        }

        return response(view('login_fail'));
    }
}
