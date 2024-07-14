<?php

require_once 'src/controllers/BaseController.php';

class WorkController extends BaseController
{
    protected $workModel = null;
    protected $pathHome  = null;

    /**
     * __construct
     *
     */
    public function __construct() {
        $this->workModel = new Work($this->pdo());
        $this->pathHome  = '/' . $this->config()['app_name'];
    }

    /**
     * Display view todo list
     *
     */
    public function index()
    {
        $works  = $this->workModel->getData() ?: [];
        $config = $this->config();

        return include './src/views/index.php';
    }

    /**
     * Display form create
     *
     */
    public function create()
    {
        $config = $this->config();
        return include './src/views/create.php';
    }

    /**
     * Create data
     *
     */
    public function store()
    {
        try {
            if (
                isset($_POST['work_name'])
                && isset($_POST['start_at'])
                && isset($_POST['end_at'])
                && isset($_POST['status'])
            ) {
                $this->workModel->insert(
                    $_POST['work_name'],
                    $_POST['start_at'],
                    $_POST['end_at'],
                    $_POST['status']
                );
                $this->redirect($this->pathHome);
            } else {
                return include './src/views/layout/error.php';
            }
        } catch (\Throwable $th) {
            Log::logException($th);
        }
    }

    /**
     * Display form update
     *
     */
    public function edit()
    {
        try {
            if (isset($_GET['id'])) {
                $work   = $this->workModel->getData($_GET['id']);
                $config = $this->config();

                return include './src/views/edit.php';
            } else {
                return include './src/views/layout/error.php';
            }
        } catch (\Throwable $th) {
            Log::logException($th);
        }
    }

    /**
     * Update data
     *
     */
    public function update()
    {
        try {
            if (isset($_POST['id'])) {
                $this->workModel->update(
                    $_POST['work_name'],
                    $_POST['start_at'],
                    $_POST['end_at'],
                    $_POST['status'],
                    $_POST['id'],
                );

                $this->redirect($this->pathHome);
            } else {
                return include './src/views/layout/error.php';
            }
        } catch (\Throwable $th) {
            log::logException($th);
        }
    }

    /**
     * Delete data
     *
     */
    public function delete()
    {
        try {
            if (isset($_POST['id'])) {
                $this->workModel->delete($_POST['id']);
                $this->redirect($this->pathHome);
            } else {
                return include './src/views/layout/error.php';
            }
        } catch (\Throwable $th) {
            log::logException($th);
        }
    }

    /**
     * Update status working
     *
     */
    public function check()
    {
        try {
            if (isset($_POST['status']) && isset($_POST['id'])) {
                $this->workModel->updateStatus(
                    $_POST['status'],
                    $_POST['id'],
                );

                echo json_encode([
                    'status'  => 200,
                    'message' => 'Updated status successfully',
                ]);
            } else {
                echo json_encode([
                    'status'  => 404,
                    'message' => 'Updated status failed',
                ]);
            }
        } catch (\Throwable $th) {
            log::logException($th);
        }
    }

    /**
     * Search data
     *
     */
    public function search()
    {
        try {
            if (isset($_GET['status'])) {
                $data   = $this->workModel->search($_GET['status']);

                echo json_encode([
                    'status'  => 200,
                    'message' => 'Search status successfully',
                    'data'    => $data,
                ]);
            } else {
                echo json_encode([
                    'status'  => 404,
                    'message' => 'Search status failed',
                ]);
            }
        } catch (\Throwable $th) {
            log::logException($th);
        }
    }

    /**
     * Search order by date
     *
     */
    public function searchDate()
    {
        try {
            if (isset($_GET['column']) && isset($_GET['type'])) {
                $data   = $this->workModel->searchDate($_GET['column'], $_GET['type']);

                echo json_encode([
                    'status'  => 200,
                    'message' => 'Search status successfully',
                    'data'    => $data,
                ]);
            } else {
                echo json_encode([
                    'status'  => 404,
                    'message' => 'Search status failed',
                ]);
            }
        } catch (\Throwable $th) {
            log::logException($th);
        }
    }

    /**
     * Search date working
     *
     */
    public function dateWorking()
    {
        try {
            if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                $data   = $this->workModel->dateWorking($_GET['start_date'], $_GET['end_date']);

                echo json_encode([
                    'status'  => 200,
                    'message' => 'Search status successfully',
                    'data'    => $data,
                ]);
            } else {
                echo json_encode([
                    'status'  => 404,
                    'message' => 'Search status failed',
                ]);
            }
        } catch (\Throwable $th) {
            log::logException($th);
        }
    }
}
