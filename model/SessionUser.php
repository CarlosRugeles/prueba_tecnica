<?php


class SessionUser
{
    /**
     * @var string
     */
    private $sessionId;
    /**
     * @var string
     */
    private $userId;
    /**
     * @var string
     */
    private $version;
    /**
     * @var string
     */
    private $vtigerVersion;

    /**
     * SessionUser constructor.
     * @param string $sessionId
     * @param string $userId
     * @param string $version
     * @param string $vtigerVersion
     */
    public function __construct(string $sessionId=null, string $userId=null, string $version=null, string $vtigerVersion=null)
    {
        $this->sessionId = $sessionId;
        $this->userId = $userId;
        $this->version = $version;
        $this->vtigerVersion = $vtigerVersion;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getVtigerVersion(): string
    {
        return $this->vtigerVersion;
    }

    /**
     * @param string $vtigerVersion
     */
    public function setVtigerVersion(string $vtigerVersion): void
    {
        $this->vtigerVersion = $vtigerVersion;
    }

    public function set($data){
        foreach ($data AS $key => $value) $this->{$key} = $value;
    }

}