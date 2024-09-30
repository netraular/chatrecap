<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsvUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CsvUploadController extends Controller
{
    public function index()
    {
        $csvUploads = Auth::user()->csvUploads;
        return view('csv-uploads.index', compact('csvUploads'));
    }

    public function create()
    {
        return view('csv-uploads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'nullable|string|max:255',
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $path = $request->file('csv_file')->store('csv_uploads');

        $filename = $request->filename ?? $request->file('csv_file')->getClientOriginalName();

        Auth::user()->csvUploads()->create([
            'filename' => $filename,
            'path' => $path,
        ]);

        return redirect()->route('csv-uploads.index')->with('success', 'Archivo CSV subido correctamente.');
    }

    public function destroy(CsvUpload $csvUpload)
    {
        if (Auth::id() !== $csvUpload->user_id) {
            return redirect()->route('csv-uploads.index')->with('error', 'No tienes permiso para eliminar este archivo.');
        }

        Storage::delete($csvUpload->path);
        $csvUpload->delete();

        return redirect()->route('csv-uploads.index')->with('success', 'Archivo CSV eliminado correctamente.');
    }

    public function edit(CsvUpload $csvUpload)
    {
        if (Auth::id() !== $csvUpload->user_id) {
            return redirect()->route('csv-uploads.index')->with('error', 'No tienes permiso para editar este archivo.');
        }

        return view('csv-uploads.edit', compact('csvUpload'));
    }

    public function update(Request $request, CsvUpload $csvUpload)
    {
        if (Auth::id() !== $csvUpload->user_id) {
            return redirect()->route('csv-uploads.index')->with('error', 'No tienes permiso para editar este archivo.');
        }

        $request->validate([
            'filename' => 'required|string|max:255',
            'csv_file' => 'nullable|mimes:csv,txt|max:2048',
        ]);

        $csvUpload->filename = $request->filename;

        if ($request->hasFile('csv_file')) {
            Storage::delete($csvUpload->path);
            $path = $request->file('csv_file')->store('csv_uploads');
            $csvUpload->path = $path;
        }

        $csvUpload->save();

        return redirect()->route('csv-uploads.index')->with('success', 'Archivo CSV actualizado correctamente.');
    }

    public function show(CsvUpload $csvUpload)
    {
        if (Auth::id() !== $csvUpload->user_id) {
            return redirect()->route('csv-uploads.index')->with('error', 'No tienes permiso para ver este archivo.');
        }

        $csvData = $this->parseCsv($csvUpload->path);

        return view('csv-uploads.show', compact('csvUpload', 'csvData'));
    }

    private function parseCsv($path)
    {
        $csvData = [];
        $file = fopen(storage_path('app/' . $path), 'r');
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $csvData[] = array_combine($headers, $row);
        }

        fclose($file);

        return $csvData;
    }
}