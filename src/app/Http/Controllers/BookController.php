<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\IndexRequest;
use App\Http\Requests\Book\CreateRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Repositories\BookRepository;
use App\Services\BookService;

/**
 * BookController
 *
 * @package App\Http\Controllers\Web
 */
class BookController extends Controller
{
    private BookRepository $bookRepository;

    public function __construct(
        BookRepository $bookRepository,
    ) {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexRequest $request)
    {
        $params = $request->validated();
        $books = $this->bookRepository->getModel()::sortable()->get();  // sort data using sortable() in Kyslik package

        if (isset($params['keyword'])) {
            $books = $this->bookRepository->scopeQuery(function ($query) use ($params) {
                return $query
                    ->where('author', 'like', "%{$params['keyword']}%")
                    ->orWhere('title', 'like', "%{$params['keyword']}%");
            })->all();
        }

        return view('books.index', ['books' => $books, 'params' => $params]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateRequest $request)
    {
        $params = $request->validated();

        $this->bookRepository->create($params);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => __('validation.alert.create.success'),
        ]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, UpdateRequest $request)
    {
        $params = $request->validated();

        $this->bookRepository->update($params, $id);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => __('validation.alert.update.success'),
        ]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id)
    {
        $this->bookRepository->delete($id);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => __('validation.alert.delete.success'),
        ]);
    }

    /**
     * @param string $downloadItem
     * @param string $downloadAs
     *
     * @return \Response
     */
    public function download(string $downloadItem, string $downloadAs, BookService $bookService)
    {
        $stream = $bookService->exportBookList($downloadItem, $downloadAs);

        return response()->streamDownload($stream['callback'], $stream['fileName'], $stream['headers']);
    }
}
