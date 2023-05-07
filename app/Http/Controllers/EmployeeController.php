<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(){
       
        try{
         $Employees = Employee::all();
         return response()->json(["Employees",$Employees], 200);
        
       }
       catch(QueryException $e) {
              return response()->json(['message' => 'An error occurred while processing your request.'], 500);
          }
   
       }
  
  
        public function store(Request $request)
        {
   
         try{
           $Employee = new Employee();
           $Employee->username = $request['username'];
           $Employee->fname = $request['fname'];
           $Employee->lname = $request['lname'];
           $Employee->password = $request['password'];
           $Employee->email = $request['email'];
           $Employee->type = 1;
           $Employee->isAdmin =  $request['isAdmin'];

         
           $Employee->save();
           return response()->json(['message' => 'Employee added successfully.'], 200);
         }
         catch(QueryException $e) {
           return response()->json(['message' => 'An error occurred while processing your request.'], 500);
         }
   
   
   
        }
    
        // Display the specified resource.
        public function show($id)
        {
        
         try{
   
           $Employee = Employee::findOrFail($id);
   
           return response()->json(["Employee",$Employee], 200);
         
         } 
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   
           return response()->json(['message' => 'Employee not found'], 404);
          
         }
         catch(QueryException $e) {
                return response()->json(['message' => 'An error occurred while processing your request.'], 500);
            }
     
         
       }
    
      
        public function update(Request $request,$id)
        {
         try{
           $Employee= Employee::findOrFail($id);
           $Employee->name = $request['name'];
           $Employee->email = $request['email'];
           $Employee->phone = $request['phone'];
           $Employee->address = $request['address'];
           $Employee->save();
           return response()->json(['message' => 'Employee updated successfully.'], 200);
         }
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   
           return response()->json(['message' => 'Employee not found'], 404);
          
         }
         catch(QueryException $e) {
           return response()->json(['message' => 'An error occurred while processing your request.'], 500);
         }
   
        }
    
        // Remove the specified resource from storage.
        public function destroy($id)
        {
         try{
           $Employee = Employee::findOrFail($id);
           $Employee->delete();
           return response()->json(['message' => 'Employee deleted successfully.'], 200);
   
          }
          catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    
            return response()->json(['message' => 'Employee not found'], 404);
           
          }
          catch(QueryException $e) {
            return response()->json(['message' => 'An error occurred while processing your request.'], 500);
          }
    
         }
   }