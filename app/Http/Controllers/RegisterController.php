<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Company;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }




    public function user()
    {
        request()->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'terms' => 'required' // Agregar la validación de términos y condiciones
        ], [
            'terms.required' => 'Debes aceptar los Términos y Condiciones para continuar.'
        ]);

        $userData = [
            'username' => request('username'),
            'email' => request('email'),
            'password' => request('password'),
        ];

        if (empty($userData)) {
            return view('auth.register');
        }
        return view('auth.register-company', compact('userData'));
    }




    public function store(Request $request)
    {

        // return  $request->all();
        $userData = json_decode($request->input('userData'), true);

        $validator = Validator::make($request->all(), [
            'identification' => 'required|max:255',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'description' => 'max:255',
        ]);

        if ($validator->fails()) {
            $inputData = $request->except('_token');
            return view('auth.register-company', compact('userData', 'inputData'))
                ->withErrors($validator);
            // ->withInput($request->except('_token'));
        }


        $companyData = [
            'identification' => request('identification'),
            'name' => request('name'),
            'address' => request('address'),
            'phone' => request('phone'),
            'description' => request('description'),
            'state' => '1',
        ];





        try {
           // DB::transaction(function () use ($userData, $companyData) {
                // Crear la empresa
                $company = Company::create($companyData);
                // Crear usuario
                $user = User::create($userData);

                // Vincular usuario con empresa
                $user->company()->associate($company);
                $user->save();
                auth()->login($user);
                return redirect('/');
         //   });
        } catch (\Exception $e) {
            //$errorMessage = $e->getMessage();
            //return  $errorMessage;
            // Captura cualquier excepción que ocurra durante la transacción
            return redirect()->back()->withErrors(['error' => 'Hubo un error durante el registro. Por favor, intenta nuevamente.']);
        }
    }
}
