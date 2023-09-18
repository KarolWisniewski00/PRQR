<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'genie' => 'nullable|array',
            'jlg' => 'nullable|array',
            'magni' => 'nullable|array',
            'serial' => 'required|string|unique:machines,serial',
            'date' => 'required|date|after_or_equal:tomorrow',
            'file' => 'nullable|file|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'genie.array' => 'Pole Genie musi być tablicą.',
            'jlg.array' => 'Pole JLG musi być tablicą.',
            'magni.array' => 'Pole Magni musi być tablicą.',
            'serial.required' => 'Pole Numer seryjny jest wymagane.',
            'serial.string' => 'Pole Numer seryjny musi być tekstem.',
            'serial.unique' => 'Ten numer seryjny jest już używany.',
            'date.required' => 'Pole UDT do jest wymagane.',
            'date.date' => 'Pole UDT do musi być datą.',
            'file.required' => 'Pole UDT jest wymagane.',
            'file.file' => 'Pole UDT musi być plikiem.',
            'file.mimes' => 'Pole UDT musi być plikiem typu PDF lub DOCX.',
        ];
    }
    
    
}
