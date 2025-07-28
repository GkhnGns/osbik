<?php
class CompanyManager
{
    private $file;

    public function __construct($file = 'companies.json')
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

    public function add($company)
    {
        $data = $this->loadData();
        $company['id'] = uniqid('c');
        $data[] = $company;
        $this->saveData($data);
    }

    public function findById($id)
    {
        foreach ($this->loadData() as $company) {
            if ($company['id'] === $id) {
                return $company;
            }
        }
        return null;
    }
}
?>
