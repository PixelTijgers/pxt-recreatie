<?php

// Controller namespacing.
namespace App\Http\Requests;

// Other.
use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'season'  => 'required|integer|max:255|unique:categories,season'  . (@$this->category->id ? ',' . $this->category->id : null),
            'name'  => 'required|string|max:255|unique:categories,name'  . (@$this->category->id ? ',' . $this->category->id : null),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.season' => 'Dit seizoen bestaat al.',
            'name.unique' => 'Er is al een seizoen met deze naam.',
        ];
    }
}
