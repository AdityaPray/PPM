<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    public function login()
    {
        return view('web.customer.login', [
            'title' => 'Login'
        ]);
    }

    public function register()
    {
        return view('web.customer.register', [
            'title' => 'Register'
        ]);
    }

    public function store_register(Request $request)
    {
        $validasi = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:customers,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        if ($validasi->fails()) {
            return redirect()->back()->with('errorMessage', 'Validasi error, silahkan cek kembali data anda')->withErrors($validasi)->withInput();
        } else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = \Hash::make($request->password);
            $customer->save();
            //jika berhasil tersimpan, maka redirect ke halaman login 
            return redirect()->route('customer.login')->with('successMessage', 'Registrasi Berhasil');
        }
    }
    public function store_login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Validasi
    $validasi = \Validator::make($credentials, [
        'email' => 'required|email',
        'password' => 'required'
    ]);
    if ($validasi->fails()) {
        return back()->withErrors($validasi)->withInput()->with('errorMessage', 'Validasi error');
    }

    // 🔍 Coba login sebagai admin (users table, guard:web)
    if (\Auth::guard('web')->attempt($credentials)) {
        return redirect()->route('dashboard')->with('successMessage', 'Login sebagai admin berhasil');
    }

    // 🔍 Coba login sebagai customer (customers table, guard:customers)
    $customer = Customer::where('email', $credentials['email'])->first();
    if ($customer && \Hash::check($credentials['password'], $customer->password)) {
        \Auth::guard('customers')->login($customer);
        return redirect()->route('home')->with('successMessage', 'Login sebagai customer berhasil');
    }

    return back()->withInput()->with('errorMessage', 'Email atau password salah');
}

    public function logout(Request $request)
    {
        \Auth::guard('customers')->logout();
        return redirect()->route('customer.login')
            ->with('successMessage', 'Anda telah berhasil logout');
    }
}
