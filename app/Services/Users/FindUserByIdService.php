<?php

namespace App\Services\Users;

use App\Interfaces\Users\Repository\IFindUserByIdRepository;
use Exception;

class FindUserByIdService
{
    public function __construct(private IFindUserByIdRepository $findUserByIdRepository){}
    public function execute(string $id){
        try{
            $user = $this->findUserByIdRepository->findById($id);
            if($user){
                return $user;
            }
            throw new Exception('user not found', 404);
        }catch(Exception $e){
            throw new Exception($e->getMessage(),500);
        }
        
    }
}
