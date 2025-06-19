<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;

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
    public function createBook(Request $request)
    {
        $books = Book::create([
            "title" => $request->title,
            "authorId" => $request->authorId,
            "isbn" =>$request->isbn,
            "publicationYear" =>$request->publicationYear,
            "gener" =>$request->gener,
            "availableCopies" => $request-> availableCopies
        ]);
        if ($books) {
            return response()->json([
                'message' => "Book is created successfully"
            ], 201);
        }
        return response()->json([
            'message' => "Book is failed create!!!"
        ], 400);
    }

    // edit book function---------------------------
     public function editBook(Request $request,int $id){
        $books = Book::Where('id', $id)
        -> update([
            "title" => $request->title,
            "authorId" => $request->authorId,
            "isbn" =>$request->isbn,
            "publicationYear" =>$request->publicationYear,
            "gener" =>$request->gener,
            "availableCopies" => $request-> availableCopies
        ]);
        if($books){
            return response()->json([
                'message' => "Book is created successfully"
            ], 201);
        }
        return response()->json([
            'message' => "Book is failed create!!!"
        ], 400);  
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
