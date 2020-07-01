<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use App\SaleTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    /**
     * Show the application checkout.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkout(Request $request)
    {
        if ( ! $request->session()->has('cart') ) {
            $this->setInitStateCartSession($request);
        }

        $cart = session('cart');
        return view('site.checkout')->with('cart', $cart);
    }

    /* Get shop products */
    public function getShopProducts(Request $request)
    {
        $products = Product::where('status', True)
                        ->with('category')
                        ->get();

        $data = [
            'products' => $products
        ];

        return $this->JsonResponse('Products Found', 200, $data);
    }

    /*
        Add the product selected to the current cart session, if does not exist will be created
    */
    public function addProductToCart(Request $request)
    {
        $total = $request['total'];
        $productId = $request['product_id'];

        /* create the cart session if not exist */
        if ( ! $request->session()->has('cart') ) {
            $this->setInitStateCartSession($request);
        }

        $cart = session('cart');

        $productObject = Product::where('id', $productId)
                                ->with('category')
                                ->firstOrFail();

        /*
            we found the current selected product by Id, if exist in the cart session we need to update the total, otherwise
            create and array with the product info
        */
        if ( array_key_exists($productId, $cart['products']) ) {
            $cart['products'][$productId]['total'] += $total;
        } else {
            $cart['products'][$productId] = [
                'total' => $total,
                'product' => $productObject
            ];
        }

        $cart['total'] += $total;

        $request->session()->put('cart', $cart);

        return $this->JsonResponse('Cart updated succesfully', 200, $cart);
    }

    protected function setInitStateCartSession($request)
    {
        $newCartSession = [
            'total'     => 0,
            'products'  => []
        ];

        $request->session()->put('cart', $newCartSession);
    }

    public function getCartSession(Request $request)
    {
        $cart = session('cart');
        return $this->JsonResponse('Cart session get succesfully', 200, $cart);
    }

    /*
        Store reservetaion, this method use the current data cart saved on session
    */
    public function storeSale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address'       => 'required',
            'region'        => 'required',
            'country'       => 'required',
            'city'          => 'required',
            'zip_code'      => 'required',
            'exp_month'     => 'required',
            'exp_year'      => 'required',
            'cvc'           => 'required',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone'         => 'required'
        ]);

        if ( $validator->fails() ) {
            return $this->JsonResponse('Invalid parameters', 200, null, $validator->errors()->all());
        }

        $cart = session('cart');
        $total = 0;
        $productIds = [];

        foreach ($cart['products'] as $key => $product) {
            $total += $product['total'] * $product['product']->price;
            array_push($productIds,  $product['product']->id);
        }

        try {
            DB::transaction(function() use ($request, $total, $productIds) {
                $sale = new Sale();
                $sale->subtotal = $total;
                $sale->total    = $total;
                $sale->notes    = '';
                $sale->save();

                /* Attach products related to the sale cart */
                /* $sale->products()->atach($productIds);
                $sale->save(); */

                $saleTransaction = new SaleTransaction();
                $saleTransaction->name                 = "{$request->first_name} + {$request->last_name}";
                $saleTransaction->subtotal             = $total;
                $saleTransaction->total                = $total;
                $saleTransaction->address              = $request->address;
                $saleTransaction->country              = $request->country;
                $saleTransaction->exp_month            = $request->exp_month;
                $saleTransaction->exp_year             = $request->exp_year;
                $saleTransaction->card_last_numbers    = '1234';
                $saleTransaction->gateway_response     = json_encode([]);
                $saleTransaction->sale_id              = $sale->id;
                $saleTransaction->save();
            });

            /* Clear session storage */
            $this->setInitStateCartSession($request);

            return $this->JsonResponse("Sale successfully created");
        } catch ( \Exception $e ) {
            return $this->JsonResponse('Error creating the sale', 200, null, $e->getMessage());
        }
    }

    /* Delete item from cart session */
    public function deleteProductSession($id, Request $request)
    {
        try {
            if( ! $id ) {
                throw new Exception("Product identifier is required");
            }

            $cart = session('cart');

            if ( $cart['products'][$id]['total'] > 1 ) {
                $cart['products'][$id]['total'] -= 1;
            } else {
                unset($cart['products'][$id]);
                $request->session()->put('cart', $cart);
            }

            $cart['total'] -= 1;

            if ( $cart['total'] < 1 ) {
                $this->setInitStateCartSession($request);
            } else {
                $request->session()->put('cart', $cart);
            }


            return $this->JsonResponse('Product successfully deleted');
         } catch( Exception $e ) {
            return $this->JsonResponse('Error deleting the product', 200, null, $e->getMessage());
        }
    }
}
