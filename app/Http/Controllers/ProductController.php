<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){
       
        try{
         $Products = Product::all();
         return response()->json(["Products",$Products], 200);
        
       }
       catch(QueryException $e) {
              return response()->json(['message' => 'An error occurred while processing your request.'], 500);
          }
   
       }
   


  
        public function store(Request $request)
        {
   
         try{
           $Product = new Product();
           $Product->name = $request['name'];
           $Product->description = $request['description'];
           $Product->img_url = $request['img_url'];

           $Product->price = $request['price'];
           $Product->quantity = $request['quantity'];
           $Product->weight = $request['weight'];

           $Product->category_id = $request['category_id'];
           $Product->employee_id  = $request['employee_id'];

           $Product->save();
           return response()->json(['message' => 'Product added successfully.'], 200);
         }
         catch(QueryException $e) {
           return response()->json(['message' => 'An error occurred while processing your request.'], 500);
         }
   
   
   
        }
    
        // Display the specified resource.
        public function show($id)
        {
        
         try{
   
           $Product = Product::findOrFail($id);
   
           return response()->json(["Product",$Product], 200);
         
         } 
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   
           return response()->json(['message' => 'Product not found'], 404);
          
         }
         catch(QueryException $e) {
                return response()->json(['message' => 'An error occurred while processing your request.'], 500);
            }
     
         
       }
    
      
        public function update(Request $request,$id)
        {
         try{
           $Product= Product::findOrFail($id);
         $Product = new Product();
           $Product->name = $request['name'];
           $Product->description = $request['description'];
           $Product->img_url = $request['img_url'];

           $Product->price = $request['price'];
           $Product->quantity = $request['quantity'];
           $Product->weight = $request['weight'];
           
           $Product->category_id = $request['category_id'];
           $Product->employee_id  = $request['employee_id'];
           $Product->save();
           return response()->json(['message' => 'Product updated successfully.'], 200);
         }
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   
           return response()->json(['message' => 'Product not found'], 404);
          
         }
         catch(QueryException $e) {
           return response()->json(['message' => 'An error occurred while processing your request.'], 500);
         }
   
        }
    
        // Remove the specified resource from storage.
        public function destroy($id)
        {
         try{
           $Product = Product::findOrFail($id);
           $Product->delete();
           return response()->json(['message' => 'Product deleted successfully.'], 200);
   
          }
          catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    
            return response()->json(['message' => 'Product not found'], 404);
           
          }
          catch(QueryException $e) {
            return response()->json(['message' => 'An error occurred while processing your request.'], 500);
          }
    
         }
   }