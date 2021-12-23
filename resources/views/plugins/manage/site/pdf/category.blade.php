{{--
 * サイト管理（サイト設計書）の共通カテゴリ設定のテンプレート
 *
 * @author 永原　篤 <nagahara@opensource-workshop.jp>
 * @copyright OpenSource-WorkShop Co.,Ltd. All Rights Reserved
 * @category サイト管理
 --}}
<style type="text/css">
/* テーブル */
.table_css {
    border-collapse:  collapse;     /* セルの線を重ねる */
}
.table_css th, .table_css td {
    border: 0.1px solid #000;       /* 枠線指定 */
}
.doc_th {
    background-color: #d0d0d0;      /* 背景色指定 */
}
</style>

<br />
<h4>共通カテゴリ設定</h4>
<table border="0" class="table_css">
    <tr>
        <th class="doc_th">表示順</th>
        <th class="doc_th">クラス名</th>
        <th class="doc_th">カテゴリ</th>
        <th class="doc_th">文字色</th>
        <th class="doc_th">背景色</th>
        <th class="doc_th">サンプル</th>
    </tr>
    @foreach($categories as $category)
    <tr>
        <td>{{$category->display_sequence}}</td>
        <td>{{$category->classname}}</td>
        <td>{{$category->category}}</td>
        <td>{{$category->color}}</td>
        <td>{{$category->background_color}}</td>
        <td style="background-color:{{$category->background_color}};"><span style="color: {{$category->color}};">{{$category->category}}</span></td>
    </tr>
    @endforeach
</table>
