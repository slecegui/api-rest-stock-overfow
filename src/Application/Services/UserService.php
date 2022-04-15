<?php
namespace App\Application\Services;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;
use App\Infrastructure\Mysql\ParserUser;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;

class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var ParserUser
     */
    private ParserUser $parserUser;

    public function __construct(UserRepository $userRepository, ParserUser $parserUser)
    {
        $this->userRepository = $userRepository;
        $this->parserUser = $parserUser;
    }

    public function insertNewUser(array $dataUser)
    {


        if (!empty($dataUser['password'])) {
            $factory = new PasswordHasherFactory([
                                                     'common' => ['algorithm' => 'bcrypt'],
                                                     'memory-hard' => ['algorithm' => 'sodium'],
                                                 ]);

            $encoded_password = $factory->getPasswordHasher('common')->hash($dataUser['password']);
            $dataUser['password'] = $encoded_password;
         }

        $userFromJSON = $this->parserUser->parseEntityUserFromArray($dataUser);
        $this->userRepository->insertNewUser($userFromJSON);
    }

    public function updateUser(array $dataUser)
    {
        $userFromJSON = $this->parserUser->parseEntityUserFromArray($dataUser);
        $this->parserUser->parseEntityUserFromArrayId($userFromJSON, $dataUser);
        $this->userRepository->updateUser($userFromJSON);
    }

    public function deleteUser(?int $add_user_id)
    {
        $this->userRepository->deleteUser($add_user_id);
    }

    /**
     * @param string $user_email
     * @return User
     */
    public function findOneUser(string $user_email): User
    {
        return $this->userRepository->findOneBy(['email' => $user_email]);
    }

    /**
     * @return array
     */
    public function findAllUser(): array
    {
        return $this->userRepository->findAll();
    }

}