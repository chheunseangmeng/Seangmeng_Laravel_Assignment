<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use Illuminate\Support\Facades\Validator;



class BookController extends Controller
{


    // Show all books ---------------
    public function index()
    {
        $books = new Book();
        return response()->json([
            'message' => 'Book show Successfully',
            'data' => $books::all(),
        ], 200);
    }


    // create book function----------------------
    public function createBook(BookStoreRequest $request)
    {
        $books = Book::create($request->all([], 200));
        return response()->json([
            "message" => "Success",
            "data" => $books
        ]);
    }

    // edit book function---------------------------
    public function editBook(BookUpdateRequest $request, int $id)
{
    $book = Book::find($id);
    $book->update($request->validated());
    return response()->json([
        'message' => "Success",
        'data' => $book
    ], 200);
}

    // delete function ----------------------------------
    public function deleteBook(int $id){
        $books = Book::where('id', $id)->delete();
         if($books){
            return response()->json([
                'message' => "Book deleted"
            ], 201);
        }
        return response()->json([
            'message' => "Book failed to delete"
        ], 400);  
    }

    // show by id ---------------------------------------
    public function showBook(int $id) {
        $books = Book::Where('id', $id)->get();
           if($books){
            return response()->json([
                'message' => "Book show successfully",
                'data' => $books,
            ], 201);
        }
        return response()->json([
            'message' => "failed to show" . $id . "not found"
        ], 400);  
    }
   
}
