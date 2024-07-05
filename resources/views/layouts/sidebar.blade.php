@php
    $pages = \App\Models\Page::all()->reverse();
    
    if (Auth::user()->department_id == 7) {
        $desk_count = \App\Models\Helpdesk::where('status', 'pending')->count();
    }
    
@endphp
<ul class="nav sidebar-menu">
    <li style="color: white;" class="sidebar-label pt30">Menyu</li>
    <li>
        <a href="{{ route('index_page') }}">
            <span class="fa fa-home"></span>
            <span class="sidebar-title">Ana Səhifə</span>
        </a>
    </li>
    <li>
        <a class="accordion-toggle" href="#">
            <span class="fa fa-info"></span>
            <span class="sidebar-title">NBA</span>
            <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
            @foreach ($pages->reverse() as $page)
                <li>
                    <a style="color: white;" href="{{ route('page.show', $page->id) }}#{{ $page->title }}">
                        <span class="glyphicon glyphicon-tags"></span> {{ $page->title }} </a>
                </li>
            @endforeach
            <!-- <li>
            <a style="color: white;" href="/all_structure">
            <span class="glyphicon glyphicon-tags"></span> Struktur </a>
         </li> -->
        </ul>
    </li>

    <li>
        <a class="accordion-toggle" href="#">
            <span class="fa fa-users"></span>
            <span class="sidebar-title">Struktur</span>
            <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
            <li>
                    <a style="color: white;" href="/all_structure">
                        <span class="glyphicon glyphicon-tags"></span>Əməkdaşlar</a>
                </li>
            <li>

                <a target="_blank" style="color: white;" href="/Struktur-10.05.2024.pdf">
                        <span class="glyphicon glyphicon-tags"></span>Struktur (PDF)</a>
                </li>
        </ul>
    </li>

    <li>
        <a href="/document-files">
            <span class="fa fa-file-pdf"></span>
            <span class="sidebar-title">Sənədlər</span>
        </a>
    </li>

    <li>
        <a href="{{ route('appeals.index') }}">
            <span class="fa fa-question"></span>
            <span class="sidebar-title">Direktora Müraciət</span>
        </a>
    </li>


    <li>
        <a href="{{ route('gallery.index') }}">
            <span class="fa fa-picture-o"></span>
            <span class="sidebar-title">Qalereya</span>
        </a>
    </li>
    <!-- <li>
        <a href="{{ route('page.index') }}">
            <span class="fa fa-tasks"></span>
            <span class="sidebar-title">Səhifə</span>
        </a>
   </li> -->
    <li>
        <a href="{{ route('faq') }}">
            <span class="fa fa-question"></span>
            <span class="sidebar-title">Faq</span>
        </a>
    </li>

    <li>
        <a class="accordion-toggle" href="#">
            <span class="fa-solid fa-desktop"></span>
            <span class="sidebar-title">
                <div style="display:inline-Flex; align-items:center;column-gap:4px;">
                    <span>Helpdesk</span>
                    @if (Auth::user()->department_id == 7 && $desk_count != 0)
                        <span
                            style="border-radius: 50%; width:20px;height:20px;background-color: red; display:flex;justify-content: center;align-items: center;">
                            {{ $desk_count }}
                        </span>
                    @endif
                </div>
            </span>
            <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
            @if (Auth::user()->department_id == 7)
                <li><a style="color: white;" href="{{ route('helpdesk.index') }}">Gözləmədə olan sorğular</a></li>
                <li><a style="color: white;" href="{{ route('my_ongoing_desks') }}">Üzərimdə olan sorğular</a></li>
                @if (Auth::user()->id == 9)
                    <li><a style="color: white;" href="{{ route('helpdesk-category.index') }}">Şablonlar</a></li>
                    <li><a style="color: white;" href="{{ route('helpdesk-category.create') }}">Şablon əlavə et</a>
                    </li>
                @endif
            @else
                <li><a style="color: white;" href="{{ route('helpdesk.index') }}">Sorğularım</a></li>
                <li><a style="color: white;" href="{{ route('helpdesk.create') }}">Sorğu yarat</a></li>
            @endif
        </ul>
    </li>

    <li>
        <a href="{{ route('vacansy.index') }}">
            <span class="fa fa-briefcase"></span>
            <span class="sidebar-title">Vakansiya</span>
        </a>
    </li>
    <!-- <li>
        <a href="{{ route('index_page') }}">
            <span class="fa fa-newspaper-o"></span>
            <span class="sidebar-title">Xəbərlər</span>
        </a>
   </li> -->


    <li>
        <a href="{{ route('permission.index') }}">
            <span class="fa fa-th-large"></span>
            <span class="sidebar-title">İcazə</span>
        </a>
    </li>
    <li>
        <a href="{{ route('all_category') }}">
            <span class="fa fa-list-alt"></span>
            <span class="sidebar-title">Məhsullar</span>
        </a>
    </li>
    @if (Auth::user()->email == 'nail.c@nbatech.az' ||
            Auth::user()->email == 'farid.k@nbatech.az' ||
            Auth::user()->email == 'nicat.b@nbatech.az')
        <li>
            <a class="accordion-toggle" href="#">
                <span class="fa fa-list-alt"></span>
                <span class="sidebar-title">Marketinq</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a style="color: white;" href="{{ route('product_category.index') }}">
                        <span class="glyphicon glyphicon-tags"></span> Kateqoriyalar </a>
                </li>
                <li>
                    <a style="color: white;" href="{{ route('product.index') }}">
                        <span class="glyphicon glyphicon-tags"></span> Məhsullar </a>
                </li>
                <li>
                    <a style="color: white;" href="{{ route('gallery.create') }}">
                        <span class="glyphicon glyphicon-tags"></span> Qalareya Əlavə Et </a>
                </li>
                <li>
                    <a style="color: white;" href="{{ route('gallery_category.create') }}">
                        <span class="glyphicon glyphicon-tags"></span> Qalareya Kateqoriyası Əlavə Et </a>
                </li>

            </ul>
        </li>
    @endif

    <li>
        <a href="{{ route('talant.create') }}">
            <span class="fa fa-building-o"></span>
            <span class="sidebar-title">Talant</span>
        </a>
    </li>

    <!-- -------------- Sidebar Progress Bars -------------- -->

</ul>
