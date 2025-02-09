<?php

use App\DTO\Users\CreateUserDTO;
use App\Interfaces\Users\ICreateUserRepository;
use App\Services\Users\CreateUserService;

use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{

    public function testReturnsTrue()
    {
        $createUserRepositoryMock = $this->createMock(ICreateUserRepository::class);

        $user = new CreateUserDTO('rugal@gmail.com', '123456', 'rugal007', 'eu sou apelao');

        $createUserRepositoryMock->method('create')->willReturn(true);

        $createService = new CreateUserService($createUserRepositoryMock);
        $result = $createService->execute($user);

        $this->assertTrue($result);
    }
    public function testReturnsExceptionIfEmailExistsInDataBase()
    {
        $createUserRepositoryMock = $this->createMock(ICreateUserRepository::class);

        $user = new CreateUserDTO('rugal@gmail.com', '123456', 'rugal007', 'eu sou apelao');

        $createUserRepositoryMock->method('create')->willThrowException(new PDOException("O email já está cadastrado"));

        $createService = new CreateUserService($createUserRepositoryMock);
        $this->expectException(Exception::class);

         $createService->execute($user);
    }
    public function testRepositoryIsCalledOnce()
    {
        $createUserRepositoryMock = $this->createMock(ICreateUserRepository::class);

        $user = new CreateUserDTO('rugal@gmail.com', '123456', 'rugal007', 'eu sou apelao');

        $createUserRepositoryMock->expects($this->once())->method('create')->willReturn(true);

        $createService = new CreateUserService($createUserRepositoryMock);
        $createService->execute($user);
    }

}
