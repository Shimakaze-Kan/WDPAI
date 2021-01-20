<?php


class User
{
    private $email;
    private $password;
    private $id;
    private $role;
    private $active;
    private $banDate;


    public function __construct(string $email,string $password, int $id=0, string $role='casual', bool $active=false, string $banDate = "2000-01-01")
    {
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->role = $role;
        $this->active = $active;
        $this->banDate = $banDate;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getBanDate(): string
    {
        return $this->banDate;
    }
}