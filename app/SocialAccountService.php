<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccountService extends Model
{
    public function findOrCreate(User $providerUser, $provider)
    {
        $account = User::where('provider', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $user = User::where('email', $providerUser->getEmail())->first();

            if (! $user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name'  => $providerUser->getName(),
                ]);
            }

            $user->accounts()->create([
                'provider_id'   => $providerUser->getId(),
                'provider' => $provider,
            ]);

            return $user;

        }
    }
}
