<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $userData): User
    {
        $userData['password'] = Hash::make($userData['password']);
        return $this->userRepository->create($userData);
    }

    public function attemptLogin(string $email, string $password): ?User
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }


}