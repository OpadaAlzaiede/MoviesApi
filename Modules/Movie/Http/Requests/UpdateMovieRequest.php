<?php

namespace Modules\Movie\Http\Requests;

use App\Traits\JSONErrors;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    use JSONErrors;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'rate' => 'numeric|between:1,10',
            'date' => 'date',
            'duration' => 'numeric|between:60,300',
            'country' => 'string',
            'category_id' => 'required|numeric|exists:categories,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
