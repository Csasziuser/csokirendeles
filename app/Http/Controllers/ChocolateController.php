<?php

namespace App\Http\Controllers;

use App\Models\Chocolate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChocolateController extends Controller
{
    public function store(Request $request){
        try {
            $request->validate([
                "brand" =>'required|string|max:255', 
                "chocolate_name" =>'required|string|max:255',
                "price" =>'required|integer|min:1',
                "expiry_date"=>'required|date|after_or_equal:today'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
        

        Chocolate::create([
            "brand" =>$request->brand, 
            "chocolate_name" =>$request->chocolate_name,
            "price" =>$request->price,
            "expiry_date"=>$request->expiry_date
        ]);

        return response()->json(['success'=>true,'message'=>'Chocolate created!']);
    }
}
