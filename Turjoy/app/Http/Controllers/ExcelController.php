<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FileUpload;
use App\Models\Travel;
use App\Http\Controllers\TravelController;

class ExcelController extends Controller
{
    public function importExportView()
    {
        $loadedFiles = FileUpload::all();
        return view('importExportView', ['loadedFiles' => $loadedFiles]);
    }


    public function loadFile(Request $request)
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

        // Procesar el archivo utilizando la clase UsersImport
        try {

            $travelController = new TravelController();
            $travelController->travelCheck($request);
            return redirect()->route('importExportView')->with('success', 'El archivo se cargó correctamente.');
            #return view('importExportView', ['datos_cargados' => $datos_cargados]);
        } catch (\Exception $e) {
            // Mensaje de error
            return redirect()->route('importExportView')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }

    public function showLoadedFiles()
    {
        $loadedFiles = FileUpload::all();
        return view('showLoadedFiles', ['loadedFiles' => $loadedFiles]);
    }

};
