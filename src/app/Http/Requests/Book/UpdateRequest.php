<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\Request;

/**
 * @method array rules()
 * @method array attributes()
 */
class UpdateRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'u_author' => 'required|string|max:128',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'u_author' => __('validation.attributes.book.author'),
        ];
    }
}
