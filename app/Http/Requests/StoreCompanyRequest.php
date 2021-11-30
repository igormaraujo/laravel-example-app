<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    protected function prepareForValidation()
    {
        if ($this->filled('website')) {
            $this->merge(['website' => 'https://' . $this->get('website')]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'nullable|unique:companies|email',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
        ];
    }

    public function passedValidation()
    {
        if($this.filled('logo')) {
            $this->merge(['logo' => $this->file('logo')->store('','public')]);
        }
    }

    public function validated(): array
    {
        if ($this->filled('logo')) {
            return array_merge(parent::validated(), ['logo' => $this->input('logo')]);
        }
        return parent::validated();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required'
        ];
    }
}
