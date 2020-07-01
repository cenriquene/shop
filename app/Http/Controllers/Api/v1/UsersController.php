<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $data = [
            'users' => $users
        ];

        return $this->JsonResponse('Users Found', 200, $data);
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
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6'
        ]);

        if ( $validator->fails() ) {
            return $this->JsonResponse('Invalid parameters', 200, null, $validator->errors()->all());
        }

        $encryptedPassword = Hash::make($request->password);

        $user               = new User();
        $user->name         = $request->name;
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->password     = $encryptedPassword;

        try {
            $user->save();

            return $this->JsonResponse('User successfully created');
        } catch ( \Exception $e ) {
            return $this->JsonResponse('Error creating the user', 200, null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if( ! $id ){
                throw new Exception("User identifier not found");
            }

            $user = User::where('id', $id)->firstOrFail();

            $data = [
                'user' => $user
            ];

            return $this->JsonResponse('User found', 200, $data);
        } catch( \Exception $e ){
            return $this->JsonResponse('Error obtaining the user', 200, null, $e->getMessage());
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
                throw new Exception("User identifier not found");
            }

            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required|string|email|max:255',
            ]);

            if ( $validator->fails() ) {
                throw new Exception('All fields are required.');
            }

            $user = User::where('id', $id)->firstOrFail();

            $user->name         = $request->name;
            $user->first_name   = $request->first_name;
            $user->last_name    = $request->last_name;
            $user->email        = $request->email;

            $user->save();
            return $this->JsonResponse('User successfully updated');
        } catch( \Exception $e ){
            return $this->JsonResponse('Error obtaining the user', 200, null, $e->getMessage());
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
                throw new Exception("User identifier is required");
            }

            $user = User::where('id', $id)->firstOrFail();
            $user->delete();

            return $this->JsonResponse('User successfully deleted');
         } catch( Exception $e ) {
            return $this->JsonResponse('Error deleting the user', 200, null, $e->getMessage());
        }
    }
}
