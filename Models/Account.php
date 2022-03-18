<?php

abstract class Account
{
    private int $AccountID;
    private string $Username;
    private string $Password;

    //AccountID Get and Set
    public function getAccountID(): int
    {
        return $this->AccountID;
    }
    public function setAccountID(int $AccountID): void
    {
        $this->AccountID = $AccountID;
    }

    //Username Get and Set
    public function getUsername(): string
    {
        return $this->Username;
    }
    public function setUsername(string $Username): void
    {
        $this->Username = $Username;
    }

    //Password Get and Set
    public function getPassword(): string
    {
        return $this->Password;
    }

    public function setPassword($Password): void
    {
        $this->Password = $Password;
    }

    public function __toString(): string
    {
        return "AccountID: {$this->getAccountID()}<br>Username: {$this->getUsername()}<br>";
    }


}