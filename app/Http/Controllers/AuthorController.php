<?php

namespace App\Http\Controllers;

use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    // list down author fakke data-------------------
    public $authors = [
        ['id' => 'author_001', 'name' => 'SeaVMengzz', 'bio' => 'I am an author of Khmer story', 'nationality' => 'Khmer'],
        ['id' => 'author_002', 'name' => 'YoYozz', 'bio' => 'I am an author of English story', 'nationality' => 'UK'],
        ['id' => 'author_003', 'name' => 'Ejojozz', 'bio' => 'I am an author of France story', 'nationality' => 'french'],
    ];

    // To show all authors and the empty for handle error -------------------
    public function index()
    {
        if (!empty($this->authors)) {
            return response()->json([
                'message' => 'Here are all authors',
                'data' => $this->authors
            ], 200);
        } else {
            return response()->json([
                'message' => 'No authors found'
            ], 404);
        }
    }
    // show author by id
    public function showAuthor(string $id)
    {
        foreach ($this->authors as $author) {
            if ($author['id'] == $id) {
                return response()->json([
                    'message' => 'Here is the author',
                    'data' => $author
                ], 200);
            }
        }

        // if cannot find author----
        return response()->json([
            'message' => 'Author not found'
        ], 404);
    }

    // create author 
    public function createAuthor(Request $request)
    {
        $newAuthor = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
            'nationality' => $request->input('nationality'),
        ];

        return response()->json([
            'message' => 'Author created successfully',
            'data' => $newAuthor
        ], 201);
    }

    // edit existing author
    public function editAuthor(Request $request, string $id)
    {
        foreach ($this->authors as $key => $author) {
            if ($author['id'] === $id) {
                $this->authors[$key]['name'] = $request->input('name');
                $this->authors[$key]['bio'] = $request->input('bio');
                $this->authors[$key]['nationality'] = $request->input('nationality');

                return response()->json([
                    'message' => 'Author updated successfully',
                    'data' => $this->authors[$key]
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Author not found'
        ], 404);
    }

    // Delete an author by id
    public function deleteAuthor(string $id)
    {
        foreach ($this->authors as $key => $author) {
            if ($author['id'] === $id) {
                unset($this->authors[$key]);

                return response()->json([
                    'message' => 'Author deleted successfully'
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Author not found'
        ], 404);
    }
}
