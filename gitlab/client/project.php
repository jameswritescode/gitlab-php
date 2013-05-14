<?php

namespace GitLab;

class Project extends Request
{
    public function all()
    {
        return $this->get('/projects');
    }

    public function find($id)
    {
        return $this->get("/projects/$id");
    }

    public function create($array = array())
    {
        return $this->post('/projects', $array);
    }

    public function team($project_id)
    {
        return $this->get("/projects/$project_id/members");
    }

    public function team_member($project_id, $user_id)
    {
        return $this->get("/projects/$project_id/members/$user_id");
    }

    public function create_team_member($array = array())
    {
        return $this->post("/projects/{$array['id']}/members", $array);
    }

    public function update_team_member($array = array())
    {
        return $this->put("/projects/{$array['id']}/members/{$array['user_id']}", $array);
    }

    public function delete_team_member($array = array())
    {
        return $this->delete("/projects/{$array['id']}/members/{$array['user_id']}");
    }

    public function hooks($project_id)
    {
        return $this->get("/projects/$project_id/hooks");
    }

    public function hook($project_id, $hook_id)
    {
        return $this->get("/projects/$project_id/hooks/$hook_id");
    }

    public function create_hook($array = array())
    {
        return $this->post("/projects/{$array['id']}/hooks", $array);
    }

    public function update_hook($array = array())
    {
        return $this->put("/projects/{$array['id']}/hooks/{$array['hook_id']}", $array);
    }

    public function delete_hook($array = array())
    {
        return $this->delete("/projects/{$array['id']}/hooks", $array);
    }
}

