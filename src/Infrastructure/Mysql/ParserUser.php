<?php


namespace App\Infrastructure\Mysql;

use App\Domain\Entity\User;

class ParserUser
{

    public const _COLUMN_NAME_ID_USER           = 'id_user';
    public const _COLUMN_NAME_USERNAME          = 'username';
    public const _COLUMN_NAME_ROLES             = 'roles';
    public const _COLUMN_NAME_PASSWORD          = 'password';
    public const _COLUMN_NAME_ENABLED           = 'enabled';

    /**
     * @param array $data
     * @return User
     */
    public function parseEntityUserFromArray(array $data): User
    {
        $user = new User();

        $user->setUsername($data[$this::_COLUMN_NAME_USERNAME]);
        $user->setRoles($data[$this::_COLUMN_NAME_ROLES]);
        $user->setEnabled($data[$this::_COLUMN_NAME_ENABLED]);
        $user->setPassword($data[$this::_COLUMN_NAME_PASSWORD]);

        return $user;
    }

    public function parseEntityUserFromArrayId(User &$user, array $data)
    {
        $user->setIdUser($data[$this::_COLUMN_NAME_ID_USER]);

    }

    /**
     * @param User $entityFrom
     * @param User $entityTo
     */
    public static function parseEntityUserForUpdate(User $entityFrom, User &$entityTo): void
    {
        $entityTo->setUsername($entityFrom->getUsername());
        $entityTo->setIdUser($entityFrom->getIdUser());
        $entityTo->setRoles($entityFrom->getRoles());
        $entityTo->setPassword($entityFrom->getPassword());
        $entityTo->setEnabled($entityFrom->getEnabled());

    }

}