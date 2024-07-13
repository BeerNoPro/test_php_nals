<?php

class WorkController
{
    private $works = [];

    /**
     * Display view todo list
     * 
     */
    public function index()
    {
        include 'views/index.php';
    }

    public function create()
    {
        include 'views/edit.php';
    }

    public function store()
    {
        $work = new WorkModel(
            $_POST['name'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['status']
        );
        $this->works[] = $work;
        $this->index();
    }

    public function edit($index)
    {
        $work = $this->works[$index];
        include 'views/edit.php';
    }

    public function update($index)
    {
        $this->works[$index]->setWorkName($_POST['name']);
        $this->works[$index]->setStartDate($_POST['start_date']);
        $this->works[$index]->setEndDate($_POST['end_date']);
        $this->works[$index]->setStatus($_POST['status']);
        $this->index();
    }

    public function delete($index)
    {
        unset($this->works[$index]);
        $this->index();
    }

    public function calendarView()
    {
        include 'views/calendar.php';
    }
}
