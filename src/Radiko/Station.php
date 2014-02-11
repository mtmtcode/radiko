<?php
namespace Radiko;

/**
 * 放送局クラス
 *
 */
class Station
{
    private $id;
    private $name;

    /**
     * 放送局IDをセットする
     *
     * @return string $id 放送局ID
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 放送局IDを取得する
     *
     * @return string 放送局ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 放送局名をセットする
     *
     * @return string $name 放送局名
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * 放送局名を取得する
     *
     * @return string 放送局名
     */
    public function getName()
    {
        return $this->name;
    }
}