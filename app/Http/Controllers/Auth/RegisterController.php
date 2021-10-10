<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $productId = $request->product ?? 1;
        $product = Product::find($productId);

        $user = $request->user() ?? new User();

        return view('register-data', [
            'product' => $product,
            'user' => $user,
        ]);
    }

    public function storeData(Request $request)
    {
        if ($request->user() == null) {
            $this->createCustomer($request);
        } else {
            $this->updateDataCustomer($request);
        }

        return back();

    }

    protected function createCustomer(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt(Str::uuid())
        ]);


        auth()->login($user);
    }

    protected function updateDataCustomer(Request $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        $user->update();
    }
}
