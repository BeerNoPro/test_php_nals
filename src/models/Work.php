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
     * @param string|null $id
     *
     * @return array|null
     *
     */
    public function getData(string|null $id = null): array|null
    {
        try {
            if ($id) {
                $sql = 'SELECT * FROM works WHERE id =?';
            } else {
                $sql = 'SELECT * FROM works ORDER BY start_at ASC';
            }

            $prepare = $this->pdo->prepare($sql);

            if ($id) {
                $prepare->execute([$id]);
            } else {
                $prepare->execute();
            }

            return $prepare->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            Log::logException($th);
            return null;
        }
    }

    /**
     * Get data working
     *
     * @param string $status
     *
     * @return array|null
     *
     */
    public function search(string $status): array|null
    {
        try {
            if ($status == 'all') {
                $sql = 'SELECT * FROM works ORDER BY start_at ASC';
            } else {
                $sql = 'SELECT * FROM works WHERE status =? ORDER BY start_at ASC';
            }

            $prepare = $this->pdo->prepare($sql);

            if ($status == 'all') {
                $prepare->execute();
            } else {
                $prepare->execute([$status]);
            }

            return $prepare->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            Log::logException($th);
            return null;
        }
    }

    /**
     * Get data working
     *
     * @param string $column
     * @param string $type
     *
     * @return array|null
     *
     */
    public function searchDate(string $column, string $type): array|null
    {
        try {
            $sql = "SELECT * FROM works ORDER BY $column $type";

            $prepare = $this->pdo->prepare($sql);

            $prepare->execute();

            return $prepare->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            Log::logException($th);
            return null;
        }
    }

    /**
     * Get data working
     *
     * @param string $start_date
     * @param string $end_date
     *
     * @return array|null
     *
     */
    public function dateWorking(string $start_date, string $end_date): array|null
    {
        try {
            $sql = "
                SELECT *
                FROM works
                WHERE start_at BETWEEN :start_at AND :end_at ORDER BY start_at ASC
            ";

            $prepare = $this->pdo->prepare($sql);

            $prepare->execute([
                'start_at' => $start_date,
                'end_at'   => $end_date,
            ]);

            return $prepare->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            Log::logException($th);
            return null;
        }
    }

    /**
     * Update data working
     *
     * @param string $work_name
     * @param DateTime $start_at
     * @param DateTime $end_at
     * @param int $status
     * @param string $id
     *
     * @return bool
     *
     */
    public function update(
        string $work_name,
        string $start_at,
        string $end_at,
        int $status,
        string $id,
    ): bool {
        try {
            $sql = '
                UPDATE works
                SET
                    work_name = :work_name,
                    start_at = :start_at,
                    end_at = :end_at,
                    status = :status,
                    updated_at = :updated_at
                WHERE id = :id
            ';

            $prepare = $this->pdo->prepare($sql);

            $prepare->execute([
                'work_name'  => $work_name,
                'start_at'   => $start_at,
                'end_at'     => $end_at,
                'status'     => $status,
                'updated_at' => date('Y-m-d H:i:s'),
                'id'         => $id,
            ]);

            return true;
        } catch (\Throwable $th) {
            Log::logException($th);
            return false;
        }
    }

    /**
     * Update data working
     *
     * @param int $status
     * @param string $id
     *
     * @return bool
     *
     */
    public function updateStatus(
        int $status,
        string $id,
    ): bool {
        try {
            $sql = '
                UPDATE works
                SET
                    status = :status,
                    updated_at = :updated_at
                WHERE id = :id
            ';

            $prepare = $this->pdo->prepare($sql);

            $prepare->execute([
                'status'     => $status,
                'updated_at' => date('Y-m-d H:i:s'),
                'id'         => $id,
            ]);

            return true;
        } catch (\Throwable $th) {
            Log::logException($th);
            return false;
        }
    }

    /**
     * Delete data working
     *
     * @param string $id
     *
     * @return bool
     *
     */
    public function delete(string $id): bool
    {
        try {
            $sql     = 'DELETE FROM works WHERE id = ?';
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute([$id]);

            return true;
        } catch (\Throwable $th) {
            Log::logException($th);
            return false;
        }
    }
}
