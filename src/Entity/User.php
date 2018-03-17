<?php

namespace Gtw\Entity;

use Ramsey\Uuid\Uuid;

final class User
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @param string $username
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($username, $password, $firstName, $lastName)
    {
        $this->id = Uuid::uuid4();
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function create(array $data)
    {
        return new self(
            $data['username'],
            $data['password'],
            $data['first_name'],
            $data['last_name']
        );
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function existing(array $data)
    {
        $user = self::create($data);
        $user->id = $data['id'];

        return $user;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
        ];
    }
}