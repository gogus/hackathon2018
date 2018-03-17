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
    private $email;

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
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($email, $password, $firstName, $lastName)
    {
        $this->id = Uuid::uuid4();
        $this->email = $email;
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
            $data['email'],
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
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
        ];
    }
}