<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ExpenseCreateRequest;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Repositories\ExpenseRepository;
use App\Validators\ExpenseValidator;
use App\Services\ExpenseService;


class ExpensesController extends Controller
{
    protected $repository;
    protected $service;
    protected $validator;

    
    public function __construct(ExpenseService $service,ExpenseRepository $repository, ExpenseValidator $validator)
    {
        $this->repository = $repository;
        $this->service      = $service;
    }


    public function index()
    {
        $users = \App\Entities\User::pluck("name","id")->all();
        $expenses = \App\Entities\Expense::all();
        foreach($expenses as $key => $expense){
            $user = \App\Entities\User::find($expense->user_id);
            if($user == "[]"){
                $expenses[$key]->user_id = "";
            }else{
                $expenses[$key]->user_id = $user->name;
            }
        }
        
        return view('expense.index', [
            'users' => $users,
            'expenses' => $expenses,
        ]);
    }

    public function search(ExpenseCreateRequest $request)
    {
        $expenses =  $this->service->search($request->id);
        
        return view('expense.index', [
            'expenses'  => $expenses,
        ]);
        
    }

    public function store(ExpenseCreateRequest $request)
    {
        
        if($request->hasFile('image')){
            $nameExt = $request->file('image')->getClientOriginalName();
            $name = pathinfo($nameExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $nameSave = $name.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public\img', $nameSave);
        }else{
            $nameSave = "noimage.png";
        }

        $data = [
            'user_id'       => $request->input('user_id'),
            'description'   => $request->input('description'),
            'date'          => $request->input('date'),
            'image'         => $nameSave,
            'value'         => $request->input('value')
        ];
        $request = $this->service->store($data);
        
        $expense = $request['success'] ? $request['data'] : null;

        session()->flush('success', [
            'success'   => '',
            'messages'  => $request['messages']
        ]);

        return redirect()->route('expense.index');
    }

    public function show($id)
    {
        $expense = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $expense,
            ]);
        }

        return view('expenses.show', compact('expense'));
    }

    public function edit($id)
    {
        $expense = $this->repository->find($id);
        $users = \App\Entities\User::pluck("name","id")->all();
        
        return view('expense.edit', [
            "expense" => $expense,
            "users" => $users
        ]);
    }

    public function update(ExpenseUpdateRequest $request, $id)
    {
        if($request->hasFile('image')){
            $nameExt = $request->file('image')->getClientOriginalName();
            $name = pathinfo($nameExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $nameSave = $name.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public\img', $nameSave);
        }else{
            $nameSave = "noimage.png";
        }

        $data = [
            'user_id'       => $request->input('user_id'),
            'description'   => $request->input('description'),
            'date'          => $request->input('date'),
            'image'         => $nameSave,
            'value'         => $request->input('value')
        ];

        $request = $this->service->update($data, $id);

        session()->flush('success', [
            'success'   => '',
            'messages'  => $request['messages']
        ]);

        return redirect()->route('expense.index');
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Expense deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Expense deleted.');
    }
}
