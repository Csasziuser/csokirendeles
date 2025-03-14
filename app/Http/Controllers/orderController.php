<?php

namespace App\Http\Controllers;

use App\Models\Chocolate;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\returnArgument;

class orderController extends Controller
{
    public function store (Request $request){
       try{
        $request->validate([
            'email'=> 'required|email',
            'address'=> 'required|string|max:250',
            'chocolate_id'=> 'required|exists:chocolates,id',
            'count'=> 'required|integer|min:1|max:40'
        ]);
       }catch(ValidationException $th){
        return response()->json(['success'=> false, 'mesaage'=> $th->errors()], 400, options: JSON_UNESCAPED_UNICODE);
       }
       $chocolate = Chocolate::find(($request->chocolate_id));
       $total_price = $chocolate-> price *$request->count;

       Order::create([
        'email' => $request->email,
        'address' => $request->address,
        'chocolate_id' => $request->chocolate_id,
        'count' => $request->count,
        'all_price' => $total_price
       ]);
       return response()->json(['success' => true, 'message' => 'Sikeres rendelés'], 200, options: JSON_UNESCAPED_UNICODE);
    }

    public function index(){
        $orders = Order::all();
        return response()->json($orders, 200, options: JSON_UNESCAPED_UNICODE);
    }
}
