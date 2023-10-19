<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;



class MultimediaController extends Controller
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
        $data = Multimedia::where('company_id', $this->company_id)->get();
        return view('multimedia.index', compact('data'));
    }

    public function create()
    {

        return view('multimedia.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,avi|max:5120',
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

        // Handle file upload and storage
        if ($request->hasFile('url')) {
            $file = $request->file('url');
            $filename = time() . '_' . $this->company_id;
            //. '_' . $file->getClientOriginalName()
            $extension = $file->getClientOriginalExtension();
            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
            $isVideo = in_array($extension, ['mp4', 'avi']);

            if ($isImage) {
                $validatedData['type'] = "imagen";
            } elseif ($isVideo) {
                $validatedData['type'] = "video";
            } else {
                $validatedData['type'] = "otro";
            }
            $file->move(public_path('media/' . $this->company_id), $filename . '.' . $extension);
            $validatedData['url'] = 'media/' . $this->company_id . '/' . $filename . '.' . $extension;
        }else{
            $errorMessages = new MessageBag();
            $errorMessages->add('url', 'Debes cargar una imagen o video.');
            return redirect()->back()
            ->with('toast_warning', $errorMessages)
            ->withInput();

        }


        Multimedia::create($validatedData);
        return redirect()->route('multimedia')->with('toast_success', 'Modulo creado.');
    }

    public function edit($id)
    {

        try {
            $data = Multimedia::where('company_id', $this->company_id)->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(403, 'Registro no encontrado'); // Responder con un error de "no permitido"
        }

        return view('multimedia.create', compact('data'));
    }

    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'url' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,avi|max:5120',
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

        $multimedia = Multimedia::findOrFail($id);

        $url = $multimedia->url;
        $fileToDelete = public_path($url);
        if (File::exists($fileToDelete)) {
            File::delete($fileToDelete);
        }

        // Handle file upload and storage
        if ($request->hasFile('url')) {
            $file = $request->file('url');
            $filename = time() . '_' . $this->company_id;
            //. '_' . $file->getClientOriginalName()
            $extension = $file->getClientOriginalExtension();
            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
            $isVideo = in_array($extension, ['mp4', 'avi']);
            if ($isImage) {
                $validatedData['type'] = "imagen";
            } elseif ($isVideo) {
                $validatedData['type'] = "video";
            } else {
                $validatedData['type'] = "otro";
            }
            $file->move(public_path('media/' . $this->company_id), $filename . '.' . $extension);
            $validatedData['url'] = 'media/' . $this->company_id . '/' . $filename . '.' . $extension;
        }

        $multimedia->update($validatedData);

        return redirect()->route('multimedia')->with('toast_success', 'Multimedia actualizado.');
    }

    public function destroy($id)
    {
        $multimedia = Multimedia::findOrFail($id);
       

        $url = $multimedia->url;
        $fileToDelete = public_path($url);

        if (File::exists($fileToDelete)) {
            File::delete($fileToDelete);
        }
        
        $multimedia->delete();

        return redirect()->route('multimedia')->with('toast_success', 'Multimedia eliminado.');
    }
}
