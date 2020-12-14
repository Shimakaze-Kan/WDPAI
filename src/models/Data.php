<?php


class Data
{
    private $countryCode;
    private $value;

    public function __construct(string $data)
    {
        $this->countryCode = explode(' ',$data)[1];
        $this->value = explode(' ',$data)[0];
    }

    public function getData()
    {
        return [$this->countryCode,$this->value];
    }
}