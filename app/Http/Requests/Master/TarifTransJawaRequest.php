<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\FormRequest;

class TarifTransJawaRequest extends FormRequest
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'asal_tujuan' => 'required',
            'Pandaan-Malang' => 'required',
            'Gempol' => 'required',
            'Pasuruan' => 'required',
            'Grati-Probolinggo Timur' => 'required',
            'Sidoarjo' => 'required',
            'Surabaya' => 'required',
            'Mojokerto-GT Mojokerto Barat' => 'required',
            'Kertosono-GT Nganjuk' => 'required',
            'Madiun' => 'required',
            'Ngawi' => 'required',
            'Sragen' => 'required',
            'Solo-Yogya Via GT Colomadu' => 'required',
            'Boyolali' => 'required',
            'Ungaran' => 'required',
            'Semarang' => 'required',
            'Batang' => 'required',
            'Pemalang' => 'required',
            'Brebes Timur' => 'required',
            'Pejagan' => 'required',
            'Cirebon-GT Ciperna' => 'required',
            'Palimanan' => 'required',
            'Cikampek' => 'required',
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
