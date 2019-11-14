<?php


class Output{
    public $status, $message, $data;

    public function __construct($status, $message = null, $data = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;

        return $this;
    }
}