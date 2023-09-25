<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineCreateRequest;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public $dict_machine = [
        'genie' => ['GS-1932', 'GS-2632', 'GS-2646', 'GS-3246', 'Z-33'],
        'jlg' => [],
        'magni' => ['ES1612E',]
    ];

    public $instruction_path;
    public $photo_path;
    public $machine;
    
    public function prepare_variables($request, $what)
    {
        if ($request->genie) {
            $machine = 'genie';
            $instruction_path = '';
            $photo_path = '';
            switch ($request->genie[0]) {
                case 'GS-1932':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    $photo_path = 'photo/1932.jpg';
                    break;
                case 'GS-2632':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    break;
                case 'GS-2646':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    break;
                case 'GS-3246':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    $photo_path = 'photo/3246.jpg';
                    break;
                case 'Z-33':
                    break;
            }
        } elseif ($request->jlg) {
            $machine = 'jlg';
            $instruction_path = '';
            $photo_path = '';
        } elseif ($request->magni) {
            $machine = 'magni';
            $instruction_path = '';
            $photo_path = '';
            switch ($request->genie[0]) {
                case 'ES1612E':
                    $photo_path = 'photo/ES1612E.jpg';
                    break;
            }
        }

        return $$what;
    }

    public function index()
    {
        $machines = Machine::get();
        return view('dashboard', compact('machines'));
    }
    public function create()
    {
        $dict_machine = $this->dict_machine;
        return view('create', compact('dict_machine'));
    }
    public function store(MachineCreateRequest $request)
    {
        $machine = $this->prepare_variables($request, 'machine');
        $instruction_path = $this->prepare_variables($request, 'instruction_path');
        $photo_path = $this->prepare_variables($request, 'photo_path');

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/udt', $filename);
            $path = 'udt/' . $filename;
        }

        $res = Machine::create([
            'name' => $machine,
            'model' => $request->$machine[0],
            'udt' => $request->date,
            'serial' => $request->serial,
            'udt_path' => $path,
            'instruction_path' => $instruction_path,
            'photo_path' => $photo_path,
        ]);

        if ($res) {
            return redirect()->route('dashboard')
                ->with('success', 'Operacja zakończona powodzeniem.');
        } else {
            return redirect()->route('dashboard.create')
                ->with('fail', 'Ups.. coś poszło nie tak.');
        }
    }

    public function edit(Machine $element)
    {
        $dict_machine = $this->dict_machine;
        $machine = $element;
        return view('edit', compact('dict_machine', 'machine'));
    }

    public function update(Request $request, Machine $element)
    {
        $machine = $this->prepare_variables($request, 'machine');
        $instruction_path = $this->prepare_variables($request, 'instruction_path');
        $photo_path = $this->prepare_variables($request, 'photo_path');

        $oldFilePath = $element->udt_path;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Usuń stary plik, jeśli istnieje
            if (!empty($oldFilePath)) {
                Storage::delete($oldFilePath);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/udt', $filename);
            $path = 'udt/' . $filename;

            $element->update([
                'udt_path' => $path,
            ]);
        }

        $res = $element->update([
            'name' => $machine,
            'model' => $request->$machine[0],
            'udt' => $request->date,
            'serial' => $request->serial,
            'instruction_path' => $instruction_path,
            'photo_path' => $photo_path,
        ]);

        if ($res) {
            return redirect()->route('dashboard')
                ->with('success', 'Operacja zakończona powodzeniem.');
        } else {
            return redirect()->route('dashboard.create')
                ->with('fail', 'Ups.. coś poszło nie tak.');
        }
    }

    public function delete(Machine $element)
    {
        $res = $element->delete();
        if ($res) {
            return redirect()->route('dashboard')
                ->with('success', 'Operacja zakończona powodzeniem.');
        } else {
            return redirect()->route('dashboard')
                ->with('fail', 'Ups.. coś poszło nie tak.');
        }
    }
}
