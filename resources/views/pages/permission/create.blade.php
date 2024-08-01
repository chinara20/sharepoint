@extends('layouts.panel')
@section('content')
    <style type="text/css">
        input[type="date"],
        input[type="time"],
        input[type="datetime-local"],
        input[type="month"] {
            line-height: 1.49;
        }

        .hide {
            display: none;
        }
    </style>

    <div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">
                    İcazə Sorğusu
                </span>
            </div>
            <br>
            <form action="{{ route('permission.store') }}" method="POST">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label style="display: block;" for="exampleInputPassword1">İcazənin başlama Tarixi</label>
                    <div style="display:flex; gap:8px;">
                        <select id="subject" name="month" class="form-control" required>
                            <option value="" hidden>Ay seçin</option>
                            @foreach($remainingMonths as $month)
                                <option value="{{$month['value']}}">{{ $month['label'] }}</option>
                            @endforeach
                        </select>
                        <select id="subject" name="day" class="form-control" required>
                            <option value="" hidden>Gün seçin</option>
                            @for ($i = 1; $i <= $currentMonthDayCount; $i++)
                                <option value="{{$i}}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <!-- <input style="display: inline-block;width: 80%" required="" type="date" name="time_start"
                        id="start_date" class="form-control" id="exampleInputPassword1">

                    <input placeholder="--:--" data-slots="-" required pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$"
                        style="display: inline-block;width: 18%" class="form-control" name="time_start_hours"> -->
                </div>
                <div class="form-group">
                    <label style="display: block;" for="exampleInputPassword1">İcazənin saat aralığı. Başlama / Bitmə saatı</label>
                    <!-- <input required="" style="display: inline-block;width: 80%" type="date" name="time_end"
                        id="start_date" class="form-control" id="exampleInputPassword1"> -->
                    <div style="display:flex; gap:8px;">
                        <input placeholder="--:--" data-slots="-" required pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$"
                         class="form-control" name="time_start_hours">
                        <input placeholder="--:--" data-slots="-" required pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$"
                         class="form-control" name="time_end_hours">
                    </div>

                    {{-- <input required="" style="display: inline-block;width: 18%" type="time" min="00:00"
                        max="23:59"class="form-control" name="time_end_hours"> --}}
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Növ</label>
                    <select name="type" class="form-control">
                        <option value="1">Ödənişli</option>
                        <option value="2">Ödənişsiz</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">İcazə Səbəbi</label>
                    {{-- permission_type --}}
                    <select id="subject" name="subject" class="form-control">
                        <option value="Səhhətimlə Əlaqədar">Səhhətimlə Əlaqədar</option>
                        <option value="Ailəvi Problemlər">Ailəvi Problemlər</option>
                        <option value="Şəxsi">Şəxsi</option>
                        <option value="Digər">Digər</option>
                    </select>
                    <br>
                    <textarea class="form-control" style="display: none" maxlength="500" minlength="5" name="description" id="description"
                        cols="30" rows="3" placeholder="Səbəbi daxil edin"></textarea>
                </div>

                <script>
                    let e = document.getElementById("subject");
                    let textarea = document.getElementById("description");
                    e.addEventListener('change', function(params) {
                        let value = e.value;
                        let text = e.options[e.selectedIndex].text;
                        if (text == 'Digər') {
                            textarea.style.display = 'block';
                            textarea.required = true;
                        } else {
                            textarea.style.display = 'none';
                            textarea.required = false;
                        }
                        console.log(text);
                    })
                </script>

                <div id="customInput" class="form-group hide">
                    <label for="exampleInputPassword1">Səbəbi qeyd edin</label>
                    <input type="text" name="subject_more" class="form-control" id="exampleInputPassword1">
                </div>

                <div style="display:flex; align-items: center; justify-content: space-between">
                    <button type="submit" class="btn btn-primary">Göndər</button>
                    <span>
                        Cari ay üçün icazə limitiniz : <strong>{{ $currentMonthLimit }}</strong>
                    </span>
                </div>
            </form>

            <!-- -------------- /Panel Heading -------------- -->

        </div>

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <!-- -------------- /Panel -------------- -->
    </div>

    <script>
        // Input mask
        document.addEventListener('DOMContentLoaded', () => {
            for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
                const pattern = el.getAttribute("placeholder"),
                    slots = new Set(el.dataset.slots || "_"),
                    prev = (j => Array.from(pattern, (c, i) => slots.has(c) ? j = i + 1 : j))(0),
                    first = [...pattern].findIndex(c => slots.has(c)),
                    accept = new RegExp(el.dataset.accept || "\\d", "g"),
                    clean = input => {
                        input = input.match(accept) || [];
                        return Array.from(pattern, c =>
                            input[0] === c || slots.has(c) ? input.shift() || c : c
                        );
                    },
                    format = () => {
                        const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                            i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                            return i < 0 ? prev[prev.length - 1] : back ? prev[i - 1] || first : i;
                        });
                        el.value = clean(el.value).join``;
                        el.setSelectionRange(i, j);
                        back = false;
                    };
                let back = false;
                el.addEventListener("keydown", (e) => back = e.key === "Backspace");
                el.addEventListener("input", format);
                el.addEventListener("focus", format);
                el.addEventListener("blur", () => el.value === pattern && (el.value = ""));
            }
        });

        // Usage
        /*  <label>Saat
                   <input placeholder="--:--" data-slots="-" required pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$">
               </label><br>
               <label>Telephone:
                   <input placeholder="+1 (___) ___-____" data-slots="_">
               </label><br>
               <label>MAC Address:
                   <input placeholder="XX:XX:XX:XX:XX:XX" data-slots="X" data-accept="[\dA-H]">
               </label><br>
               <label>Alphanumeric:
                   <input placeholder="__-__-__-____" data-slots="_" data-accept="\w" size="13">
               </label><br>
               <label>Credit Card:
                   <input placeholder=".... .... .... ...." data-slots="." data-accept="\d" size="19">
               </label><br> */
    </script>

    <script type="text/javascript">
        var permission_type = document.getElementById('permission_type');
        var customInput = document.getElementById('customInput');

        permission_type.addEventListener('change', function() {
            if (this.value == "3") {
                customInput.classList.remove('hide');
            } else {
                customInput.classList.add('hide');
            }
        })

        function checkDate() {
            var dateString = document.getElementById('start_date').value;
            var dateString2 = document.getElementById('end_date').value;
            var DateStart = new Date(dateString);
            var DateEnd = new Date(dateString2);
            if (DateEnd < DateStart) {
                document.getElementById('start_date').value = '1';
                document.getElementById('end_date').value = '1';
                alert("Səhv tarix seçmisiniz.");
                return false;
            }
            return true;
        }
    </script>
@endsection
