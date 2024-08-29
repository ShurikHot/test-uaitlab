<body class="preload">

<header data-lp>
    <!-- show-results, показать результати пошуку -->
    <div class="search-block show-results">
        <div class="search-block__result">
            <span class="icon icon-search"></span>
            <div class="placeholder">
                <div class="placeholder-item">
                    00000000000000000
                    <span class="icon-close-fill"></span>
                </div>
                <div class="placeholder-item">
                    00000000000000000
                    <span class="icon-close-fill"></span>
                </div>
            </div>
            <div class="clear-all icon-close-fill"></div>
            <div class="arrow"></div>
        </div>
        <form class="search-form">
            <div class="form-group horizontal">
                <label for="barcode">Штрихкод гарантійного талона</label>
                <div class="input-wrapper">
                    <input type="text" id="barcode" placeholder="Вкажіть Штрихкод">
                    <div class="help-block">Required field</div>
                    <button type="button" class="clear-input icon-close-fill"></button>
                </div>
            </div>
            <div class="form-group horizontal _mb0">
                <label for="number">Заводський номер гарантійного товару</label>
                <div class="input-wrapper">
                    <input type="text" id="number" placeholder="Вкажіть Заводський номер">
                    <div class="help-block">Required field</div>
                    <button type="button" class="clear-input icon-close-fill"></button>
                </div>
            </div>
            <div class="btns">
                <button class="btn-border btn-blue" type="button">Очистити</button>
                <button class="btn-primary btn-blue" type="button">Пошук</button>
            </div>
        </form>
    </div>
    <div class="user-header">
        <div class="user-info">
            <img src="{{asset('assets/front/img/components/user-undefined.svg')}}" alt="">
            <div class="user-name">{{auth()->user()->name}}</div>
            <div class="user-role">Роль</div>

            <button type="button" class="icon-arrow-dropdown"></button>
        </div>
        <div class="user-header__dropdown">
            <div class="user-header__dropdown-content">
                <div class="dropdown-top">
                    <div class="user-name">{{auth()->user()->name}}</div>
                    <div class="user-role">Роль</div>
                </div>
                <div class="dropdown-footer">
                    <a href="{{route('logout')}}" class="btn-primary btn-blue" type="button">Вийти</a>
                </div>
            </div>
        </div>
    </div>
</header>
