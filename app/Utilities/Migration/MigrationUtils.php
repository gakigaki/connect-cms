<?php

namespace App\Utilities\Migration;

use Illuminate\Support\Arr;

/**
 * 移行関連Utils
 *
 * @author 牟田口 満 <mutaguchi@opensource-workshop.jp>
 * @copyright OpenSource-WorkShop Co.,Ltd. All Rights Reserved
 * @category 移行
 * @package Util
 */
class MigrationUtils
{
    /**
     * 配列の値の取得
     */
    public static function getArrayValue($array, $key1, $key2 = null, $default = "")
    {
        if (is_null($key2)) {
            return Arr::get($array, $key1, $default);
        }
        return Arr::get($array, "$key1.$key2", $default);
    }

    /**
     * HTML からimg タグの src 属性を取得
     */
    public static function getContentImage($content)
    {
        $pattern = '/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i';
        return self::getContentPregMatchAll($content, $pattern, 1);
    }

    /**
     * HTML からimg タグ全体を取得
     */
    public static function getContentImageTag($content)
    {
        $pattern = '/<img.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i';

        if (preg_match_all($pattern, $content, $images)) {
            if (is_array($images) && isset($images[0])) {
                return $images;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * HTML からimg タグの style 属性を取得
     */
    private static function getImageStyle($content)
    {
        $pattern = '/<img.*?style\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i';
        return self::getContentPregMatchAll($content, $pattern, 1);
    }

    /**
     * HTML からiframe タグの style 属性を取得
     */
    private static function getIframeStyle($content)
    {
        $pattern = '/<iframe.*?style\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i';
        return self::getContentPregMatchAll($content, $pattern, 1);
    }

    /**
     * HTML からiframe タグの src 属性を取得
     */
    private static function getIframeSrc($content)
    {
        $pattern = '/<iframe.*?src\s*=\s*[\"|\'](.*?)[\"|\'].*?>/i';
        return self::getContentPregMatchAll($content, $pattern, 1);
    }

    /**
     * HTML からa タグの href 属性を取得
     */
    public static function getContentAnchor($content)
    {
        $pattern = "|<a.*?href=\"(.*?)\".*?>(.*?)</a>|mis";
        return self::getContentPregMatchAll($content, $pattern, 1);
    }

    /**
     * HTML から href,src 属性を取得
     */
    public static function getContentHrefOrSrc($content)
    {
        $pattern = '/(?<=href=").*?(?=")|(?<=src=").*?(?=")/i';
        return self::getContentPregMatchAll($content, $pattern, 0);
    }

    /**
     * HTML から preg_match_all を使ってタグや属性等を取得
     */
    private static function getContentPregMatchAll($content, string $pattern, int $get_matches_idx)
    {
        if (preg_match_all($pattern, $content, $matches)) {
            if (is_array($matches) && isset($matches[$get_matches_idx])) {
                return $matches[$get_matches_idx];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 画像のstyle設定を探し、height をmax-height に変換する。
     */
    public static function convertContentImageHeightToMaxHeight(?string $content): ?string
    {
        $img_styles = self::getImageStyle($content);
        if (!empty($img_styles)) {
            $img_styles = array_unique($img_styles);
            foreach ($img_styles as $img_style) {
                $new_img_style = str_replace('height', 'max-height', $img_style);
                $new_img_style = str_replace('max-max-height', 'max-height', $new_img_style);
                $content = str_replace($img_style, $new_img_style, $content);
            }
        }
        return $content;
    }

    /**
     * Iframeのstyle設定を探し、width を 100% に変換する。
     */
    public static function convertContentIframeWidthTo100percent(?string $content): ?string
    {
        // Google Map 埋め込み時のスマホ用対応。widthを 100% に変更
        $iframe_srces = self::getIframeSrc($content);
        if (!empty($iframe_srces)) {
            // iFrame のsrc を取得（複数の可能性もあり）
            $iframe_styles = self::getIframeStyle($content);
            if (!empty($iframe_styles)) {
                foreach ($iframe_styles as $iframe_style) {
                    $width_pos = strpos($iframe_style, 'width');
                    $width_length = strpos($iframe_style, ";", $width_pos) - $width_pos + 1;
                    $iframe_style_width = substr($iframe_style, $width_pos, $width_length);
                    if (!empty($iframe_style_width)) {
                        $content = str_replace($iframe_style_width, "width:100%;", $content);
                    }
                }
            }
        }
        return $content;
    }
}
