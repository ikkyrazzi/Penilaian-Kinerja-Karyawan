<?php

namespace App\Http\Requests\Hrd;

use App\Models\Pegawai;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request('id');

        $rules = Pegawai::$rules;

        return $rules;
    }

    // custom message
    public function attributes()
    {
        return Pegawai::$ruleMessages;
    }
}
