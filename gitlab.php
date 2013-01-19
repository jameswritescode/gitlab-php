<?php

$classes = glob('gitlab/client/*.php');
array_unshift($classes, 'gitlab/request.php');

foreach($classes as $class)
    require $class;

class GitLab
{
    public $project;

    public function __construct($domain, $token)
    {
        $this->issue = new \GitLab\Issue($domain, $token);
        $this->milestone = new \GitLab\Milestone($domain, $token);
        $this->note = new \GitLab\Note($domain, $token);
        $this->project = new \GitLab\Project($domain, $token);
        $this->repository = new \GitLab\Repository($domain, $token);
        $this->repo = $this->repository;
        $this->snippet = new \GitLab\Snippet($domain, $token);
        $this->user = new \GitLab\User($domain, $token);
    }
}

