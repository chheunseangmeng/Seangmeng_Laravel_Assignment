<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{

    // just example of the data take from google------------
    public $bookStore = [
        [
            'id' => 'pncbook_01',
            'title' => 'Tum Teav',
            'authorId' => 'author_001',
            'isbn' => '97870843738',
            'publicationYear' => 1950,
            'genre' => 'Romantic Tragedy',
            'availableCopies' => 5
        ],
        [
            'id' => 'pncbook_02',
            'title' => 'Sophat',
            'authorId' => 'author_002',
            'isbn' => '9781234567890',
            'publicationYear' => 1942,
            'genre' => 'Classic Novel',
            'availableCopies' => 3
        ],
        [
            'id' => 'pncbook_03',
            'title' => 'Kolab Pailin',
            'authorId' => 'author_003',
            'isbn' => '9789876543210',
            'publicationYear' => 1955,
            'genre' => 'Drama',
            'availableCopies' => 2
        ],
        [
            'id' => 'pncbook_04',
            'title' => 'The Crocodile King',
            'authorId' => 'author_004',
            'isbn' => '9781122334455',
            'publicationYear' => 1960,
            'genre' => 'Folklore',
            'availableCopies' => 4
        ]
    ];

    // Show all books ---------------
    public function index()
    {
        return response()->json($this->bookStore, 200);
    }

    // Show book by specific id-------------------
    public function showBook(string $id)
    {
        foreach ($this->bookStore as $book) {
            if ($book['id'] === $id) {
                return response()->json($book);
            }
        }
    }
    // Create book -------------------------
    public function createBook(Request $request)
    {
        $newBook = [
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'authorId' => $request->input('authorId'),
            'isbn' => $request->input('isbn'),
            'publicationYear' => $request->input('publicationYear'),
            'genre' => $request->input('genre'),
            'availableCopies' => $request->input('availableCopies')
        ];

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $newBook
        ], 201);
    }

    // Edit book by specific id ----------------------------
    public function editBook(Request $request, string $id)
    {
        foreach ($this->bookStore as $key => $book) {
            if ($book['id'] === $id) {
                $this->bookStore[$key]['title'] = $request->input('title');
                $this->bookStore[$key]['authorId'] = $request->input('authorId');
                $this->bookStore[$key]['isbn'] = $request->input('isbn');
                $this->bookStore[$key]['publicationYear'] = $request->input('publicationYear');
                $this->bookStore[$key]['genre'] = $request->input('genre');
                $this->bookStore[$key]['availableCopies'] = $request->input('availableCopies');

                return response()->json([
                    'message' => 'Book updated successfully',
                    'book' => $this->bookStore[$key]
                ], 200);
            }
        }

        return response()->json(['error' => 'Book not found'], 404);
    }

    // Delete a book -------------------------
    public function deleteBook(string $id)
    {
        foreach ($this->bookStore as $key => $book) {
            if ($book['id'] === $id) {
                unset($this->bookStore[$key]);
                return response()->json([
                    'message' => 'Book is deleted'
                ]);
            }
            return response()->json([
                'message' => "Cannot find book"
            ], 404);
        }
    }
}