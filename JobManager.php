<?php
require_once 'CompanyManager.php';

class JobManager
{
    private $file;

    public function __construct($file = 'jobs.json')
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

    public function add($job)
    {
        $data = $this->loadData();
        $job['id'] = uniqid('j');
        $data[] = $job;
        $this->saveData($data);
    }

    public function findById($id)
    {
        foreach ($this->loadData() as $job) {
            if ($job['id'] === $id) {
                return $job;
            }
        }
        return null;
    }
}
?>
