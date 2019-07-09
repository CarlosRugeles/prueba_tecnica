<?php


class Tokenizer
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var integer
     */
    private $serverTime;

    /**
     * @var integer
     */
    private $expireTime;

    /**
     * Tokenizer constructor.
     * @param string $token
     * @param int $serverTime
     * @param int $expireTime
     */
    public function __construct(string $token=null, int $serverTime=0, int $expireTime=0)
    {
        $this->token = $token;
        $this->serverTime = $serverTime;
        $this->expireTime = $expireTime;
    }

    /**
     * @param $data
     * @return Tokenizer
     */
    public function set($data){
        foreach ($data AS $key => $value) $this->{$key} = $value;
        return $this;
    }


    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getServerTime(): int
    {
        return $this->serverTime;
    }

    /**
     * @param int $serverTime
     */
    public function setServerTime(int $serverTime): void
    {
        $this->serverTime = $serverTime;
    }

    /**
     * @return int
     */
    public function getExpireTime(): int
    {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime): void
    {
        $this->expireTime = $expireTime;
    }



}
