<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use App\Models\TurnType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TurnTypeController extends Controller
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
        $data = TurnType::where('company_id', $this->company_id)->get();
        return view('turntype.index', compact('data'));
    }

    public function create()
    {

        return view('turntype.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'prefix' => [
                'required',
                'string',
                'max:10',
                'alpha',
                Rule::unique('turn_types')->where(function ($query) use ($request) {
                    return $query->where('prefix', $request->prefix)
                        ->where('name', $request->name)
                        ->where('company_id', $this->company_id);
                }),
            ],
            'name' => 'required|string|max:255',
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
        $validatedData['prefix'] = strtoupper($validatedData['prefix']); // Convertir a mayúsculas
        $validatedData['number'] = 1; // Agregar el campo nuevo desde la solicitud
        $validatedData['company_id'] = $this->company_id; // Agregar el campo nuevo desde la solicitud

        TurnType::create($validatedData);
        return redirect()->route('turntype')->with('toast_success', 'Categoria de turno creada.');
    }

    public function edit($id)
    {

        try {
            $data = TurnType::where('company_id', $this->company_id)->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(403, 'Registro no encontrado'); // Responder con un error de "no permitido"
        }

        return view('turntype.create', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'prefix' => [
                'required',
                'string',
                'max:10',
                'alpha',
                Rule::unique('turn_types')->where(function ($query) use ($request, $id) {
                    return $query->where('prefix', $request->prefix)
                        ->where('name', $request->name)
                        ->where('company_id', $this->company_id)
                        ->whereNotIn('id', [$id]);
                }),
            ],
            'name' => 'required|string|max:255',
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
        $validatedData['prefix'] = strtoupper($validatedData['prefix']); // Convertir a mayúsculas
        $validatedData['company_id'] = $this->company_id; // Agregar el campo nuevo desde la solicitud

        $company = TurnType::findOrFail($id);
        $company->update($validatedData);

        return redirect()->route('turntype')->with('toast_success', 'Categoria de turnos actualizada.');
    }

    public function destroy($id)
    {

        $existingTurns = Turn::where('company_id', $this->company_id)
            ->where('turn_type_id', $id)
            ->exists();

        if ($existingTurns) {
            toast('No se puede eliminar', 'error');
            return redirect()->route('turntype');
        }

        $turnType = TurnType::findOrFail($id);
        $turnType->delete();
        return redirect()->route('turntype')->with('toast_success', 'Categoria de turnos eliminada.');
    }
}
