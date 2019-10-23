<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\FormRequest;

class EventRequest extends FormRequest
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'title' => 'required|max:190',
            'description' => 'required',
        ];

        return $rules;
    }
    // public function attributes()
    // {
    //    return [
    //     'type_id' => 'Equipment Type',
    //     'site_id' => 'Company',
    //     'name' => 'Equipment Name',
    //     'no_sertifikat' => 'Certificate Number',
    //     'merek' => 'Brand',
    //     'register_number' => 'Register Number',
    //     'description' => 'Deskripsi',
    //    ];
    // }

    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty'
        ];
    }
}
