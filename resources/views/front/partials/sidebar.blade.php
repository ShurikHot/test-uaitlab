<aside class="sidebar">
    <button class="btn-size-holder"></button>
    <div class="sidebar-content custom-scrollbar">
        <a href="#" class="logo">
            <img src="{{asset('assets/front/img/components/logo.svg')}}" alt="">
        </a>
        <div class="lists">

            <div class="list-group">
                <p class="list-group__title">Журнали</p>
                <ul>
                    <li class="@if(request()->routeIs('warranty.*')) active @endif ">
                        <a href="{{route('warranty.index')}}" class="link">
                            <span class="icon icon-docs-in-folders"></span>
                            <span class="text">Гарантійні заяви</span>
                        </a>
                    </li>
                    <li class="@if(request()->routeIs('ate.*')) active @endif ">
                        <a href="{{route('ate.index')}}" class="link">
                            <span class="icon icon-docs"></span>
                            <span class="text">Акти технічної експертизи</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <p>AL-KO Copyright © 2023 </p>
        </div>
    </div>
    <div class="smaller-version custom-scrollbar">
        <a href="#" class="logo">
            <img src="{{asset('assets/front/img/components/logo.svg')}}" alt="">
        </a>
        <div class="lists">
            <div class="list-group">
                <ul>
                    <li class="@if(request()->routeIs('warranty.index')) active @endif ">
                        <a href="{{route('warranty.index')}}" class="link js-tooltip"
                           data-text="Гарантійні заяви"
                           data-offset="0,16"
                           data-placement="right"
                        >
                            <span class="icon icon-docs-in-folders"></span>
                        </a>
                    </li>
                    <li class="@if(request()->routeIs('ate.index')) active @endif ">
                        <a href="{{route('ate.index')}}" class="link js-tooltip"

                           data-text="Акти технічної експертизи"
                           data-offset="0,16"
                           data-placement="right"
                        >
                            <span class="icon icon-docs"></span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</aside>
