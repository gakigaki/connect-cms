{{--
 * 登録画面(input date)テンプレート。
 *
 * @author 井上 雅人 <inoue@opensource-workshop.jp / masamasamasato0216@gmail.com>
 * @copyright OpenSource-WorkShop Co.,Ltd. All Rights Reserved
 * @category データベース・プラグイン
 --}}
<script>
    /**
     * カレンダーボタン押下
     */
     $(function () {
        $('#{{ $database_obj->id }}').datetimepicker({
            dayViewHeaderDatabaseat: 'YYYY年 M月',
            databaseat: 'YYYY/MM/DD',
            timepicker:false
        });
    });
</script>
    {{-- 日付 --}}
    <div class="input-group date" id="{{ $database_obj->id }}" data-target-input="nearest">
        <input 
            type="text" 
            name="databases_columns_value[{{ $database_obj->id }}]" 
            value="{{old('databases_columns_value.'.$database_obj->id)}}"
            class="form-control datetimepicker-input" 
            data-target="#{{ $database_obj->id }}"
        >
        <div class="input-group-append" data-target="#{{ $database_obj->id }}" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
@if ($errors && $errors->has("databases_columns_value.$database_obj->id"))
    <div class="text-danger"><i class="fas fa-exclamation-circle"></i> {{$errors->first("databases_columns_value.$database_obj->id")}}</div>
@endif
