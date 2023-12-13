<?php

namespace App\Http\Requests\Manager;

use App\Models\Penilaian;
use Illuminate\Foundation\Http\FormRequest;

class StorePenilaianKaryawanRequest extends FormRequest
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
        $rules = Penilaian::$rules;

        return $rules;
    }

    // custom message
    public function attributes()
    {
        return Penilaian::$ruleMessages;
    }
}
