<?php

namespace App\Services;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Carbon\Carbon;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = User::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account;
        } else {
          $user = new User;
          $user->name = $providerUser->getName();
          $user->email = $providerUser->getEmail();
          $user->password = bcrypt(md5(rand(1,10000)));
          $user->api_token = str_random(60);
          $user->isadmin = 0;
          $user->status = 0;
          $user->save();
          return $user;
            // $user = User::whereEmail($providerUser->getEmail())->first();
            // if (!$user) {
            //     // $user = new User;
            //     $user = User::create([
            //         'email' => $providerUser->getEmail(),
            //         'name' => $providerUser->getName(),
            //         'password' => bcrypt(md5(rand(1,10000))),
            //     ]);
            //
            //     $user->api_token = str_random(60);
            //     $user->provider_user_id = $providerUser->getId();
            //     $user->provider = 'facebook';
            //     $user->status_updated_at =  Carbon::now();
            //     $user->isadmin = 0;
            //     $user->status = $providerUser->getId();
            // }
            //
            // // $account->user()->associate($user);
            // $user->save();
            //
            // return $user;
        }
    }
}
