
@extends('layouts.base')
    
@section('baseContent')
<div class="main-content pt-4 px-3 px-sm-5 col-lg-8 col-xl-6 m-auto">
    <x-forms.alert-message />
    <div class="p-4 border shadow bg-body rounded">
        <form class="form" method="post" action="{{ route('books.store') }}">
            @csrf
            <div class="d-md-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <x-forms.field
                                type="text"
                                name="title"
                                :errors="$errors"
                                :required="true"
                                :label="__('validation.attributes.book.title')"
                            />
                        </div>
                        <div class="col-md-6 mb-2 mb-md-0">
                            <x-forms.field
                                type="text"
                                name="author"
                                :errors="$errors"
                                :required="true"
                                :label="__('validation.attributes.book.author')"
                            />
                        </div>
                    </div>
                </div>
                <div class="text-end ms-auto ms-md-3">
                    <button type="submit" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
    <div class="shadow bg-body rounded border p-4 mt-3">
        <div class="actions d-flex justify-content-between mb-3">
            <div>
                <form class="input-group ml-2" method="get" action="{{ route('books.index') }}">
                    <input type="text" class="form-control form-control-sm text-style" name='keyword' placeholder="Search here" value="{{ $params['keyword'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-secondary bi bi-search"></button>
                </form>
            </div>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenu1" aria-expanded="false">Download</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="btn-group dropend dropdown-item">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            AS CSV
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="btn btn-sm m-0 w-100 dropdown-item"
                                    href="{{ route('books.download', [
                                        'downloadItem' => 'all',
                                        'downloadAs' => 'csv'
                                    ]) }}"
                                >ALL</a>
                            </li>
                            <li>
                                <a class="btn btn-sm m-0 w-100 dropdown-item"
                                    href="{{ route('books.download', [
                                        'downloadItem' => 'author',
                                        'downloadAs' => 'csv'
                                    ]) }}"
                                >Author</a>
                            </li>
                            <li>
                                <a class="btn btn-sm m-0 w-100 dropdown-item"
                                    href="{{ route('books.download', [
                                        'downloadItem' => 'title',
                                        'downloadAs' => 'csv'
                                    ]) }}"
                                >Title</a>
                            </li>
                        </ul>
                    </li>
                    <li class="btn-group dropend dropdown-item">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            AS XML
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="btn btn-sm m-0 w-100 dropdown-item"
                                    href="{{ route('books.download', [
                                        'downloadItem' => 'all',
                                        'downloadAs' => 'xml'
                                    ]) }}"
                                >ALL</a>
                            </li>
                            <li>
                                <a class="btn btn-sm m-0 w-100 dropdown-item"
                                    href="{{ route('books.download', [
                                        'downloadItem' => 'author',
                                        'downloadAs' => 'xml'
                                    ]) }}"
                                >Author</a>
                            </li>
                            <li>
                                <a class="btn btn-sm m-0 w-100 dropdown-item"
                                    href="{{ route('books.download', [
                                        'downloadItem' => 'title',
                                        'downloadAs' => 'xml'
                                    ]) }}"
                                >Title</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <table id="bookList" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                    <th scope="col">@sortablelink('id', 'ID')</th>
                    <th scope="col">@sortablelink('title', 'Title')</th>
                    <th scope="col">@sortablelink('author', 'Author')</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($books->count() === 0)
                        <tr>
                            <td colspan="4" class="text-center">No books</td>
                        </tr>
                    @endif
                    @foreach ($books as $book)
                        <tr class="align-middle">
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td width="120">
                                <x-modals.edit
                                    data="{{ json_encode($book) }}"
                                    buttonClass="bi-pencil-square btn"
                                    action="{{ route('books.update', ['id' => $book->id]) }}"
                                />
                                <x-modals.confirm
                                    id="confirmModal{{$book->id}}"
                                    buttonClass="bi-trash btn"
                                    confirm="Do you want to delete Book ID:{{ $book->id }}?"
                                    action="{{ route('books.delete', ['id' => $book->id]) }}"
                                />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
</div>
@endsection
