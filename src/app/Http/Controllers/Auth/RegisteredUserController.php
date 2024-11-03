<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RegisteredUserController extends Controller
{
    protected $createNewUser;

    public function __construct(CreateNewUser $createNewUser)
    {
        $this->createNewUser = $createNewUser;
    }

    public function store(Request $request)
    {
        // ユーザーを登録（自動ログインはしない）
        $this->createNewUser->create($request->all());

        // /loginにリダイレクト
        return Redirect::to('/login');
    }
}