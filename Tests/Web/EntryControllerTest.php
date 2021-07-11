<?php
/**
 * This file is part of HTMLPurifier
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\HTMLPurifier\Tests\Web;


class EntryControllerTest extends \Eccube\Tests\Web\EntryControllerTest
{
    public function test攻撃性のある特定の文字列を入力してサブミットしたらその文字列は全角に変換される()
    {
        $formData = $this->createFormData();
        $formData['company_name'] = '<script&>';

        $crawler = $this->client->request('POST',
            $this->generateUrl('entry'),
            [
                'entry' => $formData,
                'mode' => 'confirm',
            ]
        );

        self::assertEquals('新規会員登録(確認)', $crawler->filter('.ec-pageHeader > h1')->text());
        self::assertEquals('＜script＆＞', $crawler->filter('#entry_company_name')->attr('value'));
    }
}
