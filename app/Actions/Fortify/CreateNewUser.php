<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // dd($input);
        $imageName = time().'.'.$input['image']->extension();
        $input['image']->storeAs('public/images/users/',$imageName);

        $before = User::where('status', 1)->latest()->first();
        if($before->code == null){
            $code = '1.'.date('d.m.Y').'.1';
        }else{
            $arr  = explode('.', $before->code);
            $id   = (int)$arr[0] + 1;
            $code = $id.'.'.date('d.m.Y').'.'.$id;
        }

        return User::create([
            'code' => $code,
            'name' => $input['name'],
            'username' => Str::slug($input['name']),
            'email' => $input['email'],
            'phone' => $input['phone'],
            'company' => $input['company'],
            'nik' => $input['nik'],
            'sinta_id' => $input['sinta_id'],
            'gs_id' => $input['gs_id'],
            'scopus_id' => $input['scopus_id'],
            'password' => Hash::make($input['password']),
            'profile_photo_path' => $imageName,
            'status' => 1,

        ])->assignRole('anggota');

    }
}
