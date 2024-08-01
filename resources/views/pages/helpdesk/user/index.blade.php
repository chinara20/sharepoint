<div class="margin:0 40px;">
    <div class="info-heading">
        <h5>
            Sorğularım
        </h5>
        <p>Açmış olduğunuz bütün sorğuları bu səhifədən görə bilərsiniz.</p>
    </div>

    <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('helpdesk.create') }}">DƏSTƏK
        SORĞUSU
        YARAT</a>
    <table class="table permissionsTable">
        <thead>
            <tr>
                <th>№</th>
                <th>Sorğu</th>
                <th>Yaradılma tarixi</th>
                <th>BAĞLANMA TARİXİ</th>
                <th>İCRAÇI</th>
                <th>Status</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($desks as $desk)
                <tr>
                    <td>H-{{ str_pad($desk->id, 6, 0, STR_PAD_LEFT) }}</td>
                    <td>{{ $desk->title }}</td>
                    <td>{{ $desk->created_at->format('m.d.Y H:i') }}</td>
                    <td>{{ $desk->responder && $desk->responder->finished_at ? \Carbon\Carbon::parse($desk->responder->finished_at)->format('m.d.Y H:i') : '-' }}
                    </td>
                    <td>{{ $desk->status == 'pending' ? '-' : $desk->responder->user->name }}</td>
                    <td>
                        <a class="btn btn-{{ $desk->get_status()['class'] }}">
                            {!! $desk->get_status()['text'] !!}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('helpdesk.index') . '/' . $desk->id }}">Bax</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Sorğunuz yoxdur.</td>
                </tr>
            @endforelse
        </tbody>
    </table>



</div>
{{-- ! 73 --}}
