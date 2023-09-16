<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\Request;

/**
 * @method array rules()
 * @method array attributes()
 */
class IndexRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'keyword' => 'nullable|string|max:128',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
        ];
    }
}
