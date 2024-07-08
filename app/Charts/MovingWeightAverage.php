<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MovingWeightAverage
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($actual, $forecast, $month_chart): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Sales forecast')
            ->setSubtitle('Actual sales vs forecast sales.')
            ->addData('Actual sales', $actual)
            ->addData('Forecast sales', $forecast)
            ->setXAxis($month_chart);
    }
}
