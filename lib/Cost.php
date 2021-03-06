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
    // FON光回線
    private const FON_HIKARI_LINE_COST = 3980;
    // ひかり電話（東日本）
    private const HIKARI_PHONE_EAST_COST = 500;
    // ひかり電話（西日本）
    private const HIKARI_PHONE_WEST_COST = 300;
    // リモートサポート
    private const REMOTE_SUPORT_COST = 500;
    // まとめてでんき(割引価格)
    private const COLLECTIVELY_ELETRICITY_DISCOUNT_COST = -500;
    // カスペルスキーセキュリティ
    private const KASPERSKY_SECURTY_COST = 500;
    // 事務手数料
    private const ADMIN_FEE = 3000;
    // ひかりTV(基本料金)
    private const HIKARI_TV_BASIC_COST = 1000;
    // ひかりTV(お値打ちプラン)
    private const HIKARI_TV_VALUE_OF_MONEY_COST = 3500;
    // ひかりTV(テレビおすすめプラン)
    private const HIKARI_TV_RECOMMEND_COST = 2500;
    // ひかりTV(ビデオざんまいプラン)
    private const HIAKRI_TV_VIDEO_ZAMMAI_COST = 2500;
    // ひかりTV(お値打ちプラン2ねん割)
    private const HIKARI_TV_VALUE_OF_MONEY_2YEAR_COST = 2500;
    // ひかりTV(テレビおすすめプラン2ねん割)
    private const HIKARI_TV_RECOMMEND_2YEAR_COST = 1500;
    // ひかりTV(ビデオざんまいプラン2ねん割)
    private const HIAKRI_TV_VIDEO_ZAMMAI_2YEAR_COST = 1500;
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
     * まとめてでんき割引価格取得.
     *
     * @return int
    */
    public function getCollectiveryEletricityDiscountCost(): int
    {
        return self::COLLECTIVELY_ELETRICITY_DISCOUNT_COST;
    }
    /**
     * カスペルスキーセキュリティ価格取得.
     *
     * @return int
     */
    public function getKasperskySecurityCost(): int
    {
        return self::KASPERSKY_SECURTY_COST + $this->gettax(self::KASPERSKY_SECURTY_COST);
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
    /**
     * ひかりTV(基本料金)価格取得
     *
     * @return int
     */
    public function getHikariTVBasicCost(): int
    {
        return self::HIKARI_TV_BASIC_COST + $this->gettax(self::HIKARI_TV_BASIC_COST);
    }
    /**
     * ひかりTV(お値打ちプラン)価格取得
     *
     * @return int
     */
    public function getHikariTVValueOfMoneyCost(): int
    {
        return self::HIKARI_TV_VALUE_OF_MONEY_COST + $this->gettax(self::HIKARI_TV_VALUE_OF_MONEY_COST);
    }
    /**
     * ひかりTV(テレビおすすめプラン)価格取得
     *
     * @return int
     */
    public function getHikariTVRecommendCost(): int
    {
        return self::HIKARI_TV_RECOMMEND_COST + $this->gettax(self::HIKARI_TV_RECOMMEND_COST);
    }
    /**
     * ひかりTV(ビデオざんまいプラン)価格取得
     *
     * @return int
     */
    public function getHikariTVVideoZammaiCost(): int
    {
        return self::HIAKRI_TV_VIDEO_ZAMMAI_COST + $this->gettax(self::HIAKRI_TV_VIDEO_ZAMMAI_COST);
    }
    /**
     * ひかりTV(お値打ちプラン2ねん割)価格取得
     *
     * @return int
     */
    public function getHikariTVValueOfMoney2YearCost(): int
    {
        return self::HIKARI_TV_VALUE_OF_MONEY_2YEAR_COST + $this->gettax(self::HIKARI_TV_VALUE_OF_MONEY_2YEAR_COST);
    }
    /**
     * ひかりTV(テレビおすすめプラン2ねん割)価格取得
     *
     * @return int
     */
    public function getHikariTVRecommend2YearCost(): int
    {
        return self::HIKARI_TV_RECOMMEND_2YEAR_COST + $this->gettax(self::HIKARI_TV_RECOMMEND_2YEAR_COST);
    }
    /**
     * ひかりTV(ビデオざんまいプラン2ねん割)価格取得
     *
     * @return int
     */
    public function getHikariTVVideoZammai2YearCost(): int
    {
        return self::HIAKRI_TV_VIDEO_ZAMMAI_2YEAR_COST + $this->gettax(self::HIAKRI_TV_VIDEO_ZAMMAI_2YEAR_COST);
    }
    /**
     * メール本文に表示する金額を取得.
     *
     * @param $fee 料金
     * @return string
     */
    public function getFee4MailContent(int $fee): string
    {
        return number_format($fee) . '円（税込）';
    }
}