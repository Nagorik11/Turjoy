<?php

namespace App\Http\Controllers;

use App\Imports\TravelsImport;
use Illuminate\Http\Request;
use App\Imports\FilesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FileUpload;

class ExcelController extends Controller
{
    public function importExportView()
    {
        $datosCargados = FileUpload::all();
        return view('importExportView', ['datosCargados' => $datosCargados]);
    }


    public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx|max:5120', // Max 5MB
        ]);

        try {
            Excel::import(new FilesImport, $request->file('archivo'));
            return redirect()->route('importExportView')->with('success', 'El archivo se cargó correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('importExportView')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }


    public function loadfile(Request $request)
    {
        // Validar que se haya enviado un archivo
        if (!$request->hasFile('archivo')) {
            return redirect()->back()->with('error', 'No se ha seleccionado un archivo para cargar.');
        }

        $archivo = $request->file('archivo');

        // Validar la extensión del archivo
        if ($archivo->getClientOriginalExtension() !== 'xlsx') {
            return redirect()->back()->with('error', 'El archivo seleccionado no es un Excel con extensión .xlsx.');
        }

        // Validar el tamaño del archivo (en este ejemplo, 5 MB)
        $maxSize = 5 * 1024 * 1024; // 5 megabytes
        if ($archivo->getSize() > $maxSize) {
            return redirect()->back()->with('error', 'El tamaño máximo del archivo a cargar no puede superar los 5 megabytes.');
        }

        // Procesar el archivo utilizando la clase FilesImport
        try {
            Excel::import(new FilesImport, $archivo);
            // Mensaje de éxito

            return redirect()->route('importExportView')->with('success', 'El archivo se cargó correctamente.');


        } catch (\Exception $e) {
            // Mensaje de error
            return redirect()->route('importExportView')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }

    public function mostrarFileUpload()
    {
        $datosCargados = FileUpload::all();
        return view('mostrar-datos-cargados', ['datosCargados' => $datosCargados]);
    }

};


