<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function index(){
       
        try{
         $Customers = Customer::all();
         return response()->json(["categories",$Customers], 200);
        
       }
       catch(QueryException $e) {
              return response()->json(['message' => 'An error occurred while processing your request.'], 500);
          }
   
       }
  
  
        public function store(Request $request)
        {
   
         try{
           $Customer = new Customer();
           $Customer->username = $request['username'];
           $Customer->fname = $request['fname'];
           $Customer->lname = $request['lname'];
           $Customer->password = $request['password'];
           $Customer->email = $request['email'];

         

           $Customer->save();
           return response()->json(['message' => 'Customer added successfully.'], 200);
         }
         catch(QueryException $e) {
           return response()->json(['message' => 'An error occurred while processing your request.'], 500);
         }
   
   
   
        }
    
        // Display the specified resource.
        public function show($id)
        {
        
         try{
   
           $Customer = Customer::findOrFail($id);
   
           return response()->json(["Customer",$Customer], 200);
         
         } 
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   
           return response()->json(['message' => 'Customer not found'], 404);
          
         }
         catch(QueryException $e) {
                return response()->json(['message' => 'An error occurred while processing your request.'], 500);
            }
     
         
       }
    
      
        public function update(Request $request,$id)
        {
         try{
           $Customer= Customer::findOrFail($id);
           $Customer->name = $request['name'];
           $Customer->email = $request['email'];
           $Customer->phone = $request['phone'];
           $Customer->address = $request['address'];
           $Customer->save();
           return response()->json(['message' => 'Customer updated successfully.'], 200);
         }
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   
           return response()->json(['message' => 'Customer not found'], 404);
          
         }
         catch(QueryException $e) {
           return response()->json(['message' => 'An error occurred while processing your request.'], 500);
         }
   
        }
    
        // Remove the specified resource from storage.
        public function destroy($id)
        {
         try{
           $Customer = Customer::findOrFail($id);
           $Customer->delete();
           return response()->json(['message' => 'Customer deleted successfully.'], 200);
   
          }
          catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    
            return response()->json(['message' => 'Customer not found'], 404);
           
          }
          catch(QueryException $e) {
            return response()->json(['message' => 'An error occurred while processing your request.'], 500);
          }
    
         }
   }