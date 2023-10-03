<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineCreateRequest;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public $dict_machine = [
        'genie' => ['GS-1932', 'GS-2046 E-Drive', 'GS-2632', 'GS-2646', 'GS-3246', 'GS-4047', 'GS-4655 E-Drive',
         '4390-RTOR', '3369-RTOR','3384-RTOR', '2669-RTOR', 'Z-33'],
        'jlg' => ['E600JP', 'E450AJ', '4394RT'],
        'magni' => ['ES1612E',]
    ];
    //https://katalog.mistrzu.com/
    //9258 nie ma udt
    //12458 nie ma udt
    //0529 nie ma udt
    //7522 nowy stiker
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
                case 'GS-2046 E-Drive':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    $photo_path = 'photo/2046.jpeg';
                    break;
                case 'GS-2632':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    $photo_path = 'photo/2632.jpeg';
                    break;
                case 'GS-2646':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    $photo_path = 'photo/2646.jpg';
                    break;
                case 'GS-3246':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    $photo_path = 'photo/3246.jpg';
                    break;
                case 'GS-4047':
                    $instruction_path = 'instruction/gs-1932.pdf';
                    $photo_path = 'photo/4047.jpeg';
                    break;
                case 'GS-4655 E-Drive':
                    $instruction_path = 'instruction/4655.pdf';
                    $photo_path = 'photo/4655.jpeg';
                    break;
                case '4390-RTOR':
                    $instruction_path = 'instruction/gs-4390-rt.pdf';
                    $photo_path = 'photo/4390.jpeg';
                    break;
                case '3369-RTOR':
                    $instruction_path = 'instruction/3369.pdf';
                    $photo_path = 'photo/3369.jpeg';
                    break;
                case '3384-RTOR':
                    $instruction_path = 'instruction/gs-4390-rt.pdf';
                    $photo_path = 'photo/3384.jpeg';
                    break;
                case '2669-RTOR':
                    $instruction_path = 'instruction/gs-2669.pdf';
                    $photo_path = 'photo/2669.jpeg';
                    break;
                case 'Z-33':
                    break;
            }
        } elseif ($request->jlg) {
            $machine = 'jlg';
            $instruction_path = '';
            $photo_path = '';
            switch ($request->jlg[0]) {
                case 'E600JP':
                    $instruction_path = 'instruction/E600JP.pdf';
                    $photo_path = 'photo/E600JP.jpeg';
                    break;
                case 'E450AJ':
                    $instruction_path = 'instruction/E450AJ.pdf';
                    $photo_path = 'photo/E450AJ.jpeg';
                    break;
                case '4394RT':
                    $instruction_path = 'instruction/jlg4394rt.pdf';
                    $photo_path = 'photo/jlg4394.jpeg';
                    break;
            }
        } elseif ($request->magni) {
            $machine = 'magni';
            $instruction_path = '';
            $photo_path = '';
            switch ($request->magni[0]) {
                case 'ES1612E':
                    $instruction_path = 'instruction/ES1612E.pdf';
                    $photo_path = 'photo/ES1612E.jpg';
                    break;
            }
        }

        return $$what;
    }

    public function index()
    {
        $machines = Machine::orderBy('udt', 'asc')->paginate(15);
        $machines_count = Machine::get();
        $machines_count = count($machines_count);
        return view('dashboard', compact('machines', 'machines_count'));
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
    public function search(Request $request)
    {
        $serial = $request->input('serial');
        $machines = Machine::where('serial', 'LIKE', "%$serial%")->get();


        return json_encode($machines);
    }
}
