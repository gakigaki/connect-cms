{{--
 * 施設予約データ表示画面（月）
 *
 * @author 井上 雅人 <inoue@opensource-workshop.jp / masamasamasato0216@gmail.com>
 * @copyright OpenSource-WorkShop Co.,Ltd. All Rights Reserved
 * @category 施設予約プラグイン
--}}
<div class="row">
    <div class="col-12 clearfix">

        {{-- defaultテンプレート --}}
        <div class="float-left">

            <div class="list-group list-group-horizontal">
                {{-- 前月ボタン --}}
                <a href="{{url('/')}}/plugin/reservations/month/{{$page->id}}/{{$frame->id}}/{{ $carbon_target_date->copy()->subMonthsNoOverflow('1')->format('Ym') }}#frame-{{$frame->id}}" class="list-group-item btn btn-light d-flex align-items-center">
                    <i class="fas fa-angle-double-left"></i>
                </a>
                {{-- 当月表示 --}}
                <a class="list-group-item h5 d-flex align-items-center">
                    {{ App::getLocale() == ConnectLocale::ja ? $carbon_target_date->format('Y年n月') : $carbon_target_date->format('M Y') }}
                </a>
                {{-- 翌月ボタン --}}
                <a href="{{url('/')}}/plugin/reservations/month/{{$page->id}}/{{$frame->id}}/{{ $carbon_target_date->copy()->addMonthsNoOverflow('1')->format('Ym') }}#frame-{{$frame->id}}" class="list-group-item btn btn-light d-flex align-items-center">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </div>
        </div>

        {{-- defaultテンプレート --}}
        <div class="float-right col-sm-5">

            {{-- 今月へボタン --}}
            <a href="{{url('/')}}/plugin/reservations/month/{{$page->id}}/{{$frame->id}}/{{ Carbon::today()->format('Ym') }}#frame-{{$frame->id}}" class="list-group-item btn btn-light rounded-pill">
                {{__('messages.to_this_month')}}<br>({{ App::getLocale() == ConnectLocale::ja ? Carbon::today()->format('Y年n月') : Carbon::today()->format('M Y') }})
            </a>
        </div>
    </div>
