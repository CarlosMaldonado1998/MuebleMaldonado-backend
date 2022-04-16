<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Models\Bill;
use App\Models\Order;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\BillCollection;
use App\Http\Resources\OrderCollection;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::user();
        return response()->json(compact('token', "user" ))
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'), // ttl = time to leve
                '/', //path
                null, // domain
                config('app.env') !== 'local', //Secure
                true, //httpObly
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax' //SameSite
            );
    }
    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'lastname' => 'required|string|max:255',
            'cellphone' => 'required',
            'city' => 'required|string|max:255',
            'role' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'lastname' => $request->get('lastname'),
            'cellphone' => $request->get('cellphone'),
            'city' => $request->get('city'),
            'role' => $request->get('role')
        ]);

        return response()->json(compact('user'),201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(New UserResource($user),200);
    }


    public function index()
    {
        $this->authorize('viewAny', User::class);
        return new UserCollection(User::paginate(10));
    }
    
    public function showAll()
    {
        $this->authorize('viewAny', User::class);
        return new UserCollection(User::all());
    }

    public function show(User $user){
        $this->authorize('view',$user);
        return response()->json(new UserResource($user),200);
    }

    public function showMyBills(User $user){
        $this->authorize('view',$user);
        $bill = Bill::where("user_id", $user['id'])->get();
        return response()->json(new BillCollection($bill), 200);
    }

    public function showMyOrdersBills(User $user, Bill $bill){
        $this->authorize('view',$user);
        $bill = Order::where("user_id", $user['id'])->where("bill_id", $bill['id'])->get();
        return response()->json(new OrderCollection($bill), 200);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update',$user);
        $user->update($request->only([
            'name',
            'email',
            'lastname' ,
            'cellphone' ,
            'city' ,
            ]
        ));
        return response()->json($user,200);
    }
    public function delete(User $user)
    {
        $this->authorize('delete',$user);
        $user->delete();
        return response()->json(null,204);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

//            Cookie::queue(Cookie::forget('token'));
//            $cookie = Cookie::forget('token');
//            $cookie->withSameSite('None');
            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ], 200)
                ->withCookie('token', null,
                    config('jwt.ttl'),
                    '/',
                    null,
                    config('app.env') !== 'local',
                    true,
                    false,
                    config('app.env') !== 'local' ? 'None' : 'Lax'
                );
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesión."], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->authorize('update',$user);
        
        $request->validate([
            'current_password' => 'required|min:6|current_password',
            'password' => 'required|min:6|confirmed'
        ]);
        $user->update([
            'password' => Hash::make($request->get('password')),
        ]);
        return response()->json($user, 200);
    }
}
