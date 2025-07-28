<?php
class SettingsManager
{
    private $file;

    public function __construct($file = 'settings.json')
    {
        $this->file = $file;
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([
                'site_title' => 'OSB IK',
                'primary_color' => '#007bff'
            ], JSON_PRETTY_PRINT));
        }
    }

    private function load()
    {
        $data = file_get_contents($this->file);
        return json_decode($data, true) ?: [];
    }

    private function save($data)
    {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function get($key)
    {
        $data = $this->load();
        return $data[$key] ?? null;
    }

    public function set($key, $value)
    {
        $data = $this->load();
        $data[$key] = $value;
        $this->save($data);
    }

    public function getAll()
    {
        return $this->load();
    }
}
?>
