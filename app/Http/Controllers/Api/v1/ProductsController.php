<?php

namespace App\Http\Controllers\Api\v1;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', True)
                        ->with('category')
                        ->get();

        $data = [
            'products' => $products
        ];

        return $this->JsonResponse('Products Found', 200, $data);
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
        $slug = Str::slug($request->name);

        $request->request->add(['slug' => $slug]);

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
            'status'        => 'required',
            'price'         => 'required',
            'slug'          => 'required|string|unique:products',
            'category_id'   => 'required'
        ]);


        if ( $validator->fails() ) {
            return $this->JsonResponse('Invalid parameters', 200, null, $validator->errors()->all());
        }

        $product                = new Product();
        $product->name          = $request->name;
        $product->description   = $request->description;
        $product->status        = $request->status;
        $product->price         = $request->price;
        $product->slug          = $slug;
        $product->category_id   = $request->category_id;

        try {
            $product->save();

            return $this->JsonResponse('Product successfully created');
        } catch ( \Exception $e ) {
            return $this->JsonResponse('Error creating the product', 200, null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
                        ->with('category')
                        ->first();

        return view('site.details')->with('product', $product);
    }

    public function getProductById($id)
    {
        try {
            if( ! $id ){
                throw new Exception("Product identifier not found");
            }

            $product = Product::where('id', $id)->firstOrFail();

            $data = [
                'product' => $product
            ];

            return $this->JsonResponse('Product found', 200, $data);
        } catch( \Exception $e ){
            return $this->JsonResponse('Error obtaining the product', 200, null, $e->getMessage());
        }
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
        try {
            if( ! $id ){
                throw new Exception("Product identifier not found");
            }

            $slug = Str::slug($request->name);
            $request->request->add(['slug' => $slug]);

            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'description'   => 'required',
                'status'        => 'required',
                'price'         => 'required',
                'slug'          => 'required|string|unique:products',
                'category_id'   => 'required'
            ]);

            if ( $validator->fails() ) {
                throw new Exception('All fields are required.');
            }

            $product = Product::where('id', $id)->firstOrFail();

            $product->name          = $request->name;
            $product->description   = $request->description;
            $product->status        = $request->status;
            $product->price         = $request->price;
            $product->slug          = $slug;
            $product->category_id   = $request->category_id;

            $product->save();
            return $this->JsonResponse('Product successfully updated');
        } catch( \Exception $e ){
            return $this->JsonResponse('Error obtaining the product', 200, null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if( ! $id ) {
                throw new Exception("Product identifier is required");
            }

            $product = Product::where('id', $id)->firstOrFail();
            $product->delete();

            return $this->JsonResponse('Product successfully deleted');
         } catch( Exception $e ) {
            return $this->JsonResponse('Error deleting the product', 200, null, $e->getMessage());
        }
    }
}
