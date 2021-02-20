<?php

/**
 * コストに関するクラス.
 * 税込価格を定義している.
 */
class Cost
{
    // 消費税率
    private const TAX = 10;
    // NOTE: 値段はすべて税抜. リファクタリングで税抜を使用している箇所が、あったらprivateをはずすかも.
    // FON光回線 TODO: 以下、CP終了時に3980に修正
    private const FON_HIKARI_LINE_COST = 1990;
    // ひかり電話（東日本）
    private const HIKARI_PHONE_EAST_COST = 500;
    // ひかり電話（西日本）
    private const HIKARI_PHONE_WEST_COST = 300;
    // リモートサポート
    private const REMOTE_SUPORT_COST = 500;
    // ひかりTV
    private const HIKARI_TV_COST = 2500;
    // まとめてでんき(割引価格)
    private const COLLECTIVELY_ELETRICITY_DISCOUNT_COST = -500;
    // 事務手数料
    private const ADMIN_FEE = 3000;
    /**
     * 消費税額取得.
     *
     * @param int $cost
     * @return int
     */
    private function getTax(int $cost): int
    {
        // 小数点以下、四捨五入
        return round($cost * self::TAX / 100);
    }
    /**
     * FON光回線価格取得.
     * 基本的に税込価格しか使わない想定(他の価格取得も同様).
     *
     * @return int
     */
    public function getHikariLineCost(): int
    {
        return self::FON_HIKARI_LINE_COST + $this->getTax(self::FON_HIKARI_LINE_COST);
    }
    /**
     * ひかり電話（東日本）価格取得.
     *
     * @return int
     */
    public function getHikariPhoneEastCost(): int
    {
        return self::HIKARI_PHONE_EAST_COST + $this->getTax(self::HIKARI_PHONE_EAST_COST);
    }
    /**
     * ひかり電話（西日本）価格取得.
     *
     * @return int
     */
    public function getHikariPhoneWestCost(): int
    {
        return self::HIKARI_PHONE_WEST_COST + $this->getTax(self::HIKARI_PHONE_WEST_COST);
    }
    /**
     * リモートサポート価格取得.
     *
     * @return int
     */
    public function getRemoteSuportCost(): int
    {
        return self::REMOTE_SUPORT_COST + $this->getTax(self::REMOTE_SUPORT_COST);
    }
    /**
     * ひかりTV価格取得.
     *
     * @return int
    */
    public function getHikariTVCost(): int
    {
       return self::HIKARI_TV_COST + $this->getTax(self::HIKARI_TV_COST);
    }
    /**
     * まとめてでんき割引価格取得.
     *
     * @return int
    */
    public function getCollectiveryEletricityDiscountCost(): int
    {
        return self::COLLECTIVELY_ELETRICITY_DISCOUNT_COST;
    }
    /**
     * 事務手数料取得.
     *
     * @return int
    */
    public function getAdminFee(): int
    {
        return self::ADMIN_FEE + $this->getTax(self::ADMIN_FEE);
    }

}