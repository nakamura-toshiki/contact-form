@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/contacts" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="full-name" value="{{ $contact['last_name']. '  '. $contact['first_name'] }}" readonly>
                    </td>
                </tr>
                <input type="hidden" name='last_name' value="{{ $contact['last_name'] }}">
                <input type="hidden" name='first_name' value="{{ $contact['first_name'] }}">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly>
                        @if($contact['gender'] == 1)
                        <p>男性</p>
                        @elseif($contact['gender'] == 2)
                        <p>女性</p>
                        @else
                        <p>その他</p>
                        @endif
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="text" name="email" value="{{ $contact['email'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="text" name="tel" value="{{ $contact['tel1']. $contact['tel2']. $contact['tel3'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly>
                        @if($contact['category_id'] == 1)
                        <p>商品のお届けについて</p>
                        @elseif($contact['category_id'] == 2)
                        <p>商品の交換について</p>
                        @elseif($contact['category_id'] == 3)
                        <p>商品トラブル</p>
                        @elseif($contact['category_id'] == 4)
                        <p>ショップへのお問い合わせ</p>
                        @else($contact['category_id'] == 5)
                        <p>その他</p>
                        @endif
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly>
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <div class="form__button-submit">
                <button type="submit">送信</button>
            </div>
            <div class="form__button-modify">
                <a href="/">修正</a>
            </div>
    </form>
</div>
@endsection