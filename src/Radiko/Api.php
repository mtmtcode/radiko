<?php
namespace Radiko;

/**
 * RadikoのAPIをコールするクラス
 *
 */
class Api
{
    private $areaCode;

    /**
     *
     *
     * @param Area $area エリア
     */
    public function __construct(Area $area)
    {
        $this->areaCode = $area->valueOf();
    }

    /**
     * 放送局情報を取得する
     *
     * @array Station[] この地域で聴取可能な放送局の配列
     */
    public function getStations()
    {
        $res = new \SimpleXMLElement('http://radiko.jp/v2/station/list/'.$this->areaCode.'.xml', 0, true);

        $stations = [];
        foreach ($res as $station_node) {
            // TODO stationの情報増やす
            $station = new Station();
            $station->setId($station_node->id);
            $station->setName($station_node->name);
            $stations[] = $station;
        }

        return $stations;
    }

    /**
     * 指定した放送局の番組情報を取得する
     *
     * @param string $station_id 放送局ID
     */
    public function getProgramsByStation($station_id)
    {
        $res = new \SimpleXMLElement('http://radiko.jp/v2/api/program/station/weekly?station_id=' . $station_id, 0, true);

        $station = $res->stations->station;
        $daily_programs = [];

        foreach ($station->scd->progs as $progs) {
            foreach ($progs->prog as $prog) {
                $program = new Program();
                $program->setBeginTime(\DateTime::createFromFormat('YmdHis', $prog['ft']));
                $program->setTitle($prog->title);
                $program->setDuration($prog['dur']);
                $program->setDescription($prog->desc);
                $daily_programs[(string)$progs->date][] = $program;
            }
        }
        return $daily_programs;
    }
}