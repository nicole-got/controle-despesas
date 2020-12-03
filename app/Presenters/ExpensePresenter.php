<?php

namespace App\Presenters;

use App\Transformers\ExpenseTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ExpensePresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ExpenseTransformer();
    }
}
