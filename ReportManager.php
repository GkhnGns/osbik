<?php
require_once 'ApplicationManager.php';
require_once 'JobManager.php';
require_once 'CompanyManager.php';

class ReportManager
{
    private $appManager;
    private $jobManager;
    private $companyManager;

    public function __construct()
    {
        $this->appManager = new ApplicationManager();
        $this->jobManager = new JobManager();
        $this->companyManager = new CompanyManager();
    }

    public function generalReport($start = null, $end = null)
    {
        $apps = $this->appManager->getAll();
        $jobs = $this->jobManager->getAll();

        $startTs = $start ? strtotime($start) : 0;
        $endTs = $end ? strtotime($end) : time();

        $total = 0;
        $hired = 0;
        $companyCounts = [];

        foreach ($apps as $app) {
            $ts = isset($app['date']) ? strtotime($app['date']) : 0;
            if ($ts < $startTs || $ts > $endTs) {
                continue;
            }
            $total++;
            if (($app['status'] ?? '') === 'hired') {
                $hired++;
            }
            $job = $this->jobManager->findById($app['job_id']);
            if ($job) {
                $companyId = $job['company_id'];
                if (!isset($companyCounts[$companyId])) {
                    $companyCounts[$companyId] = 0;
                }
                $companyCounts[$companyId]++;
            }
        }

        $companies = [];
        foreach ($companyCounts as $cid => $count) {
            $c = $this->companyManager->findById($cid);
            $companies[$c ? $c['name'] : $cid] = $count;
        }

        return [
            'applications' => $total,
            'hired' => $hired,
            'companyCounts' => $companies,
        ];
    }
}
?>
