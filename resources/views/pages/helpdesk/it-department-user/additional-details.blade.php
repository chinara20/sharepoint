<div class="helpdesk_stats">
    <div class="rows">
        <div class="card">
            <span>
                @if (request('time_start') && request('time_end'))
                    {{ \Carbon\Carbon::parse(request('time_start'))->format('m.d.Y') }}
                    -
                    {{ \Carbon\Carbon::parse(request('time_end'))->format('m.d.Y') }}
                @elseif (!request('time_start') && request('time_end'))
                    <i class="fa-solid fa-infinity"></i>
                    -
                    {{ \Carbon\Carbon::parse(request('time_end'))->format('m.d.Y') }}
                @elseif (request('time_start') && !request('time_end'))
                    {{ \Carbon\Carbon::parse(request('time_start'))->format('m.d.Y') }}
                    -
                    <i class="fa-solid fa-infinity"></i>
                @else
                    Gözləmədə olan sorğular
                @endif

            </span>
            <p>Sorğular gözləmədədir baxılması üçün gözlənilir.</p>
            <span>{{ $monthly_pending_desks }}</span>
        </div>
        <div class="card">
            <span>
                @if (request('time_start') && request('time_end'))
                    {{ \Carbon\Carbon::parse(request('time_start'))->format('m.d.Y') }}
                    -
                    {{ \Carbon\Carbon::parse(request('time_end'))->format('m.d.Y') }}
                @elseif (!request('time_start') && request('time_end'))
                    <i class="fa-solid fa-infinity"></i>
                    -
                    {{ \Carbon\Carbon::parse(request('time_end'))->format('m.d.Y') }}
                @elseif (request('time_start') && !request('time_end'))
                    {{ \Carbon\Carbon::parse(request('time_start'))->format('m.d.Y') }}
                    -
                    <i class="fa-solid fa-infinity"></i>
                @else
                    Bütün aralıq üzrə uğurlu
                @endif
            </span>
            <p>Bu sorğular uğurla tamamlanmış, həll olunmuşdur.</p>
            {{-- <span>{{ $desks->where('updated_at', [Carbon\Carbon::now()->startOfMonth(), Carbon\Carbon::now()->endOfMonth()]) }}</span> --}}
            <span>{{ $monthly_success_desks }}</span>
        </div>
        <div class="card">
            <span>
                @if (request('time_start') && request('time_end'))
                    {{ \Carbon\Carbon::parse(request('time_start'))->format('m.d.Y') }}
                    -
                    {{ \Carbon\Carbon::parse(request('time_end'))->format('m.d.Y') }}
                @elseif (!request('time_start') && request('time_end'))
                    <i class="fa-solid fa-infinity"></i>
                    -
                    {{ \Carbon\Carbon::parse(request('time_end'))->format('m.d.Y') }}
                @elseif (request('time_start') && !request('time_end'))
                    {{ \Carbon\Carbon::parse(request('time_start'))->format('m.d.Y') }}
                    -
                    <i class="fa-solid fa-infinity"></i>
                @else
                    Bütün aralıq üzrə uğursuz
                @endif
            </span>
            <p>Sorğular həll olunmamışdır.</p>
            <span>{{ $monthly_unsuccess_desks }}</span>
        </div>
    </div>
</div>
<br>
<form action="" class="permissions_filter">
    <div class="form-group">
        <label style="display: block;" for="exampleInputPassword1">İşçi</label>

        <select id='myselect' name="user_id">
            <option value=" " selected>Hamısı</option>
            @foreach ($users as $user)
                <option value="{{ $user->user->id }}" @if (request('user_id') == $user->user->id) selected @endif>
                    {{ $user->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label style="display: block;" for="exampleInputPassword1">Status</label>
        <select class="js-example-templating" name="status">
            <option value=" " selected>Hamısı</option>
            <option value="pending" @if (request('status') == 'pending') selected @endif>Gözləmədə olan
            </option>
            <option value="forwarded" @if (request('status') == 'forwarded') selected @endif>Yönləndirilmiş
            </option>
            <option value="activ" @if (request('status') == 'activ') selected @endif>Aktiv</option>
            <option value="success" @if (request('status') == 'success') selected @endif>Uğurlu</option>
            <option value="unsuccess" @if (request('status') == 'unsuccess') selected @endif>Uğursuz</option>
        </select>
    </div>
    <script>
        $('#myselect').select2({
            width: '101%',
            height: '35px',
            placeholder: "Siyahıdan seçin",
            allowClear: true
        });

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "/user/pages/images/flags";
            var $state = $(
                '<span class="custom-option"><span class="option-circle ' + state.element.value + '"></span>' + state
                .text + '</span>'
            );
            return $state;
        };

        $(".js-example-templating").select2({
            templateResult: formatState,
            width: '101%',
            height: '35px',
            placeholder: "Siyahıdan seçin",
            allowClear: true
        });
    </script>

    <div class="form-group">
        <label style="display: block;" for="exampleInputPassword1">Sorğu tarix aralığı</label>
        <input type="date" name="time_start" id="start_date" class="form-control" id="exampleInputPassword1"
            value="{{ request('time_start') }}">
    </div>

    <div class="form-group">
        <label style="display: block;" for="exampleInputPassword1"> </label>
        <input type="date" name="time_end" id="start_date" class="form-control" id="exampleInputPassword1"
            value="{{ request('time_end') }}">
    </div>

    <div class="form-groups">
        <label style="display: block;" for="exampleInputPassword1"> </label>
        <button type="submit" class="btn btn-primary">Axtar</button>
    </div>

</form>
