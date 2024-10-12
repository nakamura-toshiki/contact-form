@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<nav>
    <ul class="header-nav">
        <li class="header-nav__button">
            <form action="/logout" method="post">
                @csrf
                <button class="header-nav__button-logout">logout</button>
            </form>
        </li>
    </ul>
</nav>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__content-heading">
        <h2>Admin</h2>
    </div>
    <form class="search-form" action="/admin/search" method="get">
        <div class="search-form__item">
            <input class="search-form__item-text" type="text" placeholder="名前やメールアドレスを入力してください" name="keyword" value="{{ old('keyword') }}">
            <div class="search-form__item-select">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="全て">全て</option>
                    @foreach ($contacts as $contact)
                        <option value="{{ $contact->getGender() }}" @if($contact=='{{ $contact->getGender() }}') selected @endif>{{ $contact->getGender() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__item-select">
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->content }}</option>
                        @endforeach
                </select>
            </div>
            <input class="search-form__item-date" type="date" name="created_at" value="{{ old('created_ad') }}">
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
            <input class="search-form__button-reset" type="reset" value="リセット">
        </div>
    </form>
    <div class="admin__item">
        <div class="export__button">
            <form method="GET" action="{{ route('export') }}">
                @foreach( $search_params as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="hover:opacity-75 bg-blue-500 font-semibold text-white py-2 px-4 rounded">
                    エクスポート
                </button>
            </form>
        </div>
        {{ $contacts->links() }}
    </div>
    <div class="admin-table">
        <table class="admin-table__inner">
            <tr class="admin-table__header-row">
                <th class="admin-table__header-1">お名前</th>
                <th class="admin-table__header-2">性別</th>
                <th class="admin-table__header-3">メールアドレス</th>
                <th class="admin-table__header-4">お問い合わせの種類</th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="admin-table__row">
                <td class="admin-table__item-1">
                    {{ $contact['last_name'] . ' ' . $contact['first_name'] }}
                </td>
                <td class="admin-table__item-2">
                    @if($contact['gender'] == 1)
                        <p>男性</p>
                        @elseif($contact['gender'] == 2)
                        <p>女性</p>
                        @else
                        <p>その他</p>
                    @endif
                </td>
                <td class="admin-table__item-3">
                    {{ $contact['email'] }}
                </td>
                <td class="admin-table__item-4">
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
                <td class="admin-table__item-5">
                    <input type="checkbox" id="modalToggle" class="admin-table__modal-checkbox">
                    <label for="modalToggle" class="admin-table__modal-btn">詳細</label>
                    <div class="admin-table__modal-content">
                        <div class="admin-table__modal-inner">
                            <label for="modalToggle" class="admin-table__modal-close">&times;</label>
                            <form class="delete-form" action="/admin/delete" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="modal-table">
                                <table class="modal-table__inner">
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">お名前</th>
                                        <td class="modal-table__text">
                                            {{ $contact['last_name']. '  '. $contact['first_name'] }}
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">性別</th>
                                        <td class="modal-table__text">
                                            
                                            @if($contact['gender'] == 1)
                                            <p>男性</p>
                                            @elseif($contact['gender'] == 2)
                                            <p>女性</p>
                                            @else
                                            <p>その他</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">メールアドレス</th>
                                        <td class="modal-table__text">
                                            {{ $contact['email'] }}
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">電話番号</th>
                                        <td class="modal-table__text">
                                            {{ $contact['tel']}}
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">住所</th>
                                        <td class="modal-table__text">
                                            {{ $contact['address'] }}
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">建物名</th>
                                        <td class="modal-table__text">
                                            {{ $contact['building'] }}
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">お問い合わせの種類</th>
                                        <td class="modal-table__text">
                                            
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
                                    <tr class="modal-table__row">
                                        <th class="modal-table__header">お問い合わせ内容</th>
                                        <td class="modal-table__text">
                                            {{ $contact['detail'] }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="delete-form__button">
                                    <input type="hidden" name="id" value="{{ $contact['id'] }}">
                                    <button class="delete-form__button-submit" type="submit">削除</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection