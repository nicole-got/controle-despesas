<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Auth;

class DashboardController extends Controller
{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function Index()
    {
        $expenses = \App\Entities\Expense::all();
        foreach($expenses as $key => $expense){
            $u = $this->repository->find($expense->user_id);
            $expenses[$key]->user_id = $u->name;
        }
        $users = $this->repository->all();

        return view('user.dashboard', [
            'expenses' => $expenses,
            'users' => $users,
        ]);
    }

    public function auth(Request $request)
    {

        $data = [
            'email'     => $request->get('username'),
            'password'  => $request->get('password')
        ];

        try
        {
            $user = $this->repository->findWhere($data)->first();
            if(!$user) throw new Exception("Credenciais inválidas");

            Auth::login($user);
            return redirect()->route('user.dashboard');
        }
        catch (Exception $err)
        {
            return $err->getMessage();
        }

    }
}
