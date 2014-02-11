<?php
namespace Radiko;

/**
 * エリア
 *
 */
class Area
{
    const HOKKAIDO = 'JP1';
    const AOMORI = 'JP2';
    const IWATE = 'JP3';
    const MIYAGI = 'JP4';
    const AKITA = 'JP5';
    const YAMAGATA = 'JP6';
    const FUKUSHIMA = 'JP7';
    const IBARAKI = 'JP8';
    const TOCHIGI = 'JP9';
    const GUNMA = 'JP10';
    const SAITAMA = 'JP11';
    const CHIBA = 'JP12';
    const TOKYO = 'JP13';
    const KANAGAWA = 'JP14';
    const NIIGATA = 'JP15';
    const TOYAMA = 'JP16';
    const ISHIKAWA = 'JP17';
    const FUKUI = 'JP18';
    const YAMANASHI = 'JP19';
    const NAGANO = 'JP20';
    const GIFU = 'JP21';
    const SHIZUOKA = 'JP22';
    const AICHI = 'JP23';
    const MIE = 'JP24';
    const SHIGA = 'JP25';
    const KYOTO = 'JP26';
    const OSAKA = 'JP27';
    const HYOGO = 'JP28';
    const NARA = 'JP29';
    const WAKAYAMA = 'JP30';
    const TOTTORI = 'JP31';
    const SHIMANE = 'JP32';
    const OKAYAMA = 'JP33';
    const HIROSHIMA = 'JP34';
    const YAMAGUCHI = 'JP35';
    const TOKUSHIMA = 'JP36';
    const KAGAWA = 'JP37';
    const EHIME = 'JP38';
    const KOUCHI = 'JP39';
    const FUKUOKA = 'JP40';
    const SAGA = 'JP41';
    const NAGASAKI = 'JP42';
    const KUMAMOTO = 'JP43';
    const OHITA = 'JP44';
    const MIYAZAKI = 'JP45';
    const KAGOSHIMA = 'JP46';
    const OKINAWA = 'JP47';

    private $scalar;

    public function __construct($code)
    {
        $ref = new \ReflectionObject($this);
        $consts = $ref->getConstants();
        if (!in_array($code, $consts, true)) {
            throw new \InvalidArgumentException();
        }

        $this->scalar = $code;
    }

    public function valueOf()
    {
        return $this->scalar;
    }
}