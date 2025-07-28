<?php
require_once 'JobManager.php';

class ApplicationManager
{
    private $file;

    public function __construct($file = 'applications.json')
    {
        $this->file = $file;
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    private function loadData()
    {
        $data = file_get_contents($this->file);
        return json_decode($data, true) ?: [];
    }

    private function saveData($data)
    {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getAll()
    {
        return $this->loadData();
    }

    public function add($app)
    {
        $data = $this->loadData();
        $app['id'] = uniqid('a');
        $app['date'] = $app['date'] ?? date('Y-m-d');
        $data[] = $app;
        $this->saveData($data);
    }

    public function updateStatus($id, $status)
    {
        $data = $this->loadData();
        foreach ($data as &$app) {
            if ($app['id'] === $id) {
                $app['status'] = $status;
            }
        }
        $this->saveData($data);
    }
}
?>
