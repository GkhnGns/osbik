<?php
class EmployeeManager
{
    private $file;

    public function __construct($file = 'employees.json')
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

    public function add($employee)
    {
        $data = $this->loadData();
        $employee['id'] = uniqid();
        $data[] = $employee;
        $this->saveData($data);
    }

    public function remove($id)
    {
        $data = $this->loadData();
        $data = array_values(array_filter($data, function ($emp) use ($id) {
            return $emp['id'] !== $id;
        }));
        $this->saveData($data);
    }
}
?>
