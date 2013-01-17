<?php

class Request
{
    private $curl;
    private $domain;
    private $token;
    private $result = array();

    public function __construct($domain, $token)
    {
        $this->domain = $domain;
        $this->token = $token;
    }

    private function merge($first, $second)
    {
        return (object) array_merge((array) $first, (array) $second);
    }

    private function url($endpoint, $params)
    {
        $params['private_token'] = $this->token;

        $query = '?' . http_build_query($params);

        return "$this->domain$endpoint$query";
    }

    private function request($endpoint, $params, $method)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url($endpoint, $params));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        } elseif ($method == 'PUT') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        } elseif ($method == 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        $response = curl_exec($curl);

        $this->result = array(
            'response' => array(
                'code' => curl_getinfo($curl, CURLINFO_HTTP_CODE)
            )
        );

        curl_close($curl);

        return $response;
    }

    protected function get($endpoint, $params = array())
    {
        $response = json_decode($this->request($endpoint, $params, 'GET'));

        return $this->merge($response, $this->result);
    }

    protected function post($endpoint, $params = array())
    {
        $response = json_decode($this->request($endpoint, $params, 'POST'));

        return $this->merge($response, $this->result);
    }

    protected function patch($endpoint, $params = array())
    {
        $response = json_decode($this->request($endpoint, $params, 'PUT'));

        return $this->merge($response, $this->result);
    }

    protected function delete($endpoint) 
    {
        $response = json_decode($this->request($endpoint, '', 'DELETE'));

        return $this->merge($response, $this->result);
    }
}

