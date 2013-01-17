<?php

function __autoload($class) {
    require "gitlab/$class.php";
}

class GitLab
{
    public $project;

    public function __construct($domain, $token)
    {
        $this->project = new Project($domain, $token);
    }
}

