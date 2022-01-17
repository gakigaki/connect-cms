<?php

namespace Tests\Browser\Manage;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * > tests\bin\connect-cms-test.bat
 */
class SiteManageTest extends DuskTestCase
{
    /**
     * テストする関数の制御
     *
     * @group manage
     * @see https://readouble.com/laravel/6.x/ja/dusk.html#running-tests
     */
    public function testInvoke()
    {
        $this->login(1);
        $this->index();
        $this->edit();
        $this->update();
        $this->meta();
        $this->saveMeta();
        $this->layout();
        $this->saveLayout();
        $this->categories();
        $this->saveCategories();
        $this->languages('日本語', '/');
        $this->saveLanguages();
        $this->languages('英語', '/en');
        $this->saveLanguages();
        $this->pageError();
        $this->savePageError();
        $this->analytics();
        $this->saveAnalytics();
        $this->favicon();
        $this->saveFavicon();
    }

    /**
     * index の表示
     */
    private function index()
    {
        // サイト管理画面
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site')
                    ->assertTitleContains('Connect-CMS')
                    ->screenshot('manage/site/index');
        });

        // ページスクロール
        $this->browse(function (Browser $browser) {
            $browser->scrollIntoView('#base_header_optional_class')
                    ->screenshot('manage/site/index2');
        });
        $this->browse(function (Browser $browser) {
            $browser->scrollIntoView('footer')
                    ->screenshot('manage/site/index3');
        });

        // マニュアル用データ出力
        $this->putManualData('manage/site/index,manage/site/index2,manage/site/index3');
    }

    /**
     * サイト基本設定画面
     */
    private function edit()
    {
        // パスワードリセットの使用を「許可しない」にする。
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site')
                    ->click('label[for="base_login_password_reset_off"]')
                    ->assertTitleContains('Connect-CMS')
                    ->screenshot('manage/site/edit');
        });
    }

    /**
     * サイト基本設定変更処理
     */
    private function update()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('更新')
                    ->assertTitleContains('Connect-CMS')
                    ->screenshot('manage/site/update');
        });
    }

    /**
     * meta情報
     */
    private function meta()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site/meta')
                    ->type('description', 'Connect-CMSのテストサイトです。')
                    ->assertTitleContains('Connect-CMS')
                    ->screenshot('manage/site/meta');
        });

        // マニュアル用データ出力
        $this->putManualData('manage/site/meta');
    }

    /**
     * meta情報処理
     */
    private function saveMeta()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('更新')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * レイアウト設定
     */
    private function layout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site/layout')
                    ->click('#label_browser_width_footer')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * レイアウト設定更新処理
     */
    private function saveLayout()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('変更')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * カテゴリ設定
     */
    private function categories()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site/categories')
                    ->type('add_display_sequence', '1')
                    ->type('add_classname', 'news')
                    ->type('add_category', 'ニュース')
                    ->type('add_color', '#ffffff')
                    ->type('add_background_color', '#0000c0')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * カテゴリ設定更新処理
     */
    private function saveCategories()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('変更')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * 他言語設定
     */
    private function languages($add_language, $add_url)
    {
        $this->browse(function (Browser $browser) use ($add_language, $add_url) {
            $browser->visit('/manage/site/languages')
                    ->click('#label_language_multi_on_on')
                    ->type('add_language', $add_language)
                    ->type('add_url', $add_url)
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * 他言語設定更新処理
     */
    private function saveLanguages()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('変更')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * 他言語設定
     */
    private function pageError()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site/pageError')
                    ->type('page_permanent_link_403', "/403")
                    ->type('page_permanent_link_404', "/404")
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * 他言語設定更新処理
     */
    private function savePageError()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('更新')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * アクセス解析設定
     */
    private function analytics()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site/analytics')
                    ->type('tracking_code', "<!-- Global site tag (gtag.js) - Google Analytics -->")
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * アクセス解析更新処理
     */
    private function saveAnalytics()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('更新')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * ファビコン
     */
    private function favicon()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/manage/site/favicon')
                    ->attach('favicon', __DIR__.'/favicon.ico')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }

    /**
     * ファビコン更新処理
     */
    private function saveFavicon()
    {
        $this->browse(function (Browser $browser) {
            // $browser->click("button[type='submit']")
            $browser->press('ファビコン追加')
                    ->assertTitleContains('Connect-CMS');
            $this->screenshot($browser);
        });
    }
}
