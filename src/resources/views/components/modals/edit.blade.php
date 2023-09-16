@props([
    'data',
    'action' => '',
    'buttonClass' => 'c-btn btn-sm btn_option',
])

@php
    $book = json_decode(html_entity_decode($data), true);
@endphp

<button type="button" class="bi-pencil-square btn" data-bs-toggle="modal" data-bs-target="#update{{ $book['id'] }}"></button>

<div class="modal fade" id="update{{ $book['id'] }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="ms-2 mb-0">Edit Author</h5>
                <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ $action }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <x-forms.field
                            type="text"
                            name="u_author"
                            value="{{ $book['author'] }}"
                            :errors="$errors"
                            :required="true"
                            :label="__('validation.attributes.book.author')"
                        />
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-primary px-2">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>