<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'business_unit_id' => 'required|exists:business_units,id',
            'service_id' => 'nullable|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'nullable|in:low,normal,high,urgent',
            'requested_date' => 'nullable|date',
            'attachment' => 'nullable|file|max:25600', // 25MB
        ];
    }

    public function messages(): array
    {
        return [
            'business_unit_id.required' => 'Por favor, selecione uma unidade de negócio.',
            'title.required' => 'O título da solicitação é obrigatório.',
            'description.required' => 'Descreva a sua necessidade em detalhes.',
        ];
    }
}
