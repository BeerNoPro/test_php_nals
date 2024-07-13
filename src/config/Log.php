<?php

class Log
{
    private static $logFile = 'src/log/app.log';

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->createLogDirectory();
    }

    /**
     * Check directory file log
     *
     * @return void
     *
     */
    private function createLogDirectory()
    {
        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
    }

    /**
     * Handle log
     *
     * @param string $level
     * @param string $message
     * @param array $context
     *
     * @return void
     *
     */
    private static function log(string $level, string $message, array $context)
    {
        $date = date('Y-m-d H:i:s');
        $formattedMessage = sprintf("[%s] [%s] %s", $date, $level, $message);

        if (!empty($context)) {
            $formattedMessage .= ' ' . json_encode($context);
        }

        $formattedMessage .= "\n";

        file_put_contents(self::$logFile, $formattedMessage, FILE_APPEND);
    }

    /**
     * Log error
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     *
     */
    public static function error(string $message, array $context = [])
    {
        self::log('ERROR', $message, $context);
    }

    /**
     * Log error exception
     *
     * @param object $exception
     *
     * @return void
     *
     */
    public static function logException(object $exception)
    {
        $message = $exception->getMessage();
        $context = [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ];
        self::error($message, $context);
    }
}
