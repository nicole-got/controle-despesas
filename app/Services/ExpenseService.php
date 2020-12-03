<?php

namespace App\Services;

use Illuminate\Database\QueryExceprion;
use Exceprion;
use App\Repositories\ExpenseRepository;
use App\Validators\ExpenseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class ExpenseService
{
    private $repository;
    private $validator;

    public function __construct(ExpenseRepository $repository, ExpenseValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function search($id){
        if(!$id) {
            $expense = $this->repository->paginate(3);
        }else{
            $expense = $this->repository->where("id",$id)->paginate(3);
        }
        
        return $expense;
    }

    public function store($data)
    { 
        try
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $expense = $this->repository->create($data);
            return 
            [
                'success'   => true,
                'messages'   => 'Aluno criado',
                'data'      => $expense
            ];
        }
        catch(Exception $err)
        {
            switch(get_class($err))
            {
                case QueryExceprion::class      : return ['success'   => false, 'messages' => $err->getMessage()];
                case ValidatorException::class  : return ['success'   => false, 'messages' => $err->getMessageBag()];
                case Exception::class           : return ['success'   => false, 'messages' => $err->getMessage()];
                default                         : return ['success'   => false, 'messages' => $err->getMessage()];
            }
        }
    }

    public function update($data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $expense = $this->repository->update($data, $id);
            return 
            [
                'success'   => true,
                'messages'   => 'Aluno Atualizado',
                'data'      => $expense
            ];
        }
        catch(Exception $err)
        {
            switch(get_class($err))
            {
                case QueryExceprion::class      : return ['success'   => false, 'messages' => $err->getMessage()];
                case ValidatorException::class  : return ['success'   => false, 'messages' => $err->getMessageBag()];
                case Exception::class           : return ['success'   => false, 'messages' => $err->getMessage()];
                default                         : return ['success'   => false, 'messages' => $err->getMessage()];
            }
        }
        
    }

    public function destroy($id)
    {
        try
        {
            $this->repository->delete($id);
            return  [
                'success'   => true,
                'messages'   => 'Despesa removida'
            ];
        }
        catch(Exception $err)
        {
            switch(get_class($err))
            {
                case QueryExceprion::class      : return ['success'   => false, 'messages' => $err->getMessage()];
                case ValidatorException::class  : return ['success'   => false, 'messages' => $err->getMessageBag()];
                case Exception::class           : return ['success'   => false, 'messages' => $err->getMessage()];
                default                         : return ['success'   => false, 'messages' => $err->getMessage()];
            }
        }
    }
}