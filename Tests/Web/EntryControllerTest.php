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
    public function test住所に攻撃性のある文字列を入力してサブミットしたらその文字列は削除される未入力エラーが発生するか()
    {
        $formData = $this->createFormData();
        $formData['address']['addr01'] = '<script>alert()</script>';

        $crawler = $this->client->request('POST',
            $this->generateUrl('entry'),
            [
                'entry' => $formData,
                'mode' => 'confirm',
            ]
        );

        self::assertEquals('新規会員登録', $crawler->filter('.ec-pageHeader > h1')->text());
        self::assertCount(1, $crawler->filter('.ec-errorMessage'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testアンパサンドを入力してサブミットしたら全角に変換されるか()
    {
        $formData = $this->createFormData();
        $formData['company_name'] = '&';

        $crawler = $this->client->request('POST',
            $this->generateUrl('entry'),
            [
                'entry' => $formData,
                'mode' => 'confirm',
            ]
        );

        self::assertEquals('新規会員登録(確認)', $crawler->filter('.ec-pageHeader > h1')->text());
        self::assertEquals('＆', $crawler->filter('#entry_company_name')->attr('value'));
    }
}
