<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth', 'role:Customer']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::with('products.discounts')->get();

        foreach ($categories as $category) {
            foreach ($category->products as $product) {
                $product->discount =  Discount::where('product_id', $product->id)
                    ->where('start_date', "<=", date('Y-m-d'))
                    ->where('end_date', '>=', date('Y-m-d'))->first();

                if ($product->discount == null) {
                    $product->discount = (object)[
                        "percentage" => 0
                    ];
                }

                $product->potongan = $product->discount->percentage / 100 * $product->price;
                $product->new_price = $product->price - $product->potongan;
            }
        }

        // dd($categories);

        $carts = Transaction::where('user_id', Auth::user()->id)->where('status', 'unpaid')->get();
        // $jumlah_cart = count($carts);
        $jumlah_cart = $carts->sum('quantity');

        return view('customer.home', compact('categories', 'jumlah_cart',));
    }

    public function addToCart(Request $request)
    {
        $same = Transaction::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->where('status', 'unpaid')->first();

        // dd($same);
        $trans = Transaction::where('product_id', $request->product_id)->get();

        if ($same) {
            foreach($trans as $tr){
                $transaction = $tr->update([
                    'quantity' => $tr->quantity += $request->quantity
                ]);
            }
        }else{
            $transaction = Transaction::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::user()->id,
                'quantity' => $request->quantity
            ]);
        }
        return redirect()->back()->with('status', 'Berhasil menambahkan ke keranjang')->with('data', $transaction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
