<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\expenseRepository;
use App\Entities\Expense;
use App\Validators\ExpenseValidator;


class ExpenseRepositoryEloquent extends BaseRepository implements ExpenseRepository
{
    
    public function model()
    {
        return Expense::class;
    }

   
    public function validator()
    {

        return ExpenseValidator::class;
    }


    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
