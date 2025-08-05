<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::select('id', 'judul', 'isi', 'slug')->latest()->paginate(10);
        return view('admin.pages.agendas.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.pages.agendas.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:agendas,judul',
            'isi'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->only(['judul', 'isi']);
        $input['slug'] = Str::slug($request->judul);

        Agenda::create($input);

        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil dibuat.');
    }

    public function show(Agenda $agenda)
    {
        return view('admin.pages.agendas.show', compact('agenda'));
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.pages.agendas.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:agendas,judul,' . $agenda->id,
            'isi'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->only(['judul', 'isi']);
        $input['slug'] = Str::slug($request->judul);

        $agenda->update($input);

        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil dihapus.');
    }
}