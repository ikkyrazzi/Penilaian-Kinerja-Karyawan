<?php

namespace App\Http\Requests\Hrd;

use App\Models\Jabatan;
use Illuminate\Foundation\Http\FormRequest;

class StoreJabatanRequest extends FormRequest
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
        $rules = Jabatan::$rules;

        return $rules;
    }

    // custom message
    public function attributes()
    {
        return Jabatan::$ruleMessages;
    }
}