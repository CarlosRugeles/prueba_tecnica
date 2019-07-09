<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/prueba/model/Tokenizer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/prueba/model/SessionUser.php';
class Login
{

    /**
     * @var SessionUser
     */
    private $session;
    /**
     * @var Tokenizer
     */
    private $token;
    /**
     * @var string
     */
    private $error_message;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        $this->token=null;
    }

    /**
     * This method get all information token via
     * webservice using curl
     * @return bool
     */
    protected function refreshToken(){
        $url = 'https://develop.datacrm.la/datacrm/pruebatecnica/webservice.php';
        $fields = [
            "operation"=>"getchallenge",
            "username" => "prueba"
        ];
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $jsonResult=json_decode($result, true);
        if ($jsonResult['success']){
            $this->token=new Tokenizer();
            $this->token->set($jsonResult['result']);
            return true;
        }
        $this->error_message=$jsonResult['error']['message'];
        return false;

    }


    /**
     * This method set up session user
     * using webservice via curl
     * @return bool
     */
    protected function getSessionUser(){
        if ($this->token==null){
            if  (!$this->refreshToken()){
                return false;
            }
        }
        $url = 'https://develop.datacrm.la/datacrm/pruebatecnica/webservice.php';
        $fields = [
            "operation"=>"login",
            "username" => "prueba",
            "accessKey" => md5($this->token->getToken().'55kt1mJbtDFpsw1t')
        ];
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $jsonResult=json_decode($result, true);
        if ($jsonResult['success']){
            $this->session=new SessionUser();
            $this->session->set($jsonResult['result']);
            return true;
        }
        $this->error_message=$jsonResult['error']['message'];
        return false;
    }

    /**
     * This method return a session
     * if user could logged in
     * @return SessionUser|null
     */
    public function logIn(){
        return $this->getSessionUser()? $this->session: null ;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->error_message;
    }

    /**
     * @param string $error_message
     */
    public function setErrorMessage(string $error_message): void
    {
        $this->error_message = $error_message;
    }



}