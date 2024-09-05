
@extends('front.layouts.layout')

@section('title', $title ?? '')

@section('content')

    @include('front.partials.header-user')

    @include('front.partials.sidebar')

    <div class="main" id="main">
        <div class="page-warranty-create">
            <form action="{{route('ate.store')}}" method="post" class="card-lists js-form-validation" id="form-id">
            @csrf

            <div class="page-name sticky">
                <h1>Акт технічної експертизи</h1>
                <div class="btns">
                    <button type="submit" class="btn-border btn-blue text-only">Зберегти</button>
                    <button type="button" class="btn-border btn-blue btn-only-icon _js-btn-show-modal" data-modal="chat">
                        <span class="icon-message"></span>
                    </button>
                    <button type="button" class="btn-border btn-blue btn-only-icon">
                        <span class="icon-pdf"></span>
                    </button>
                    <button type="button" class="btn-border btn-blue btn-only-icon">
                        <span class="icon-message-fly"></span>
                    </button>
                </div>
            </div>

                <div class="card-lists">
                    <div class="card-lists">
                        <div class="card-content card-form">
                            <p class="card-title">Загальна інформація</p>
                            <div class="inputs-group one-row">
                                <div class="form-group">
                                    <label for="number_1c">Номер документу</label>
                                    <input type="text" id="number_1c" name="number_1c" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="date">Дата документу</label>
                                    <input type="text" id="date" name="date" value="{{date('Y-m-d')}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="factory-number">Відповідальний</label>
                                    <input type="text" id="factory-number" value="" placeholder="Прізвище Ім'я По батькові">
                                </div>
                                <div class="form-group">
                                    <label for="warranty_claim_number_1c">Документ-підстава</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="warranty_claim_number_1c" name="warranty_claim_number_1c" value="" placeholder="Номер гарантійної заяви">
                                    </div>
                                </div>
                            </div>
                            <div class="inputs-group one-row">
                                <div class="form-group">
                                    <label for="field-1">ПІБ покупця</label>
                                    <input type="text" id="field-1" value="" placeholder="Місце продажу">
                                </div>
                                <div class="form-group">
                                    <label for="field-2">Контактний телефон</label>
                                    <input type="text" id="field-2" value="" placeholder="+38ХХХХХХХХХХ">
                                </div>
                                <div class="form-group">
                                    <label for="field-3">Артикул</label>
                                    <input type="text" id="field-3" value="">
                                </div>
                                <div class="form-group">
                                    <label for="field-4">Назва виробу</label>
                                    <input type="text" id="field-4" value="">
                                </div>
                            </div>
                            <div class="inputs-group one-row">
                                <div class="form-group">
                                    <label for="place-sale">Місце продажу</label>
                                    <input type="text" id="place-sale" value="">
                                </div>
                                <div class="form-group">
                                    <label for="date-sale">Дата продажу</label>
                                    <input type="text" id="date-sale" value=""  placeholder="РРРР-ММ-ДД" class="_js-datepicker">
                                </div>
                                <div class="form-group">
                                    <label for="date-start">Дата звернення в сервісний центр</label>
                                    <input type="text" id="date-start" value="" placeholder="РРРР-ММ-ДД" class="_js-datepicker">
                                </div>
                                <div class="form-group">
                                    <label for="receipt-number">Номер квитанції сервісного центру</label>
                                    <input type="text" id="receipt-number" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-lists">
                        <div class="card-lists">
                            <div class="card-content card-form">
                                <p class="card-title">Технічна інформація</p>
                                <div class="inputs-group one-row">
                                    <div class="form-group">
                                        <label for="field-5">Заводський номер</label>
                                        <input type="text" id="field-5" value="">

                                    </div>

                                    <div class="form-group default-select">
                                        <label for="defect_codes_code_1c">Код дефекту</label>
                                        <select name="defect_codes_code_1c" id="defect_codes_code_1c">
                                            <option value="-1">Код дефекту</option>
                                            @if($defectCodes)
                                                @foreach($defectCodes as $parentDefectCode)
                                                    <option class="text-blue text-bold" value="{{ $parentDefectCode['code_1C'] }}" disabled>
                                                        {{ $parentDefectCode['name'] }}
                                                    </option>
                                                    @if(isset($parentDefectCode['children']))
                                                        @foreach($parentDefectCode['children'] as $childDefectCode)
                                                            <option class="" value="{{ $childDefectCode['code_1C'] }}">
                                                                {{ $childDefectCode['name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group default-select">
                                        <label for="symptom_codes_code_1c">Код симптому</label>
                                        <select name="symptom_codes_code_1c" id="symptom_codes_code_1c">
                                            <option value="-1">Код симптому</option>
                                            @if($symptomCodes)
                                                @foreach($symptomCodes as $parentSymptomCode)
                                                    <option class="text-blue text-bold" value="{{ $parentSymptomCode['code_1C'] }}" disabled>
                                                        {{ $parentSymptomCode['name'] }}
                                                    </option>
                                                    @if(isset($parentSymptomCode['children']))
                                                        @foreach($parentSymptomCode['children'] as $childSymptomCode)
                                                            <option class="" value="{{ $childSymptomCode['code_1C'] }}">
                                                                {{ $childSymptomCode['name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group default-select">
                                        <label for="appeal_type">Тип звернення</label>
                                        <select name="appeal_type" id="appeal_type">
                                            <option value="">Тип звернення</option>
                                            @if($appealTypes)
                                                @foreach($appealTypes as $appealType)
                                                    <option value="{{ $appealType }}">{{ $appealType }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="inputs-group one-row">
                                    <div class="form-group">
                                        <label for="conclusion">Висновок</label>
                                        <textarea id="conclusion" name="conclusion" placeholder="Причина дефекту" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="resolution">Резолюція</label>
                                        <textarea id="resolution" name="resolution" placeholder="Причина дефекту" rows="3"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
