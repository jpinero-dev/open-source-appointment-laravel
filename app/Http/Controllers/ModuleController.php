<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{


    protected $company_id; // Declarar la variable protegida

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->company_id = auth()->user()->company_id; // Asignar el valor en el constructor
            return $next($request);
        });
    }

    public function index()
    {
        $data = Module::where('company_id', $this->company_id)->get();
        return view('modules.index', compact('data'));
    }

    public function create()
    {

        return view('modules.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modules')->where(function ($query)  {
                    return $query->where('company_id', $this->company_id);
                }),
            ],
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();
            $errorMessages = implode('<br>', $errors);

            return redirect()->back()
                ->with('toast_warning', $errorMessages)
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['name'] = strtoupper($validatedData['name']); // Convertir a mayúsculas
        $validatedData['number'] = 1; // Agregar el campo nuevo desde la solicitud
        $validatedData['company_id'] = $this->company_id; // Agregar el campo nuevo desde la solicitud

        Module::create($validatedData);
        return redirect()->route('module')->with('toast_success', 'Modulo creado.');
    }

    public function edit($id)
    {

        try {
            $data = Module::where('company_id', $this->company_id)->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(403, 'Registro no encontrado'); // Responder con un error de "no permitido"
        }

        return view('modules.create', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modules')->where(function ($query) use ( $id) {
                    return $query->where('company_id', $this->company_id)
                        ->whereNotIn('id', [$id]);
                }),
            ],
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessages = implode('<br>', $errors);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('toast_warning', $errorMessages);
        }

        $validatedData = $validator->validated();
        $validatedData['name'] = strtoupper($validatedData['name']); // Convertir a mayúsculas
        $validatedData['company_id'] = $this->company_id; // Agregar el campo nuevo desde la solicitud

        $company = Module::findOrFail($id);
        $company->update($validatedData);

        return redirect()->route('module')->with('toast_success', 'Modulo actualizado.');
    }

    public function destroy($id)
    {

        $existingTurns = Turn::where('company_id', $this->company_id)
            ->where('module_id', $id)
            ->exists();

        if ($existingTurns) {
           
            toast('No se puede eliminar', 'error');
            return redirect()->route('module');
        }

        $turnType = Module::findOrFail($id);
        $turnType->delete();
        return redirect()->route('module')->with('toast_success', 'Modulo eliminado.');
    }
}
