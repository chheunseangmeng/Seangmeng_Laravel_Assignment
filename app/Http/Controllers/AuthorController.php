<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Get all authors
    public function index()
    {
        $authors = Author::all();

        if ($authors->isEmpty()) {
            return response()->json([
                'message' => 'No authors found'
            ], 404);
        }

        return response()->json([
            'message' => 'Here are all authors',
            'data' => $authors
        ], 200);
    }


    // get author by name only
    public function getAuthorName($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        return response()->json([
            'author_name' => $author->name
        ], 200);
    }


    // Get one author by ID
    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Here is the author',
            'data' => $author
        ], 200);
    }

    // find book by author id
    public function booksByAuthor($id)
    {
        $author = Author::with('books')->find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Books retrieved successfully',
            'author' => $author->name,
            'books' => $author->books,
        ], 200);
    }


    // Create a new author
    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return response()->json([
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    // Update existing author
    public function update(AuthorRequest $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        $author->update($request->validated());

        return response()->json([
            'message' => 'Author updated successfully',
            'data' => $author
        ], 200);
    }

    // Delete author
    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully'
        ], 200);
    }
}
