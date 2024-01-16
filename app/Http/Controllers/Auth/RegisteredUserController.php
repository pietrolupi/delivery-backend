<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();
        return view('auth.register', compact('types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'vat' => ['required', 'string', 'max:13', 'min:13', 'unique:'.User::class],
            'restaurant_name' => ['required', 'string', 'min:2', 'max:255'],
            'restaurant_address' => ['required', 'string', 'min:5', 'max:255'],
        ],

        [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.min' => 'The name must be at least :min characters.',
            'name.max' => 'The name may not be greater than :max characters.',

            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.lowercase' => 'The email must be in lowercase.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than :max characters.',
            'email.unique' => 'This email has already been registered.',

            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',

            'vat.required' => 'You must provide your VAT code.',
            'vat.string' => 'The VAT must be a string.',
            'vat.min' => 'Your VAT must have :min characters.',
            'vat.max' => 'Your VAT must have :max characters.',
            'vat.unique' => 'This VAT code has already been registered.',

            'restaurant_name.required' => 'The restaurant name field is required.',
            'restaurant_name.string' => 'The restaurant name must be a string.',
            'restaurant_name.min' => 'The restaurant name may not be smaller the :min characters.',
            'restaurant_name.max' => 'The restaurant name may not be greater than :max characters.',

            'restaurant_address.required' => 'The restaurant address field is required.',
            'restaurant_address.string' => 'The restaurant address must be a string.',
            'restaurant_address.min' => 'The restaurant address may not be smaller than :min characters.',
            'restaurant_address.max' => 'The restaurant address may not be greater than :max characters.',

        ]);

        $form_data = $request->all();

        $user = User::create([
            'name' => $form_data['name'],
            'email' => $form_data['email'],
            'password' => Hash::make($form_data['password']),
            'vat' => $form_data['vat'],
        ]);

        $restaurant = new Restaurant([
            'user_id' => $user->id,
            'name' => $form_data['restaurant_name'],
            'address' => $form_data['restaurant_address'],
        ]);

        if ($request->hasFile('image')) {
            $form_data['image'] = $request->file('image')->store('uploads');
            $restaurant->image = $form_data['image'];
        }

        $restaurant->save();

        if (!empty($form_data['types'])) {
            $restaurant->types()->attach($form_data['types']);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
