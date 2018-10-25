<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'text.required' => 'Сообщение не может быть пустым.',
            'text.unique' => 'Такое сообщение уже отправлено',
        ];
    }
}
