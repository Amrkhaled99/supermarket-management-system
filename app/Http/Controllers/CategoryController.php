<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    
    public function index(){
       
     try{
      $categories = Category::all();
      return response()->json(["categories",$categories], 200);
     
    }
    catch(QueryException $e) {
           return response()->json(['message' => 'An error occurred while processing your request.'], 500);
       }

    }

     // Show the form for creating a new resource.
    //  public function create()
    //  {

    //  }
 
     // Store a newly created resource in storage.
     public function store(Request $request)
     {

      try{
        $category = new Category();
        $category->name = $request['name'];
        $category->img_url = $request['img_url'];
        $category->save();
        return response()->json(['message' => 'Category added successfully.'], 200);
      }
      catch(QueryException $e) {
        return response()->json(['message' => 'An error occurred while processing your request.'], 500);
      }

      // return redirect('/')->with('success', 'Category created successfully!');


     }
 
     // Display the specified resource.
     public function show($id)
     {
     
      try{

        $category = Category::findOrFail($id);

        return response()->json(["category",$category], 200);
      
      } 
      catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

        return response()->json(['message' => 'Category not found'], 404);
       
      }
      catch(QueryException $e) {
             return response()->json(['message' => 'An error occurred while processing your request.'], 500);
         }
  
      
    }
 
     // Show the form for editing the specified resource.
    //  public function edit($id)
    //  {
    //      // Your code here
    //  }
 
     // Update the specified resource in storage.
     public function update(Request $request,$id)
     {
      try{
       // $category = new Category();
        $category= Category::findOrFail($id);
        $category->name = $request['name'];
        $category->img_url = $request['img_url'];
        $category->save();
        return response()->json(['message' => 'Category updated successfully.'], 200);
      }
      catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

        return response()->json(['message' => 'Category not found'], 404);
       
      }
      catch(QueryException $e) {
        return response()->json(['message' => 'An error occurred while processing your request.'], 500);
      }

     }
 
     // Remove the specified resource from storage.
     public function destroy($id)
     {
      try{
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.'], 200);

       }
       catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
 
         return response()->json(['message' => 'Category not found'], 404);
        
       }
       catch(QueryException $e) {
         return response()->json(['message' => 'An error occurred while processing your request.'], 500);
       }
 
      }
}

