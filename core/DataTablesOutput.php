<?php

class DataTablesOutput
{
    public $status, $message, $data, $recordsTotal, $recordsFiltered;

    public function __construct($status, $message = null, $data = null, $recordsTotal = 0, $recordsFiltered = 0)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->recordsTotal = $recordsTotal;
        $this->recordsFiltered = $recordsFiltered;

        return $this;
    }
}