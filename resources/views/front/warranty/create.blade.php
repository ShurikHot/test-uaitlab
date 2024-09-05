@extends('front.layouts.layout')

@section('title', $title ?? '')

@section('content')

    @include('front.partials.header-user')

    @include('front.partials.sidebar')

    <div class="main" id="main">
        <div class="page-warranty-create">
            <div class="page-name sticky">
                <h1>Гарантійна заява</h1>
                <div class="btns">
                    <button type="submit" class="btn-border btn-blue js-btn-required-switcher" form="form-id" data-required-switcher="remove">Зберегти</button>
                </div>
            </div>

            <form action="{{route('warranty.store')}}" method="post" class="card-lists js-form-validation" id="form-id" enctype="multipart/form-data">
                @csrf

                <div class="card-content card-form">
                    <p class="card-title">Загальна інформація</p>
                    <div class="inputs-group one-row">
                        <div class="form-group">
                            <label for="number_1c">Номер документу</label>
                            <input type="text" id="number_1c" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="date">Дата документу</label>
                            <input type="text" id="date" name="date" value="{{date('Y-m-d')}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="author">Відповідальний</label>
{{--                            <input type="text" id="author" value="Прізвище Ім'я По батькові" readonly>--}}
                            <select name="autor" id="author">
                                <option selected value="">Автор документу</option>
                                @if($authors->isNotEmpty())
                                    @foreach($authors as $author)
                                        <option value="{{ $author }}">{{ $author }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group required default-select" data-valid="vanilla-select">
                            <label for="service-center">Сервісний центр</label>
                            <select class="_js-select-2" name="service_partner" id="service-center">
                                <option value="-1">Виберіть сервісний центр</option>
                                <option value="2" selected>
                                    ТОВ -АЛ-КО Кобер-
                                </option>
                                <option value="5">
                                    ЗЕЛЕНСЬКА АЛІНА ПАВЛІВНА
                                </option>
                                <option value="6">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ «САНІСАВ»
                                </option>
                                <option value="18">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -НАЙТЕК-
                                </option>
                                <option value="20">
                                    ЧОРНА НАТАЛІЯ МИКОЛАЇВНА. ФОП
                                </option>
                                <option value="21">
                                    Товариство з обмеженою відповідальнісью -УМС-Бот-
                                </option>
                                <option value="22">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -КУПАВА-УКРТОРГ-
                                </option>
                                <option value="26">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -АВРОРА ГРУП-
                                </option>
                                <option value="28">
                                    ВАРЧЕНКО ЛІЛІЯ ГЕННАДІЇВНА
                                </option>
                                <option value="55">
                                    ДП -ПРОГРЕС-ТНС-
                                </option>
                                <option value="64">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -АКАНТ СВ-
                                </option>
                                <option value="65">
                                    ЛИСЕНКО ЯНА ВІКТОРІВНА
                                </option>
                                <option value="70">
                                    ЛУКАШЕНКО МАКСИМ ВЛАДИСЛАВОВИЧ
                                </option>
                                <option value="78">
                                    СПД-ФО Ібрагімов М.Є.
                                </option>
                                <option value="84">
                                    Товариство з обмеженою відповідальністю -Епіцентр К-
                                </option>
                                <option value="85">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -КВАДРО ІНТЕРНЕШНЛ-
                                </option>
                                <option value="88">
                                    РОЗУМІЙ ВАЛЕНТИН ІВАНОВИЧ
                                </option>
                                <option value="92">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ТВІЙ ІНСТРУМЕНТ-
                                </option>
                                <option value="95">
                                    СТАРЦЕВА НАТАЛІЯ ВАСИЛІВНА
                                </option>
                                <option value="121">
                                    ПАВЕНКО ЯРОСЛАВ ОЛЕКСАНДРОВИЧ
                                </option>
                                <option value="129">
                                    ВАКУЛЮК МАКСИМ ВОЛОДИМИРОВИЧ ФОП
                                </option>
                                <option value="131">
                                    ФЕЙШТЕР ВАДИМ РОДІОНОВИЧ
                                </option>
                                <option value="135">
                                    КРИЦЬКИЙ МИКОЛА ВАСИЛЬОВИЧ
                                </option>
                                <option value="138">
                                    КОЛЕСНИК МАРИНА ЮРІЇВНА
                                </option>
                                <option value="139">
                                    ГОРОХ ІРИНА ГРИГОРІВНА
                                </option>
                                <option value="141">
                                    ЛУЧИНЕЦЬ ОЛЕКСАНДР МИКОЛАЙОВИЧ
                                </option>
                                <option value="142">
                                    ТОПАЛОВА ЮЛІЯ МИКОЛАЇВНА
                                </option>
                                <option value="143">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ВІКТОРІЯ МАКС-
                                </option>
                                <option value="150">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -Т-ЦЕНТР СЕРВІС-
                                </option>
                                <option value="166">
                                    ШЕВЧЕНКО ОЛЕКСАНДР МИХАЙЛОВИЧ
                                </option>
                                <option value="167">
                                    ПРИВАТНЕ ПІДПРИЄМСТВО -СТАНДАРТ ЕЛЕКТРО-
                                </option>
                                <option value="171">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -І-ВЕСТ-
                                </option>
                                <option value="172">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -САНТЕ-
                                </option>
                                <option value="173">
                                    ПЕТРУХА ЯРИНА ВОЛОДИМИРІВНА
                                </option>
                                <option value="183">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ ТОРГОВО-БУДІВЕЛЬНА КОМПАНІЯ -БУДЦЕНТР-
                                </option>
                                <option value="195">
                                    СПД-ФО Нікулін В.М.
                                </option>
                                <option value="197">
                                    ТОВ -Автопричіп-
                                </option>
                                <option value="199">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ ТОРГОВЫЙ ДОМ -ТЕХНИКС-
                                </option>
                                <option value="206">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ПРЕМІУМ ІНДАСТРІ-
                                </option>
                                <option value="209">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ФЕРМА КРОЛІКОФФ-
                                </option>
                                <option value="210">
                                    ЗІНЧЕНКО ДМИТРО ВОЛОДИМИРОВИЧ
                                </option>
                                <option value="216">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ТОРГ-СЕРВІС-
                                </option>
                                <option value="218">
                                    ПП -Інструментал-
                                </option>
                                <option value="219">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -САДОВА ТЕХНІКА-ХАРКІВ-
                                </option>
                                <option value="223">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ДАС-ІНСТРУМЕНТ-
                                </option>
                                <option value="227">
                                    ХВАН ІГОР ВОЛОДИМИРОВИЧ
                                </option>
                                <option value="230">
                                    ШАХОНОВ СТАНІСЛАВ АНАТОЛІЙОВИЧ
                                </option>
                                <option value="233">
                                    КУЛЬБАШНИК ОЛЕГ ВОЛОДИМИРОВИЧ
                                </option>
                                <option value="234">
                                    СПД-ФО Іщенко С.О.
                                </option>
                                <option value="235">
                                    ПІНАХІН ОЛЕКСІЙ ОЛЕКСАНДРОВИЧ
                                </option>
                                <option value="237">
                                    ЯЛПАЧИК ОЛЕНА ВІКТОРІВНА
                                </option>
                                <option value="241">
                                    Денщикова Марія Максимівна
                                </option>
                                <option value="247">
                                    ТОВ -Профі Центр-
                                </option>
                                <option value="260">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ - ТОРГОВЕЛЬНО-БУДІВЕЛЬНИЙ ДІМ - ОЛДІ-
                                </option>
                                <option value="261">
                                    ЗАГУРСЬКИЙ ВЯЧЕСЛАВ СТЕПАНОВИЧ
                                </option>
                                <option value="264">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ТЕМПО БУД-
                                </option>
                                <option value="267">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -НОВА ЛІНІЯ 1-
                                </option>
                                <option value="274">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ «ІНТЕНСИВ»
                                </option>
                                <option value="279">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -АКВАТЕХНІКС-
                                </option>
                                <option value="286">
                                    СОБЧИНСЬКИЙ ЮРІЙ ВАЛЕРІЙОВИЧ
                                </option>
                                <option value="287">
                                    РОМАНЧЕНКО НАТАЛІЯ СТЕПАНІВНА
                                </option>
                                <option value="294">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -ТЕПЛО ОПТ-
                                </option>
                                <option value="295">
                                    ПРИВАТНЕ АКЦІОНЕРНЕ ТОВАРИСТВО -ПОЛТАВСЬКИЙ ТУРБОМЕХАНІЧНИЙ ЗАВОД-
                                </option>
                                <option value="304">
                                    НАГЛЮК ВАДИМ ОЛЕГОВИЧ
                                </option>
                                <option value="305">
                                    СПД-ФО Радінович С.Ю.
                                </option>
                                <option value="310">
                                    ГІТЛІНА НАТАЛІЯ ЮРІЇВНА
                                </option>
                                <option value="315">
                                    ТОВАРИСТВО З ОБМЕЖЕНОЮ ВІДПОВІДАЛЬНІСТЮ -АВТОБАН-
                                </option>

                            </select>
                            <div class="help-block" data-empty="Обов'язкове поле"></div>
                        </div>
                    </div>
                </div>
                <div class="display-grid col-2 gap-8">
                    <div class="card-content card-form">
                        <p class="card-title">Дані покупця</p>
                        <div class="inputs-group one-row">
                            <div class="form-group">
                                <label for="client_name">ПІБ покупця</label>
                                <input type="text" id="client_name" name="client_name" placeholder="Прізвище Ім'я По батькові">
                            </div>
                            <div class="form-group">
                                <label for="client_phone">Контактний телефон</label>
                                <input type="text" id="client_phone" name="client_phone" placeholder="+38xxxxxxxxxx">
                            </div>
                        </div>
                    </div>
                    <div class="card-content card-form">
                        <p class="card-title">Дані того Хто звернувся</p>
                        <button type="button" class="btn-link btn-copy btn-blue"> Копіювати данні покупця</button>

                        <div class="inputs-group one-row">
                            <div class="form-group required" data-required data-valid="empty">
                                <label for="sender_name">ПІБ</label>
                                <input type="text" id="sender_name" name="sender_name" value="">
                                <div class="help-block" data-empty="Required field"></div>
                            </div>
                            <div class="form-group required" data-required data-valid="empty">
                                <label for="sender_phone">Контактний телефон</label>
                                <input type="text" id="sender_phone" name="sender_phone" placeholder="+38XXXXXXXXXX">
                                <div class="help-block" data-empty="Required field"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content card-form">
                    <p class="card-title">Дані про товар</p>
                    <div class="inputs-group one-row">
                        <div class="form-group">
                            <label for="product_article">Артикул</label>
                            <input type="text" id="product_article" name="product_article" placeholder="Артикул">
                        </div>
                        <div class="form-group">
                            <label for="product_name">Назва виробу</label>
                            <input type="text" id="product_name" name="product_name" placeholder="Назва виробу">
                        </div>
                        <div class="form-group">
                            <label for="factory_number">Заводський номер</label>
                            <input type="text" id="factory_number" name="factory_number" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="barcode">Штрихкод гарантійного талону</label>
                            <input type="text" id="barcode" placeholder="0000000000">
                        </div>
                    </div>
                    <div class="inputs-group one-row">
                        <div class="form-group">
                            <label for="point_of_sale">Місце продажу</label>
                            <input type="text" id="point_of_sale" name="point_of_sale" placeholder="Місце продажу">
                        </div>
                        <div class="form-group">
                            <label for="date_of_sale">Дата продажу</label>
                            <div class="input-wrapper">
                                <input type="text" id="date_of_sale" name="date_of_sale" placeholder="РРРР-ММ-ДД" class="_js-datepicker">
                                <span class="icon-calendar"></span>
                            </div>
                        </div>
                        <div class="form-group required" data-required data-valid="empty">
                            <label for="date_of_claim">Дата звернення в сервісний центр</label>
                            <div class="input-wrapper">
                                <input type="text" id="date_of_claim" name="date_of_claim" placeholder="РРРР-ММ-ДД" class="_js-datepicker">
                                <span class="icon-calendar"></span>
                            </div>
                            <div class="help-block" data-empty="Required field"></div>
                        </div>
                        <div class="form-group">
                            <label for="receipt_number">Номер квитанції сервісного центру</label>
                            <input type="text" id="receipt_number" name="receipt_number" placeholder="0000000000">
                        </div>
                    </div>
                </div>
                <div class="card-content card-form">
                    <p class="card-title">Опис дефекту</p>
                    <div class="inputs-group one-row">
                        <div class="form-group required" data-required data-valid="empty">
                            <label for="details">Точний опис дефекту</label>
                            <textarea id="details" name="details" placeholder="Точний опис дефекту" rows="3"></textarea>
                            <div class="help-block" data-empty="Required field"></div>
                        </div>
                        <div class="form-group required" data-required data-valid="empty">
                            <label for="reason">Причина дефекту</label>
                            <textarea id="reason" placeholder="Причина дефекту" rows="3"></textarea>
                            <div class="help-block" data-empty="Required field"></div>
                        </div>
                    </div>
                </div>
                <div class="card-content card-form">
                    <p class="card-title">Підтверджуючі фото та інше</p>
                    <div class="inputs-group one-row">
                        <div class="form-group">
                            <label for="comment">Коментар</label>
                            <textarea id="comment" name="comment" placeholder="Коментар до заяви" rows="3"></textarea>
                        </div>
                        <div class="form-group file">
                            <input type="file" name="photo[]" id="file" multiple>
                            <label for="file">
                                <span class="icon-upload"></span>

                                <span class="help-block">Обов'язково до заповнення</span>

                                <p>Перетягніть файли сюди або натисніть
                                    <span class="_blue">додати файли (jpg,jpeg,png)</span>
                                    <span class="_red"> *</span>
                                </p>
                                <span class="_grey _lil">Максимальний розмір одного файлу 5Мб. Максимальний обсяг завантажених файлів 50 Мб</span>
                            </label>
                        </div>
                    </div>
                    <div class="inputs-group one-row">
                        <div class="image-preview"></div>
                    </div>
                </div>
                <div class="card-content card-form service-work">
                    <div class="card-title__wrapper">
                        <p class="card-title">Сервісні роботи</p>

                        <div class="form-group default-select {{--required--}}" data-valid="vanilla-select">
                            <select name="serviceWorkSelect" id="serviceWorkSelect">
                                <option value="-1">Оберіть сервісну роботу</option>
                                @if($serviceWorks->isNotEmpty())
                                    @foreach($serviceWorks as $serviceWork)
                                        <option value="{{$serviceWork->code_1c}}">{{$serviceWork->product}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="help-block" data-empty="Required field"></div>
                        </div>
                    </div>

                    <div class="display-grid">
                        <div class="inputs-group one-column">
                            <div class="table-parts">
                                <div class="table-header">
                                    <div class="row">
                                        <div class="cell">
                                            <div class="form-group checkbox">
                                                <input type="checkbox" id="parts-nn" disabled>
                                                <label for="parts-nn"></label>
                                            </div>
                                        </div>
                                        <div class="cell">Назва робіт</div>
                                        <div class="cell">Ціна, грн</div>
                                        <div class="cell">Нормогодин</div>
                                        <div class="cell">Вартість, грн</div>
                                    </div>
                                </div>
                                <div class="table-body" id="serviceWorkTableBody">

                                </div>

                                <div class="table-footer">
                                    <div class="row">
                                        <div class="cell">Загальна вартість робіт</div>
                                        <div class="cell"></div>
                                        <div class="cell"></div>
                                        <div class="cell"></div>
                                        <div class="cell"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="display-grid col-2">
                                <div class="form-group">
                                    <label for="comment-2">Опис додаткових робіт</label>
                                    <textarea name="comment_service" id="comment-2" placeholder="Якщо виконувалися додаткові роботи, які не відображені в списку до вибору, опишіть їх в цьому полі" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content card-form used-parts">
                    <div class="card-title__wrapper">
                        <p class="card-title">Використані запчастини</p>
                        <div class="form-group have-icon">
                            <span class="icon icon-search-active"></span>
                            <input type="text" id="search_spareparts" placeholder="XXXXXX-XXX">
                        </div>
                    </div>

                    <div class="card-group">
                        <div class="table-parts">
                            <div class="table-header">
                                <div class="row">
                                    <div class="cell">Артикул</div>
                                    <div class="cell">Назва</div>
                                    <div class="cell">Ціна</div>
                                    <div class="cell">Кількість</div>
                                    <div class="cell">Знижка, %</div>
                                    <div class="cell">Всього, грн</div>
                                    <div class="cell">Замовити</div>
                                    <div class="cell">Дія</div>
                                </div>
                            </div>

                            <div class="table-body">
                                <div class="row title-only">
                                    <p>Результати пошуку</p>
                                </div>
                                <div class="" id="search-results">
                                    <div class="" style="margin-left: 25px">
                                        Введіть пошуковий запит...
                                    </div>
                                </div>

                                <div class="row title-only">
                                    <p>Додані запчастини</p>
                                </div>
                                <div class="" id="added-results">

                                </div>
                            </div>
                            <div class="table-footer">
                                <div class="row">
                                    <div class="cell">Підсумок</div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                </div>
                            </div>

                        </div>

                        <div class="table-parts only-footer">
                            <div class="table-footer">
                                <div class="row">
                                    <div class="cell">Загальна вартість по документу</div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                    <div class="cell"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-group">
                        <p class="sub-title">Для пошуку потрібних запчастин  перейдіть за посиланням</p>
                        <div class="display-grid col-2 gap-8">
                            <div class="card-content card-text">
                                <h2 class="text-underline text-blue">AL-KO</h2>

                                <p>Після відкриття, у лівому верхньому куті виберіть директорію: <span class="text-red fw-600">ERSATZTEILSUCHE.</span>
                                </p>
                                <p>
                                    Після переходу на іншу сторінку, в правому кутку в порожнє поле внесіть артикульний номер
                                    виробу, що Вас цікавить (артикульний номер виробу можна подивитися в прайс-листі або на
                                    заводській наклейці).
                                </p>
                                <p>
                                    Щоб дізнатися ціну на деталь, відкрийте каталог зап.частин (додаток №3 до договору з
                                    сервісного
                                    обслуговування). Комбінація Ctrl - F відкриває пошукове вікно, куди вноситься артикул
                                    зап.частини.
                                </p>
                                <p>
                                    За необхідності можна зберігати і друкувати деталі з інтернет бази. Для цього необхідно
                                    зліва
                                    внизу натиснути кнопку <span class="text-red fw-600">Drucken</span>, після чого вибрати
                                    потрібну вам сторінку.
                                </p>
                            </div>
                            <div class="card-content card-text">
                                <h2 class="text-underline text-blue">B&S</h2>

                                <p>
                                    Дотримуючись наведених інструкцій, знайдіть необхідну деталь для вашого продукту Briggs &
                                    Stratton
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="card-group _mb0">
                        <div class="display-grid col-2 gap-8">
                            <div class="form-group _mb0">
                                <label for="comment-3">Коментар</label>
                                <textarea id="comment-3" placeholder="Не знайшли потрібні запчастини? Опишіть вашу проблему" rows="3"></textarea>
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
