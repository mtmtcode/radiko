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
     * @return array[string][Program] 日付毎の番組表
     */
    public function getScheduleByStation($station_id)
    {
        $res = new \SimpleXMLElement('http://radiko.jp/v2/api/program/station/weekly?station_id=' . $station_id, 0, true);

        $station_id = (string)$res->stations->station;

        foreach ($res->stations->station->scd->progs as $progs) {
            $date = \DateTime::createFromFormat('Ymd', (string)$progs->date);
            $schedule = new Schedule($station_id, $date);
            foreach ($progs->prog as $prog) {
                $schedule->add(Program::createFromXml($prog));
            }
            $result[$date->format('Ymd')] = $schedule;
        }
        return $result;
    }

    /**
     * 日を指定して各放送局の番組表を取得する
     *
     * @param string $when "today"または"tommorow"
     * @return array[string][Program] 放送局毎の指定日の番組表
     */
    public function getSchedule($when)
    {
        if ('today' != $when and 'tomorrow' != $when) {
            throw new InvalidArgumentException('引数に"today"もしくは"tomorrow"が指定されていない');
        }

        $res = new \SimpleXMLElement("http://radiko.jp/v2/api/program/{$when}?area_id={$this->areaCode}", 0, true);

        $result = [];
        foreach ($res->stations->station as $station) {
            $station_id = (string)$station['id'];
            $date = \DateTime::createFromFormat('Ymd', (string)$station->scd->progs->date);
            $schedule = new Schedule($station_id, $date);
            foreach ($station->scd->progs->prog as $prog) {
                $schedule->add(Program::createFromXml($prog));
            }
            $result[$station_id] = $schedule;
        }
        return $result;
    }
}