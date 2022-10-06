{{--
 * メール送信テスト画面のテンプレート
 *
 * @author 牟田口 満 <mutaguchi@opensource-workshop.jp>
 * @copyright OpenSource-WorkShop Co.,Ltd. All Rights Reserved
 * @category システム管理
 --}}
{{-- 管理画面ベース画面 --}}
@extends('plugins.manage.manage')

{{-- 管理画面メイン部分のコンテンツ section:manage_content で作ること --}}
@section('manage_content')

<div class="card">
    <div class="card-header p-0">
        {{-- 機能選択タブ --}}
        @include('plugins.manage.system.system_tab')
    </div>
    <div class="card-body">

        {{-- 共通エラーメッセージ 呼び出し --}}
        @include('plugins.common.errors_form_line')

        @if ($errors && $errors->has('mail-setting'))
            <div class="card border-danger">
                <div class="card-body">
                    <div class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i> メール設定エラーのため、メール設定を見直してください。<br />
                        {{$errors->first('mail-setting')}}
                    </div>
                </div>
            </div>
        @endif

        {{-- 登録後メッセージ表示 --}}
        @include('plugins.common.flash_message')

        {{-- メッセージエリア --}}
        <div class="alert alert-info">
            <i class="fas fa-exclamation-circle"></i> メールの動作確認する場合、「送信」ボタンを押してください。
        </div>

        <form action="{{url('/')}}/manage/system/sendMailTest" method="POST">
            {{csrf_field()}}

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">送信者メールアドレス</label>
                <div class="col form-text">
                    {{config('mail.from.address')}}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">宛先メールアドレス</label>
                <div class="col">
                    <input type="text" name="email" value="{{old('email', Auth::user()->email)}}" class="form-control @if ($errors->has('email')) border-danger @endif">
                    @include('common.errors_inline', ['name' => 'email'])
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">件名</label>
                <div class="col">
                    <input type="text" name="subject" value="{{old('subject', '件名')}}" class="form-control @if ($errors->has('subject')) border-danger @endif">
                    @include('common.errors_inline', ['name' => 'subject'])
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right pt-0">本文</label>
                <div class="col-md-9">
                    <div @if ($errors->has("body")) class="border border-danger" @endif>
                        <textarea name="body" class="form-control" rows=8>{{old('body', '本文')}}</textarea>
                    </div>
                    @include('common.errors_inline', ['name' => 'body'])
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary"><i class="fas fa-envelope"></i> 送信</button>
            </div>
        </form>

    </div>
</div>

@endsection
