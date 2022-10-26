<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        //validater
        $validator = Validator::make($request->all(),[
            'name' => 'string|required|min:4',
            'email' => 'string|email|required|max:100|unique:users',
            
        ]);
        if($validator->fails()){
            $response = [
                'message' => $validator->errors()
            ];
            return response()->json($response,409);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;

        $response = [
            'data' => $success,
        ];

        return response()->json($response,200);
    }

    Public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::User();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;

            $response = [
                'data' => $success,
            ];

            return response()->json($response,200);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'unauthorised'
            ];
            return response()->json($response,401);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout successfully',
        ],200);
    }

    public function update(Request $request)
    {
        $user=User::find($id);
        $user->update($request->all());
            return $user();
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
        ]);

        return response()->json([
            'status' => true,
            'message' => "Updated successfully!",
            
        ], 200);
    }


     Public function destroy($id){
         return User::destroy($id);
     }
}
