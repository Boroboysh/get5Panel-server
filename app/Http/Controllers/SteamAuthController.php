<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Ilzrv\LaravelSteamAuth\SteamAuth;
use Ilzrv\LaravelSteamAuth\SteamData;

class SteamAuthController extends Controller
{
    /**
     * Экземпляр SteamAuth.
     *
     * @var SteamAuth
     */
    protected SteamAuth $steamAuth;

    /**
     * Куда перенаправлять пользователей после входа в систему.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Куда перенаправлять пользователей после конструктора loginSteamAuthController.
     *
     * @param SteamAuth $steamAuth
     */
    public function __construct(SteamAuth $steamAuth)
    {
        $this->steamAuth = $steamAuth;
    }

    /**
     * Получить данные пользователя и войти в систему
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        if (!$this->steamAuth->validate()) {
            return $this->steamAuth->redirect();
        }

        $data = $this->steamAuth->getUserData();

        if (is_null($data)) {
            return $this->steamAuth->redirect();
        }

        Auth::login(
            $this->firstOrCreate($data),
            true
        );

        return redirect($this->redirectTo);
    }


    /**
     * Получите первого пользователя по SteamID или создайте нового
     *
     * @param SteamData $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    protected function firstOrCreate(SteamData $data): \Illuminate\Database\Eloquent\Model|User
    {
        return User::firstOrCreate([
            'steamid' => $data->getSteamId(),
        ], [
            'nickname' => $data->getPersonaName(),
            'avatar' => $data->getAvatarFull(),
            'profileUrl' => $data->getProfileUrl()
        ]);
    }
}
