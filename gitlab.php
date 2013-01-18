<?php

include 'gitlab/request.php';
include 'gitlab/project.php';

class GitLab
{
    public $project;

    public function __construct($domain, $token)
    {
        $this->project = new \GitLab\Project($domain, $token);
    }
}

