<?php

class Work
{
    protected $pdo;

    /**
     * __construct
     *
     */
    public function __construct($pdo)
    {
        $this->pdo    = $pdo;
    }

    /**
     * Create data working
     *
     * @param string $work_name
     * @param DateTime $start_at
     * @param DateTime $end_at
     * @param int $status
     *
     * @return bool
     *
     */
    public function insert(
        string $work_name,
        string $start_at,
        string $end_at,
        int $status,
    ) {
        try {
            $insert = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                'works',
                'work_name, start_at, end_at, status, created_at',
                ':work_name, :start_at, :end_at, :status, :created_at',
            );

            $prepare = $this->pdo->prepare($insert);

            $prepare->execute([
                'work_name'     => $work_name,
                'start_at'      => $start_at,
                'end_at'        => $end_at,
                'status'        => $status,
                'created_at'    => date('Y-m-d H:i:s'),
            ]);

            return true;
        } catch (\Throwable $th) {
            Log::logException($th);
            return false;
        }
    }

    /**
     * Get data working
     *
     * @return array|null
     *
     */
    public function getData(): array|null
    {
        try {
            $sql = 'SELECT * FROM works';
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute();
            return $prepare->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            Log::logException($th);
            return null;
        }
    }
}
