<?php
namespace Radiko;

class Schedule
{
    private $programs = [];
    private $date;
    private $stationId;

    public function __construct($station_id, \DateTime $date)
    {
        $this->stationId = $station_id;
        $this->date = $date;
    }

    /**
     * スケジュールに番組を追加する
     *
     * @param Program $program プログラム
     */
    public function add(Program $program)
    {
        $this->programs[] = $program;
    }

    /**
     * 1日の番組情報を取得する
     *
     * @return array[Program]
     */
    public function getPrograms()
    {
        return $this->programs;
    }

    /**
     * 日付を取得する
     *
     * @return \DateTime 日付
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * 放送局IDを取得する
     *
     * @return string 放送局ID
     */
    public function getStationId()
    {
        return $this->stationId;
    }
}