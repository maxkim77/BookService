<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class OauthController extends Controller
{
    public function redirectToGoogle() 
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Socialite가 인가 코드를 사용하여 Google에서 액세스 토큰을 요청하고 사용자 정보를 가져옵니다.
            $user = Socialite::driver('google')->user();
            
            // 이메일을 기준으로 사용자 데이터베이스에서 사용자를 찾습니다.
            $findUser = User::where('email', $user->email)->first();
            
            // 사용자가 존재하면 로그인 처리
            if ($findUser) {
                Auth::login($findUser);
            } else {
                // 사용자가 존재하지 않으면 새 사용자 생성 후 로그인 처리
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_type' => 'google',
                    'oauth_id' => $user->id,
                ]);
                Auth::login($newUser);
                
            }
            
            // 로그인 후 홈 페이지로 리디렉션합니다.
            return redirect('/');
        } catch (\Exception $e) {
            // 예외가 발생하면 다시 Google 로그인 페이지로 리디렉션합니다.
            return redirect('/auth/google');
        }
    }
}