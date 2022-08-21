<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use InfluxDB2\Client as Client;

class GrowfridgeController extends Controller
{
    /**
     * Returns a client for the InfluxDB database
     *
     * @return Client
     */
    private function getInfluxdbClient(): Client
    {
        return new Client([
            "url" => "172.42.0.6:8086",
            "token" => env('INFLUXDB_TOKEN'),
            "bucket" => env('INFLUXDB_DBNAME'),
            "org" => env('INFLUXDB_ORGANISATION'),
        ]);
    }

    /**
     * Returns all bucket data for sensor measurements
     * @return array
     */
    public function getInfluxDbBucketData(): array
    {
        $client = $this->getInfluxdbClient();
        $query = "from(bucket: \"".env('INFLUXDB_BUCKET', null)."\") |> range(start: -120s)";
        $tables = $client->createQueryApi()->query($query);
        $client->close();

        $result = [];
        foreach ($tables as $table) {
            foreach ($table->records as $record) {
                if ($record->getMeasurement() === "sensor") {
                    $result[] = [
                        "field" => $record->getField(),
                        "value" => $record->getValue(),
                    ];
                }
            }
        }

        return $result;
    }

    /**
     * Returns last temperature value from the bucket
     * @return string
     */
    public function getInfluxDbTemperatureLastEntry(): string
    {
        if (!$this->getInfluxDbBucketData()) {
            return '';
        } else {
            $temperatures = [];
            foreach ($this->getInfluxDbBucketData() as $entry) {
                if ($entry['field'] === 'temperature') {
                    $temperatures[] = $entry['value'];
                }
            }

            if (!$temperatures) {
                return '';
            } else {
                return end($temperatures);
            }
        }
    }

    /**
     * Returns last humidity value from the bucket
     * @return string
     */
    public function getInfluxDbHumidityLastEntry(): string
    {
        if (!$this->getInfluxDbBucketData()) {
            return '';
        } else {
            $humidities = [];
            foreach ($this->getInfluxDbBucketData() as $entry) {
                if ($entry['field'] === 'humidity') {
                    $humidities[] = $entry['value'];
                }
            }

            if (!$humidities) {
                return '';
            } else {
                return end($humidities);
            }
        }
    }

    /**
     * Returns last values for the dashboard
     * @return Application|Factory|View
     */
    public function getLastValues(): View|Factory|Application
    {
        $lastValues = [
            'temperature' => $this->getInfluxDbTemperatureLastEntry(),
            'humidity' => $this->getInfluxDbHumidityLastEntry(),
            'condition_start' => $this->getSqlActiveScheduleEntry()['condition_start'],
            'condition_end' => $this->getSqlActiveScheduleEntry()['condition_end'],
            'setTemp' => $this->getSqlActiveConditionEntry()['temperature'],
            'tem_delta_top' => $this->getSqlActiveConditionEntry()['temp_delta_top'],
            'tem_delta_bot' => $this->getSqlActiveConditionEntry()['temp_delta_bot'],
            'setHum' => $this->getSqlActiveConditionEntry()['humidity'],
            'hum_delta_top' => $this->getSqlActiveConditionEntry()['hum_delta_top'],
            'hum_delta_bot' => $this->getSqlActiveConditionEntry()['hum_delta_bot'],
            'light_white' => $this->getSqlActiveConditionEntry()['light_white'],
            'light_red' => $this->getSqlActiveConditionEntry()['light_red'],
        ];

        return view(
            'dashboard',
            $lastValues
        );
    }

    /**
     * Returns last values for the welcome site
     * @return Application|Factory|View
     */
    public function getLastValuesWelcome(): View|Factory|Application
    {
        $lastValues = [
            'temperature' => $this->getInfluxDbTemperatureLastEntry(),
            'humidity' => $this->getInfluxDbHumidityLastEntry(),
        ];

        return view(
            'welcome',
            $lastValues
        );
    }

    /**
     * Returns the active schedule entry
     * @return array|mixed|string[]
     */
    public function getSqlActiveScheduleEntry(): mixed
    {
        $scheduleDB = DB::table('schedules')->select('*')->get();
        $schedule = json_decode(json_encode($scheduleDB), true);

        $result = [];

        foreach ($schedule as $entry) {
            $start = $entry['condition_start'];
            $end = $entry['condition_end'];
            $now = date('Y-m-d H:i:s');

            if ($start < $now && $now < $end) {
                $result = $entry;
            }
        }

        if($result == null)
        {
            return [
                'condition_id' => 'No schedule entry yet!',
                'condition_start' => 'No schedule entry yet!',
                'condition_end' => 'No schedule entry yet!'
            ];
        }

        return $result;
    }

    /**
     * Returns the active condition entry
     * @return array|mixed
     */
    public function getSqlActiveConditionEntry(): mixed
    {
        $activeCondition = $this->getSqlActiveScheduleEntry();
        $allConditionsDB = DB::table('conditions')->select('*')->get();
        $allConditions = json_decode(json_encode($allConditionsDB), true);

        $result = [];

        foreach ($allConditions as $condition) {
            if($condition['id'] == $activeCondition['condition_id']) {
                $result = $condition;
            }
        }

        if ($result == null) {
            $result = $allConditions[0];
        }

        return $result;
    }

    /**
     * Returns all conditions except the default entry
     * @return mixed
     */
    public function getSqlAllConditions(): mixed
    {
        $allConditionsDB = DB::connection('growfridge')->table('conditions')->select('*')->get();
        $conditionArray = json_decode(json_encode($allConditionsDB), true);

        return array_slice($conditionArray, 1);
    }

    /**
     * Returns all schedule entries except the default entry
     * @return Application|Factory|View
     */
    public function getSqlSchedule(): View|Factory|Application
    {
        $allConditionsDB = DB::connection('growfridge')->table('schedules')->select('*')->get();
        $schedule = json_decode(json_encode($allConditionsDB), true);

        return view(
            'schedule',
            [
                'scheduleEntries' => array_slice($schedule, 1),
            ],
        );
    }
}
