<?php

// Controller namespacing.
namespace App\Http\Requests;

// Other.
use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
            'team_home_id'      => 'required|integer',
            'team_away_id'      => 'required|integer',
            'referee_id'        => 'required|integer',
            'field'             => 'required|integer',
            'game_date'         => 'required|date_format:"Y-m-d H:i:s"',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Merge into request.
        $this->merge([
            'game_date'      => \Carbon\Carbon::createFromFormat('d-m-Y H:i', $this->game_date)->toDateTimeString(),
        ]);
    }
}
