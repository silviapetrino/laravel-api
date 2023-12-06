<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:50'],
            'description' => ['required','string'],
            'release_date' => ['nullable','date']
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Devi inserire il titolo del progetto',
            'title.string' => 'Inserisci un titolo valido',
            'title.max' => 'Il titolo del post non può avere più di :max caratteri',
            'description.required' => 'Devi inserire la descrizione del progetto',
            'release_data.date' => 'Inserisci una data in questo formato: yyyy-mm-dd',
        ];
    }

}
