<?php
namespace Radiko;

class Program
{
    private $beginTime;
    private $title;
    private $duration;
    private $description;

    /**
     * XML要素からオブジェクトを生成する
     *
     * @param SimpleXMLElement $elem prog要素
     * @return Program
     */
    static public function createFromXml(\SimpleXMLElement $elem)
    {
        if ('prog' != $elem->getName()) {
            throw InvalidArgumentException('prog要素以外が渡された');
        }

        $program = new self();
        $program->setBeginTime(\DateTime::createFromFormat('YmdHis', $elem['ft']));
        $program->setTitle($elem->title);
        $program->setDuration($elem['dur']);
        $program->setDescription($elem->desc);
        return $program;
    }

    /**
     * 開始時刻をセットする
     *
     * @params DateTime $dt 番組開始時刻
     */
    public function setBeginTime(\DateTime $begin_at)
    {
        $this->beginTime = $begin_at;
    }

    /**
     * 開始時刻を取得する
     *
     * @return DateTime 番組開始時刻
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * タイトルをセットする
     *
     * @params string $title タイトル
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * タイトルを取得する
     *
     * @return strng タイトル
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 番組の長さをセットする
     *
     * @params int $duration 番組の長さ
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * 番組の長さを取得する
     *
     * @return int 番組の長さ
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * 番組説明をセットする
     *
     * @params string $description 番組説明
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * 番組説明を取得する
     *
     * @return string 番組説明
     */
    public function getDescription()
    {
        return $this->description;
    }
}