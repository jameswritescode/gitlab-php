<?php

class Request
{
    private $curl;
    private $domain;
    private $token;

    public function __construct($domain, $token)
    {
        $this->domain = $domain;
        $this->token = $token;
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

        curl_close($curl);

        return $response;
    }

    protected function get($endpoint, $params = array()) {
        return $this->request($endpoint, $params, 'GET');
    }

    protected function post($endpoint, $params = array()) {
        return $this->request($endpoint, $params, 'POST');
    }

    protected function patch($endpoint, $params = array()) {
        return $this->request($endpoint, $params, 'PUT');
    }

    protected function delete($endpoint) {
        return $this->request($endpoint, '', 'DELETE');
    }
}

