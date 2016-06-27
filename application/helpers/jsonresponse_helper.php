<?php

class JsonResponse
{
    protected $json;

    /**
    * Constructor.
    */
    public function __construct()
    {
        $this->json                          = array();
        $this->json['errors']                = array();
        $this->json['response']              = array();
        $this->json['response']['options']   = array();
        $this->json['response']['elements']  = array();
        $this->json['response']['html']      = null;

        $this->output                        = new CI_Output();
        return $this;
    }

    /**
    * Add an error to the response
    * 
    * @param string $message
    * @param string $error_code 
    */
    public function addError($message, $error_code = '500')
    {
        $this->json['errors'][] = array('code' => $error_code, 'msg' => $message);
    }

    /**
    * Add an option to the response
    * 
    * @param string $optionName
    * @param string $value 
    */
    public function addOption($optionName, $value)
    {
        $this->json['response']['options'][$optionName] = $value;
    }

    /**
    * Add options to the response
    * 
    * @param array $options 
    */
    public function addOptions(array $options)
    {
        $this->json['response']['options'] += $options;
    }

    /**
    * Add the entities collection to the response
    * 
    * @param type $collection
    * @return JsonResponse 
    */
    public function addElements($collection)
    {
        $this->json['response']['elements'] = $collection;
        return $this;
    }

    /**
    * Add html string to the response
    * 
    * @param string @html
    * @return JsonResponse 
    */
    public function addResponseHtml($html)
    {
        $this->json['response']['html'] = $html;
        return $this;
    }

    /**
    * Override the behavior and the json object
    * 
    * @param mixed $json 
    */
    public function setJson($json)
    {
        $this->json = $json;
    }

    /**
    * Render a Response
    *
    * @param integer $status
    * @param array $headers
    * @return Response with json encoded data
    */
    public function render($status = null)
    {
        header('Content-type: application/json');
        $json = json_encode($this->json);

        // Set status to 500 if response has errors
        if (is_null($status) && !empty($this->json['errors'])) {
            $status = 500;
        } else {
            $status = is_null($status) ? '200' : $status;
        }

        $this->output->set_status_header($status);

        $this->output
            ->set_content_type('application/json')
            ->set_output($json);

        echo $this->output->get_output();
    }
}

