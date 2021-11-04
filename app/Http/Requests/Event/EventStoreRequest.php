<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends CustomFormRequest
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
            'name'=>'required|unique:event,name',
            'latitude'=>'required',
            'longitude'=>'required',
            'event_date'=>'required'
            
        ];
    }
}
