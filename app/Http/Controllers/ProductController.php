<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Products;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Products::get();
		$data['total'] = Products::sum('total');
        return view('welcome')->with($data);
    }
	
	
	public function addProduct()
	{
        $input = Input::all();
		$product = new Products();
        $product->name = $input['pname'];
		$product->price = $input['price'];
		$product->quantity = $input['quantity'];
		$product->total = $input['quantity']*$input['price'];
		$product->save();
        echo json_encode($product);
    }
}
