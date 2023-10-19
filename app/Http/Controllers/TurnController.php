<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use App\Models\TurnType;
use App\Models\Module;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;

class TurnController extends Controller
{


    protected $company_id; // Declarar la variable protegida

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->company_id = auth()->user()->company_id; // Asignar el valor en el constructor
            $this->user_id = auth()->user()->id; // Asignar el valor en el constructor
            return $next($request);
        });
    }


    public function calendar()
    {
        $multimedia = Multimedia::where('company_id', $this->company_id)->get();

        // Obtén la hora actual
        $currentTime = Carbon::now();
        // Calcula las horas límite para el rango
        $oneHourAgo = $currentTime->copy()->subHour();
        $oneHourAhead = $currentTime->copy()->addHour();

        $data = Turn::where('company_id', $this->company_id)
            ->where('status', '!=', 'cancelled')
            ->whereDate('start_datetime', Carbon::today()) // Filtrar por la fecha de hoy
            ->whereBetween('start_datetime', [$oneHourAgo, $oneHourAhead])
            ->orderBy('start_datetime') // Ordenar por fecha ascendente
            ->with(['turnType', 'module'])
            ->get();


        return view('turn.turn', compact('data', 'multimedia'));
    }

    public function calendarAPI()
    {
        // Obtén la hora actual
        $currentTime = Carbon::now();
        // Calcula las horas límite para el rango
        $oneHourAgo = $currentTime->copy()->subHour();
        $oneHourAhead = $currentTime->copy()->addHour();

        $data = Turn::where('company_id', $this->company_id)
            ->where('status', '!=', 'cancelled')
            ->whereDate('start_datetime', Carbon::today()) // Filtrar por la fecha de hoy
            ->whereBetween('start_datetime', [$oneHourAgo, $oneHourAhead])
            ->orderBy('start_datetime') // Ordenar por fecha ascendente
            ->with(['turnType', 'module'])
            ->get();



        return $data;
    }
    public function index()
    {

        $data = Turn::where('company_id', $this->company_id)->orderBy('start_datetime', 'desc')->get();
        return view('turn.index', compact('data'));
    }

    public function create()
    {

        $categories = TurnType::where('company_id', $this->company_id)->pluck(DB::raw("CONCAT(prefix, ' - ', name) as name"), 'id');
        $modules = Module::where('company_id', $this->company_id)->pluck('name', 'id');
        return view('turn.create', compact('categories', 'modules'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|integer|exists:users,id',
            'turn_type_id' => 'required|integer|exists:turn_types,id',
            'module_id' => 'required|integer|exists:modules,id',
            'identification' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'start_datetime' => 'required|date',
            // 'end_datetime' => 'required|date|after:start_datetime',
            // 'status' => 'required|string|in:pending,processing,completed,cancelled',
            'cancellation_reason' => 'nullable|string|max:255',
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
        $validatedData['company_id'] = $this->company_id; // Agregar el campo nuevo desde la solicitud
        $validatedData['user_id'] = $this->user_id; // Agregar el campo nuevo desde la solicitud
        $validatedData['end_datetime'] = $validatedData['start_datetime']; // Agregar el campo nuevo desde la solicitud


        $turnType = TurnType::find($validatedData['turn_type_id']);


        if ($turnType) {
            $validatedData['number'] = $turnType->number;
            $turnType->increment('number');
        }


        Turn::create($validatedData);

        return redirect()->route('turn')->with('toast_success', 'Turno creado.');
    }

    public function edit($id)
    {

        try {

            $statusOptions = [
                'pending' => 'Pendiente',
                'processing' => 'Procesando',
                'completed' => 'Completado',
                'cancelled' => 'Cancelado',
            ];

            $data = Turn::where('company_id', $this->company_id)->findOrFail($id);
            $categories = TurnType::where('company_id', $this->company_id)->pluck(DB::raw("CONCAT(prefix, ' - ', name) as name"), 'id');
            $modules = Module::where('company_id', $this->company_id)->pluck('name', 'id');
        } catch (ModelNotFoundException $e) {
            return abort(403, 'Registro no encontrado'); // Responder con un error de "no permitido"
        }

        return view('turn.create', compact('data', 'categories', 'modules', 'statusOptions'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|integer|exists:users,id',
            'turn_type_id' => 'required|integer|exists:turn_types,id',
            'module_id' => 'required|integer|exists:modules,id',
            'identification' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'start_datetime' => 'required|date',
            // 'end_datetime' => 'required|date|after:start_datetime',
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'cancellation_reason' => 'nullable|string|max:255',
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
        $validatedData['company_id'] = $this->company_id; // Agregar el campo nuevo desde la solicitud
        $validatedData['user_id'] = $this->user_id; // Agregar el campo nuevo desde la solicitud
        $validatedData['end_datetime'] = $validatedData['start_datetime']; // Agregar el campo nuevo desde la solicitud
        if ($validatedData['status'] !== 'cancelled') {
            $validatedData['cancellation_reason'] = null;
        }

        $company = Turn::findOrFail($id);
        $company->update($validatedData);

        return redirect()->route('turn')->with('toast_success', 'Turno actualizado.');
    }

    public function destroy($id)
    {


        $turnType = Turn::findOrFail($id);
        $turnType->delete();
        return redirect()->route('turn')->with('toast_success', 'Turno eliminado.');
    }

    public function obtenerTotalesPorPeriodo($company_id)
    {

        $multimedia = Multimedia::where('company_id', $company_id)->get();

        $today = Carbon::now()->startOfDay();
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $oneMonthAgo = Carbon::now()->subMonth();
        $oneYearAgo = Carbon::now()->subYear();
        
        $turnsCounts = Turn::where('company_id', $company_id)
            ->selectRaw('
                SUM(CASE WHEN start_datetime >= ? THEN 1 ELSE 0 END) as turnsToday,
                SUM(CASE WHEN start_datetime >= ? THEN 1 ELSE 0 END) as turnsLastSevenDays,
                SUM(CASE WHEN start_datetime >= ? THEN 1 ELSE 0 END) as turnsLastMonth,
                SUM(CASE WHEN start_datetime >= ? THEN 1 ELSE 0 END) as turnsLastYear
            ', [$today, $sevenDaysAgo, $oneMonthAgo, $oneYearAgo])
            ->first();
        

        $turnTotals = Turn::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->whereIn('status', ['pending', 'processing', 'completed', 'cancelled'])
            ->get();
        
        $totalsByStatus = [];
        foreach ($turnTotals as $total) {
            $totalsByStatus[$total->status] = $total->total;
        }

   
        $lastTurns = Turn::where('company_id', $company_id)
        ->where('status', '!=', 'cancelled')
        ->orderBy('start_datetime')
        ->with(['turnType', 'module'])
        ->take(5) // Limitar a los últimos 5 registros
        ->get();
          
        $year = date('Y'); // Año actual

        $monthlyTotals = DB::table('turns')
            ->select(DB::raw('MONTH(start_datetime) as month'), DB::raw('COUNT(*) as total_turns'))
            ->where('status', '!=', 'cancelled')
            ->whereYear('start_datetime', $year)
            ->groupBy(DB::raw('MONTH(start_datetime)'))
            ->orderBy(DB::raw('MONTH(start_datetime)'))
            ->get();
            

        
        return [
            'turnsToday' => $turnsCounts->turnsToday,
            'turnsLastSevenDays' => $turnsCounts->turnsLastSevenDays,
            'turnsLastMonth' => $turnsCounts->turnsLastMonth,
            'turnsLastYear' => $turnsCounts->turnsLastYear,
            'totalsByStatus'  =>  $totalsByStatus,
            'multimedia'  =>  $multimedia,
            'lastTurns'  =>  $lastTurns,
            'monthlyTotals'  =>  $monthlyTotals
        ];
    }
}
