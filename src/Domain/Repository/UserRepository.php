<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepository
{

    public function findAll();

    public function insertNewUser(User $user);

    public function updateUser(User $user);

    public function deleteUser(?int $user);

}
