<?php
ini_set("display_errors","1");
error_reporting(E_ALL);
class mailmigo
{
    public $api_key;
    public $endpoint = "https://api.mailmigo.com/";
    public $version = "0.1.0";


    function __construct($api_key=""){
        if(!empty($api_key)){
            $this->api_key = $api_key;
        }
        $this->endpoint = $this->endpoint."v".$this->version;
    }
    function get($api, $id ="", $data = array())
    {
        $url = $this->endpoint.$api;
        if(!empty($id)){
            $url .= "/".$id;
        }
        $url .= ".json";
        if(!empty($data)){
            $url .= "?".http_build_query($data);
        }
        $response = $this->curlRequest($url, "GET");
        $content = $response['response'];
        return json_decode($content, true);
    }
    function post($api, $data = array()){
        $url = $this->endpoint.$api;
        if(!empty($id)){
            $url .= "/".$id;
        }
        $url .= ".json";
        $response = $this->curlRequest($url, "POST", $data);
        $content = $response['response'];
        return json_decode($content, true);
    }
    function put($api,$id, $data){
        $url = $this->endpoint.$api;
        if(!empty($id)){
            $url .= "/".$id;
        }
        $url .= ".json";
        $response = $this->curlRequest($url, "PUT", $data);
        $content = $response['response'];
        return json_decode($content, true);
    }
    function delete($api, $id, $data = array()){
        $url = $this->endpoint.$api;
        if(!empty($id)){
            $url .= "/".$id;
        }
        $url .= ".json";
        $response = $this->curlRequest($url, "DELETE", $data);
        $content = $response['response'];
        return json_decode($content, true);
    }

    function curlRequest($url, $verb = "GET", $data = array())
    {
        $headers = array(
            "api_key: ".$this->api_key,
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded"
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $verb,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CAINFO => dirname(__FILE__) . "/ca-bundle.crt"
        ));
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        $response = curl_exec($curl);
        $error = curl_error($curl);
        $header = curl_getinfo($curl);
        curl_close($curl);
        return array(
            'header' => $header,
            'response' => $response,
            'error' => $error
        );
    }
}