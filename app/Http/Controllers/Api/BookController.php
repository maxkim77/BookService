<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GoogleBooksService;

class BookController extends Controller
{
    private $googleBooksService;

    public function __construct(GoogleBooksService $googleBooksService)
    {
        $this->googleBooksService = $googleBooksService;
    }

    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ?? 'php';
        $books = $this->googleBooksService->searchBooks($keyword);

        return response()->json(['data' => $books]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implement the logic for showing the form to create a new resource.
    }

    public function show(string $id)
    {
        $book = $this->googleBooksService->getBook($id);

        return response()->json($book);
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Implement the logic for showing the form to edit a resource.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        // Implement the logic for updating the specified resource.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        // Implement the logic for removing the specified resource.
    }
}
