<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\books;
use Exception;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    public function index(){
        try{
            $books = books::all();
            return response()->json([
                'message' => 'Success',
                'data' => $books
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store(Request $request){
        try{
            $validate = $request->validate([
                'title' => 'required|string',
            'author' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
            'image' => 'required|string',
            
            ]);
            $books = Books::create($validate);
            return response()->json([
                'message'=> 'Book created successfully',
                'data' => $books
            ],201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request,$id){
        try{
            $validate = $request->validate([
                'title' => 'sometimes|required|string',
                'author' => 'sometimes|required|string',
                'published_at' => 'sometimes|required|string',
            ]);
            $books = books::find($id);
            $books->update($validate);
            return response()->json([
                'message' => 'Book updated successfully', 
                'data' => $books
            ],200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id){
        try{
            $Books = books::find($id);
            $Books->delete();
            if ($Books) {
                return response()->json([
                    'message' => 'Book deleted successfully',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Books not found'
                ], 404);
            }
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show ($id){
        try{

            $books = books::find($id);
            if ($books) {
                return response()->json([
                    'message' => 'Books found',
                    'data' => $books
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Books not found'
                ], 404);
            }
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}