</div>
<br>
{{-- 登録している施設分ループ --}}
@foreach ($calendars as $facility_name => $calendar_details)

    {{-- 施設名 --}}
    <span class="h5">＜{{ $facility_name }}＞</span>

    {{-- カレンダーデータ部 --}}
    <table class="table table-bordered cc_responsive_table" style="table-layout:fixed;">
        <thead>
            {{-- カレンダーヘッダ部の曜日を表示 --}}
            <tr>
                @foreach (DayOfWeek::getMembers() as $key => $desc)
                    {{-- 日曜なら赤文字、土曜なら青文字 --}}
                    <th class="text-center bg-light{{ $key == DayOfWeek::sun ? ' text-danger' : '' }}{{ $key == DayOfWeek::sat ? ' text-primary' : '' }}">{{ $desc }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{-- カレンダーデータ部の表示 --}}
            @foreach ($calendar_details['calendar_cells'] as $cell)
                {{-- 日曜日なら新しい行 --}}
                @if ($cell['date']->dayOfWeek == 0)
                    <tr>
                @endif
                        <td class="
                            {{-- 当月以外ならセル背景をグレーアウト --}}
                            {{ $cell['date']->month != $carbon_target_date->month ? 'd-none d-md-table-cell bg-light' : '' }}
                            {{-- 当月、且つ、日曜なら赤文字 --}}
                            {{ $cell['date']->month == $carbon_target_date->month && $cell['date']->dayOfWeek == DayOfWeek::sun ? 'cc-color-sunday' : '' }}
                            {{-- 当月、且つ、日曜なら赤文字 --}}
                            {{ $cell['date']->month == $carbon_target_date->month && $cell['date']->dayOfWeek == DayOfWeek::sat ? 'cc-color-saturday' : '' }}
                            "
                        >
                            <div class="clearfix">
                                {{-- 日付 --}}
                                <div class="float-left font-weight-bold text-secondary">
                                    @include('plugins.user.reservations.default.include_calendar_day', ['date' => $cell['date']])

                                    {{-- 曜日（767px以下で表示） --}}
                                    <span class="d-md-none">
                                        @include('plugins.user.reservations.default.include_calendar_day_of_week', ['date' => $cell['date']])
                                    </span>
                                </div>
                                {{-- ＋ボタン --}}
                                <div class="float-right">
                                    @can('posts.create',[[null, $frame->plugin_name, $buckets]])
                                        {{-- セル毎に予約追加画面呼び出し用のformをセット --}}
                                        <form action="{{URL::to('/')}}/plugin/reservations/editBooking/{{$page->id}}/{{$frame_id}}#frame-{{$frame_id}}" name="form_edit_booking_{{$frame_id}}_{{ $reservations->id }}_{{ $calendar_details['facility']->id }}_{{ $cell['date']->format('Ymd') }}" method="POST" class="form-horizontal">
                                            {{ csrf_field() }}
                                            {{-- 施設予約ID --}}
                                            <input type="hidden" name="reservations_id" value="{{ $reservations->id }}">
                                            {{-- 施設ID --}}
                                            <input type="hidden" name="facility_id" value="{{ $calendar_details['facility']->id }}">
                                            {{-- 対象日付 --}}
                                            <input type="hidden" name="target_date" value="{{ $cell['date']->format('Ymd') }}">
                                            {{-- ＋ボタンクリックでformサブミット --}}
                                            <a href="javascript:form_edit_booking_{{$frame_id}}_{{ $reservations->id }}_{{ $calendar_details['facility']->id }}_{{ $cell['date']->format('Ymd') }}.submit()">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                            @if (isset($cell['bookings']))
                                @foreach ($cell['bookings'] as $booking)
                                    <div class="row py-1">
                                        <div class="d-md-none col-1"></div>
                                        <div class="col-11 col-md-12">

                                            <a href="#bookingDetailModal{{$frame_id}}" role="button" data-toggle="modal"
                                                {{-- モーダルウィンドウに渡す予約入力値をセット（固定項目） --}}
                                                data-booking_id="{{ $booking['booking_header']->id }}"
                                                data-facility_name="{{ $facility_name }}"
                                                data-reservation_date_display="{{$booking['booking_header']->displayDate()}}"
                                                data-reservation_time="{{ $booking['booking_header']->start_datetime->format('H:i')}} ~ {{$booking['booking_header']->end_datetime->format('H:i') }}"
                                                @can('posts.update', [[$booking['booking_header'], $frame->plugin_name, $buckets]]) data-is_edit="1" @endcan
                                                @can('posts.delete', [[$booking['booking_header'], $frame->plugin_name, $buckets]]) data-is_delete="1" @endcan
                                                {{-- モーダルウィンドウに渡す予約入力値をセット（可変項目） --}}
                                                @foreach ($booking['booking_details'] as $bookingDetail)
                                                    @switch($bookingDetail->column_type)
                                                        {{-- テキスト項目 --}}
                                                        @case(ReservationColumnType::text)

                                                            data-column_{{ $bookingDetail->column_id }}="{{ $bookingDetail->value ? $bookingDetail->value : " " }}"
                                                            @break

                                                        {{-- ラジオボタン項目 --}}
                                                        @case(ReservationColumnType::radio)

                                                            {{-- ラジオボタン項目の場合、valueにはreservations_columns_selectsテーブルのIDが入っているので、該当の選択肢データを取得して選択肢名をセットする --}}
                                                            @php
                                                                $filtered_select = $selects->first(function($select) use($bookingDetail) {
                                                                    return $select->reservations_id == $bookingDetail->reservations_id && $select->column_id == $bookingDetail->id && $select->id == $bookingDetail->value;
                                                                });
                                                                $filtered_select ? $filtered_select->toArray() : null;
                                                            @endphp
                                                                data-column_{{ $bookingDetail->column_id }}="{{ $filtered_select ? $filtered_select->select_name : '' }}"
                                                                @break
                                                        @default

                                                    @endswitch
                                                @endforeach
                                            >
                                                {{-- 表示用の予約時間 --}}
                                                <div class="small">{{ $booking['booking_header']->start_datetime->format('H:i')}}~{{$booking['booking_header']->end_datetime->format('H:i') }}</div>
                                            </a>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </td>
                {{-- 土曜日なら行を閉じる --}}
                @if ($cell['date']->dayOfWeek == 6)
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endforeach
