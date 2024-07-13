<?php

class WorkModel
{
    private $work_name;
    private $start_at;
    private $end_at;
    private $status;

    public function __construct($work_name, $start_at, $end_at, $status)
    {
        $this->work_name    = $work_name;
        $this->start_at     = $start_at;
        $this->end_at       = $end_at;
        $this->status       = $status;
    }

    public function getWorkName()
    {
        return $this->work_name;
    }

    public function setWorkName($work_name)
    {
        $this->work_name = $work_name;
    }

    public function getStartDate()
    {
        return $this->start_at;
    }

    public function setStartDate($start_at)
    {
        $this->start_at = $start_at;
    }

    public function getEndDate()
    {
        return $this->end_at;
    }

    public function setEndDate($end_at)
    {
        $this->end_at = $end_at;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
