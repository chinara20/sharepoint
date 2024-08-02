<style>
    .helodesk_container {
        display: flex !important;
        flex-direction: column;
    }
</style>
@if (Auth::user()->department_id === 7)
    <div class="helodesk_container">
        @if ((Auth::user()->id == 9 || Auth::user()->id == 140))
            @include('pages.helpdesk.it-department-user.additional-details')
        @endif

        <div>
            @if ((Auth::user()->id != 9 || Auth::user()->id != 140))
                <div class="info-heading">
                    <h5>
                        Gözləmədə olan sorğular
                    </h5>
                    <p>Sorğu sahibləri problemin həlli üçün IT əməkdaşlarının cavabını gözləyir.</p>
                </div>
            @endif

            <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary"
                href="{{ route('my_ongoing_desks') }}">ÜZƏRİMDƏ
                OLAN
                SORĞULAR</a>
            @if ((Auth::user()->id == 9 || Auth::user()->id == 140))
                <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary"
                    href="{{ route('helpdesk-category.index') }}">ŞABLONLAR</a>
                <a style="margin: 10px;margin-top: 40px;" class="btn btn-success"
                    href="{{ route('helpdesk_download', ['type' => 'xlsx', 'user_id' => request('user_id'), 'time_start' => request('time_start'), 'time_end' => request('time_end'), 'status' => request('status')]) }}">Excel</a>
            @endif

            <table class="table permissionsTable">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>AD \ SOYAD</th>
                        <th>STRUKTUR \ BÖLMƏ</th>
                        <th>SORĞU</th>
                        <th>BAŞLIQ</th>
                        <th>YARADILMA TARİXİ</th>
                        @if ((Auth::user()->id == 9 || Auth::user()->id == 140))
                            <th>BAĞLANMA TARİXİ</th>
                            <th>İCRAÇI</th>
                        @endif
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ? İt işçisi deski forward etdikdə status uğurlu lur yoxsa yönləndirdi --}}
                    {{-- ? İstifadəçi 5 gün sonra deski bərpa etsə ve daha sonra it işçisi əməliyat sonrası deski bağladıqda icra müddəti uzanır --}}
                    @foreach ($desks as $desk)
                        <tr>
                            <td>H-{{ str_pad($desk->id, 6, 0, STR_PAD_LEFT) }}</td>
                            <td>{{ $desk->user->name }}</td>
                            <td>
                                @if($desk->user->show_department)
                                    {{ $desk->user->show_department->name ? $desk->user->show_department->name : $desk->user->show_branch->name }}
                                @else
                                -
                                @endif
                            </td>

                            <td>{{ $desk->subject->name }}</td>
                            <td>{{ $desk->title }}</td>
                            <td>{{ $desk->created_at->format('m.d.Y H:i') }}</td>
                            @if ((Auth::user()->id == 9 || Auth::user()->id == 140))
                                <td>{{ $desk->responder && $desk->responder->finished_at ? \Carbon\Carbon::parse($desk->responder->finished_at)->format('m.d.Y H:i') : '-' }}
                                </td>
                                <td>{{ $desk->status == 'pending' ? '-' : $desk->responder->user->name }}</td>
                            @endif
                            <td>
                                <a class="btn btn-{{ $desk->get_status()['class'] }}">
                                    {!! $desk->get_status()['text'] !!}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('helpdesk.index') . '/' . $desk->id }}">Bax</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($desks) == 0)
                <p>Gözləmədə olan sorğu yoxdur.</p>
            @endif
        </div>
    </div>
@endif
