<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        // Only admins can create users from the admin panel
        $user = $this->user();
        return $user && in_array($user->role ?? $user->account_type, ['admin', 'super admin']);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'account_type' => 'required|string|in:user,kafaa,admin',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ];
    }
}
