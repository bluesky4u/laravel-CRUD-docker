<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\Request;

/**
 * @method array rules()
 * @method array attributes()
 */
class CreateRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:128',
            'author' => 'required|string|max:128',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'title' => __('validation.attributes.book.title'),
            'author' => __('validation.attributes.book.author'),
        ];
    }
}
