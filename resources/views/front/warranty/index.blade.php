@extends('front.layouts.layout')

@section('title', $title ?? '')

@section('content')

    @include('front.partials.header-user')

    @include('front.partials.sidebar')

    <div class="main" id="main">
        <div class="page-warranty">
            <div class="page-name">
                <h1>Гарантійні заяви</h1>
                <div class="btns">
                    <a href="{{route('warranty.create')}}">
                        <button type="button" class="btn-primary btn-blue icon-plus">Створити</button>
                    </a>
                    <button type="button" class="btn-primary btn-blue icon-filters _js-show-filters">Фільтри</button>
                </div>
            </div>

            <div class="filters custom-scrollbar">
                <a href="#" class="logo">
                    <img src="{{asset('assets/front/img/components/logo.svg')}}" alt="">
                </a>
                <div class="filters-title">
                    <p>Фільтри таблиці</p>
                    <button type="button" class="icon-close-fill _js-show-filters"></button>
                </div>

                    <div class="filters-main">
                        <form id="filter-form" action="{{route('warranty.index')}}" method="get">
                            <div class="filter-group js-accordion">
                                <div class="filter-group__head js-accordion-btn">
                                    <p>Заяви за період</p>
                                    <button type="button" class="icon-arrow-dropdown"></button>
                                </div>
                                <div class="filter-group__content js-accordion-content">
                                    <div class="filter-group__content__wrapper">
                                        <div class="form-group horizontal">
                                            <label for="date-start">З</label>
                                            <div class="input-wrapper">
                                                <input type="text" id="date-start" name="date-start" placeholder="дд.мм.рррр" class="_js-datepicker">
                                                <span class="icon-calendar"></span>
                                            </div>
                                        </div>
                                        <div class="form-group horizontal _mb0">
                                            <label for="date-end">по</label>
                                            <div class="input-wrapper">
                                                <input type="text" id="date-end" name="date-end" placeholder="дд.мм.рррр" class="_js-datepicker">
                                                <span class="icon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-group js-accordion">
                                <div class="filter-group__head js-accordion-btn">
                                    <p>Артикул </p>
                                    <button type="button" class="icon-arrow-dropdown"></button>
                                </div>
                                <div class="filter-group__content js-accordion-content">
                                    <div class="filter-group__content__wrapper">
                                        <div class="form-group _mb0">
                                            <input type="text" id="article" name="article" placeholder="Артикул">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-group js-accordion">
                                <div class="filter-group__head js-accordion-btn">
                                    <p>Статус</p>
                                    <button type="button" class="icon-arrow-dropdown"></button>
                                </div>
                                <div class="filter-group__content js-accordion-content">
                                    <div class="filter-group__content__wrapper">
                                        @if($statuses)
                                            @foreach($statuses as $key => $status)
                                                <div class="form-group checkbox">
                                                    <input type="checkbox" id="status-{{$key}}" name="status[]" value="{{$status}}">
                                                    <label for="status-{{$key}}">{{$status}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="filter-group js-accordion">
                                <div class="filter-group__head js-accordion-btn">
                                    <p>Автор документу</p>
                                    <button type="button" class="icon-arrow-dropdown"></button>
                                </div>
                                <div class="filter-group__content js-accordion-content">
                                    <div class="filter-group__content__wrapper">
                                        <div class="form-group default-select">
                                            <select name="author" id="author">
                                                <option selected value="">Автор документу</option>
                                                @if($authors->isNotEmpty())
                                                    @foreach($authors as $author)
                                                        <option value="{{ $author }}">{{ $author }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Немає авторів</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center; margin-top: 10px">
                                <button class="btn-border btn-blue" type="submit">Застосувати фільтри</button>
                            </div>
                        </form>
                    </div>
                <div class="filters-footer">
                    <p>AL-KO Copyright © 2023 </p>
                </div>
            </div>

            @if($warranties->isNotEmpty())
                <div class="card-content card-table">
                    <div class="table-wrapper">
                        <div class="table table-actions layout-fixed add-scroll">
                            <div class="thead">
                                <div class="tr">
                                    <div class="th">№ документу
                                        <a href="{{route('warranty.index', ['sort_field' => 'number_1c', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th">Дата документу
                                        <a href="{{route('warranty.index', ['sort_field' => 'date_of_claim', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th">Артикул
                                        <a href="{{route('warranty.index', ['sort_field' => 'product_article', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th">Назва товару
                                        <a href="{{route('warranty.index', ['sort_field' => 'product_name', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th">Вартість запчастин, грн
                                        <a href="{{route('warranty.index', ['sort_field' => 'spare_parts_sum', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th">Вартість робіт, грн
                                        <a href="{{route('warranty.index', ['sort_field' => 'service_works_sum', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th">Поточний статус
                                        <a href="{{route('warranty.index', ['sort_field' => 'status', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th">Автор документу
                                        <a href="{{route('warranty.index', ['sort_field' => 'autor', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])}}" class="icon-switch"></a>
                                    </div>
                                    <div class="th _empty"></div>
                                    <div class="th">Дії</div>
                                </div>
                            </div>
                            <div class="tbody">
                                @foreach($warranties as $warranty)
                                    <div class="tr">
                                        <a href="{{ route('warranty.edit', $warranty->id) }}" style="display: contents; text-decoration: none; color: inherit;">
                                            <div class="td">{{$warranty->number_1c}}</div>
                                            <div class="td">{{$warranty->date_of_claim}}</div>
                                            <div class="td">{{$warranty->product_article}}</div>
                                            <div class="td">{{$warranty->product_name}}</div>
                                            <div class="td">{{$warranty->spare_parts_sum}}</div>
                                            <div class="td">{{$warranty->service_works_sum}}</div>
                                            <div class="td">
                                                <button type="button" class="btn-label blue">{{$warranty->status}}</button>
                                            </div>
                                            <div class="td">{{$warranty->autor}}</div>
                                            <div class="td _empty"></div>
                                            <div class="td">
                                                <a href="" class="btn-action icon-pdf"></a>
                                                <a href="" class="btn-action icon-message _inactive"></a>
                                                <a href="" class="btn-action icon-message _notification"></a>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            <div class="pagination">
                <div class="pagination-total">
                    Показано документів <strong>{{$from}}-{{$to}}</strong> з <strong>{{$warranties->total()}}</strong>
                </div>
                <div class="pagination-next">
                    @if($warranties->hasMorePages())
                        <a href="{{ $warranties->nextPageUrl() . $queryString }}" class="btn-primary btn-blue">
                            Наступна сторінка
                            <span class="icon-arrow-dropdown"></span>
                        </a>
                    @else
                        <span class="btn-primary btn-blue disabled">
                            Наступна сторінка
                            <span class="icon-arrow-dropdown"></span>
                        </span>
                    @endif
                </div>
                <div class="pagination-select-wrapper">
                    <p>Сторінка</p>
                    <div class="form-group">
                        <select name="" id="pagin">
                            @for($i = 1; $i <= $totalPages; $i++)
                                <option value="{{ $warranties->url($i) . $queryString }}" @if($i == $warranties->currentPage()) selected @endif>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <p>з <strong>{{$warranties->lastPage()}}</strong></p>
                </div>
            </div>
            @else
                <div class="">Гарантійні заяви відсутні</div>
            @endif
        </div>
    </div>

    <div class="modal-overlay"></div>

    <div class="modal modal-chat js-modal js-modal-chat">
        <button type="button" class="icon-close-fill btn-close _js-btn-close-modal"></button>
        <div class="modal-content">
            <div class="chat-header">
                <p class="modal-title">
                    Коментарі до документу
                </p>
                <div class="chat-desc">
                    <p><strong>Документ:</strong> Назва документу</p>
                    <p><strong>Ваш менеджер/дилер:</strong> Іванов Іван Іванович </p>
                </div>
            </div>

            <!-- if empty, add class "_empty"-->
            <div class="chat-main custom-scrollbar">
                <div class="chat-main__wrapper ">
                    <!--                <div class="chat-empty">-->
                    <!--                    <p>До цього документу поки що немає коментарів</p>-->
                    <!--                </div>-->

                    <div class="message sender">
                        <div class="message-controls">
                            <button type="button" class="btn-delete"></button>
                            <ul class="controls-list">
                                <li>
                                    <button type="button" class="icon-edit">Редагувати</button>
                                </li>
                                <li>
                                    <button type="button" class="icon-trash">Видалити</button>
                                </li>
                            </ul>
                        </div>
                        <p class="message-author">Петров Петр Петрович (Ви)</p>
                        <div class="message-text">
                            Lorem ipsum dolor sit amet consectetur. Sit sed pretium donec aliquet viverra proin. Metus quam
                            integer commodo massa fringilla nunc sit montes.
                        </div>
                        <div class="message-date">12:00, 01.01.2024</div>
                    </div>
                    <div class="message">
                        <p class="message-author">Іванов Іван Іванович (Менеджер)</p>
                        <div class="message-text">
                            Lorem ipsum dolor sit amet consectetur. Sit sed pretium donec aliquet viverra proin. Metus quam
                            integer commodo massa fringilla nunc sit montes.
                        </div>
                        <div class="message-date">12:00, 01.01.2024</div>
                    </div>
                </div>
            </div>
            <div class="chat-footer">
                <div class="form-group">
                    <input type="text" name="chat-text" placeholder="Ваш текст">
                </div>
                <button type="button" class="btn-primary btn-blue">Надіслати</button>
            </div>
        </div>
    </div>

    <div class="modal modal-manager js-modal js-modal-switch-manager">
        <button type="button" class="icon-close-fill btn-close _js-btn-close-modal"></button>
        <div class="modal-content ">
            <div class="manager-header">
                <p class="modal-title">Оберіть менеджера</p>

                <div class="form-group">
                    <span class="icon-search"></span>
                    <input type="text" placeholder="пошук" name="manager-search">
                </div>
            </div>
            <div class="manager-body custom-scrollbar">
                <div class="form-group radio">
                    <input type="radio" id="manager-1" name="manager">
                    <label for="manager-1">Прізвище Ім'я По батькові</label>
                </div>
                <div class="form-group radio">
                    <input type="radio" id="manager-2" name="manager">
                    <label for="manager-2">Прізвище Ім'я По батькові</label>
                </div>
                <div class="form-group radio">
                    <input type="radio" id="manager-3" name="manager">
                    <label for="manager-3">Прізвище Ім'я По батькові</label>
                </div>
                <div class="form-group radio">
                    <input type="radio" id="manager-4" name="manager">
                    <label for="manager-4">Прізвище Ім'я По батькові</label>
                </div>
                <div class="form-group radio">
                    <input type="radio" id="manager-5" name="manager">
                    <label for="manager-5">Прізвище Ім'я По батькові</label>
                </div>
                <div class="form-group radio">
                    <input type="radio" id="manager-6" name="manager">
                    <label for="manager-6">Прізвище Ім'я По батькові</label>
                </div>
                <div class="form-group radio">
                    <input type="radio" id="manager-7" name="manager">
                    <label for="manager-7">Прізвище Ім'я По батькові</label>
                </div>
            </div>
            <div class="manager-footer">
                <button type="button" class="btn-primary btn-blue">Переназначити менеджера</button>
            </div>
        </div>
    </div>


    <div class="modal modal-alert js-modal js-modal-switch-status">
        <button type="button" class="icon-close-fill btn-close _js-btn-close-modal"></button>
        <div class="modal-content ">
            <p class="modal-title">Змінити статус заяви на помилковий?</p>
            <div class="modal-desc">
                <p>Ви впевнені, що хочете Змінити статус документу “Гарантійна заява” на помилковий?</p>
            </div>
            <div class="btns">
                <button type="button" class="btn-border btn-blue">Заява вірна</button>
                <button type="button" class="btn-primary btn-red">Заява помилкова</button>
            </div>
        </div>
    </div>

    <div class="modal modal-alert modal-alert-delete js-modal js-modal-delete">
        <button type="button" class="icon-close-fill btn-close _js-btn-close-modal"></button>
        <div class="modal-content ">
            <p class="modal-title">Видалити Гарантійну заяву?</p>
            <div class="btns">
                <button type="button" class="btn-border btn-blue">Зберегти</button>
                <button type="button" class="btn-primary btn-red">Видалити</button>
            </div>
        </div>
    </div>

    <div class="modal modal-document js-modal js-modal-import-document custom-scrollbar">
        <button type="button" class="icon-close-fill btn-close _js-btn-close-modal"></button>
        <div class="modal-content ">
            <p class="modal-title">Імпорт документу</p>

            <form action="">
                <div class="form-group required" data-valid="empty">
                    <label for="doc-name">Назва документа</label>
                    <input type="text" id="doc-name" name="doc-name" placeholder="Назва">
                    <div class="help-block" data-empty="Required field"></div>
                </div>

                <div class="form-group required default-select" data-valid="default-select">
                    <label for="doc-type">Група товару</label>
                    <select name="" id="doc-type">
                        <option value="-1">Оберіть варіант</option>
                        <option value="1">Варіант - 1</option>
                        <option value="2">Варіант - 2</option>
                        <option value="3">Варіант - 3</option>
                        <option value="4">Варіант - 4</option>
                        <option value="5">Варіант - 5</option>
                    </select>
                </div>

                <div class="form-group required default-select" data-valid="default-select">
                    <label for="prod-cat">Група товару</label>
                    <select name="" id="prod-cat">
                        <option value="-1">Оберіть варіант</option>
                        <option value="1">Варіант - 1</option>
                        <option value="2">Варіант - 2</option>
                        <option value="3">Варіант - 3</option>
                        <option value="4">Варіант - 4</option>
                        <option value="5">Варіант - 5</option>
                    </select>
                </div>

                <div class="form-group file">
                    <label for="doc-file" class="btn-border btn-blue">Обрати файл ( Word / PDF / Excel) </label>
                    <input type="file" id="doc-file">
                </div>

                <div class="file-name-preview">
                    Lorem ipsum dolor sit amet consectetur. pdf
                </div>

                <button type="submit" class="btn-primary btn-blue">Завантажити документ</button>

            </form>
        </div>
    </div>

    <div class="modal modal-document js-modal js-modal-edit-document custom-scrollbar">
        <button type="button" class="icon-close-fill btn-close _js-btn-close-modal"></button>
        <div class="modal-content ">
            <p class="modal-title">Редагування документа</p>

            <form action="">
                <div class="form-group required" data-valid="empty">
                    <label for="doc-name-1">Назва документа</label>
                    <input type="text" id="doc-name-1" name="doc-name" value="Назва">
                    <div class="help-block" data-empty="Required field"></div>
                </div>

                <div class="form-group required default-select" data-valid="default-select">
                    <label for="doc-type-1">Група товару</label>
                    <select name="" id="doc-type-1">
                        <option value="-1">Оберіть варіант</option>
                        <option value="1" selected>Варіант - 1</option>
                        <option value="2">Варіант - 2</option>
                        <option value="3">Варіант - 3</option>
                        <option value="4">Варіант - 4</option>
                        <option value="5">Варіант - 5</option>
                    </select>
                </div>

                <div class="form-group required default-select" data-valid="default-select">
                    <label for="prod-cat-1">Група товару</label>
                    <select name="" id="prod-cat-1">
                        <option value="-1">Оберіть варіант</option>
                        <option value="1">Варіант - 1</option>
                        <option value="2">Варіант - 2</option>
                        <option value="3" selected>Варіант - 3</option>
                        <option value="4">Варіант - 4</option>
                        <option value="5">Варіант - 5</option>
                    </select>
                </div>

                <div class="form-group file">
                    <label for="doc-file-1" class="btn-border btn-blue">Обрати файл ( Word / PDF / Excel) </label>
                    <input type="file" id="doc-file-1">
                </div>

                <div class="file-name-preview">
                    Lorem ipsum dolor sit amet consectetur. pdf
                </div>

                <button type="submit" class="btn-primary btn-red">Зберегти зміни</button>

            </form>
        </div>
    </div>


    <div class="modal modal-gallery js-modal js-modal-gallery custom-scrollbar">
        <button type="button" class="icon-close-fill btn-close _js-btn-close-modal"></button>
        <div class="modal-content ">
            <button type="button" class="btn-border btn-blue btn-only-icon gallery-btn gallery-prev">
                <span class="icon-arrow-left"></span>
            </button>
            <button type="button" class="btn-border btn-blue btn-only-icon gallery-btn gallery-next">
                <span class="icon-arrow-left"></span>
            </button>
            <div class="swiper swiper-gallery">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{asset('assets/front/img/delete/gallery-img.webp')}}" type="image/webp">
                            <img src="{{asset('assets/front/img/delete/gallery-img.jpg')}}" loading="lazy" alt="" title="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{asset('assets/front/img/delete/gallery-img.webp')}}" type="image/webp">
                            <img src="{{asset('assets/front/img/delete/gallery-img.jpg')}}" loading="lazy" alt="" title="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{asset('assets/front/img/delete/gallery-img.webp')}}" type="image/webp">
                            <img src="{{asset('assets/front/img/delete/gallery-img.jpg')}}" loading="lazy" alt="" title="">
                        </picture>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>

        </div>
    </div>

    <div id="datepicker-container"></div>

@endsection
