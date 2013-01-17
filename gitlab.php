<?php

function __autoload($class) {
    require "gitlab/$class.php";
}

class GitLab
{
    private $token;
    private $domain;

    public function __construct($domain, $token)
    {
        $this->token = $token;
        $this->domain = $domain;
    }
}

