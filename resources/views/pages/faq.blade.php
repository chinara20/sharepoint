@extends('layouts.panel')
@section('content')
    <div class="row">
        <!-- -------------- FAQ Left Column -------------- -->
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body pn mtn">
                    <div class="br-b">
                        <h2 class="mb20 mt10">Tez-tez verilən suallar</h2>
                        <!-- <div class="input-group mb30">
                                                                                                              <span class="input-group-addon">
                                                                                                              <i class="fa fa-search"></i>
                                                                                                              </span>
                                                                                                              <input type="text" id="icon-filter" class="form-control" placeholder="Faq da axtar...">
                                                                                                           </div> -->
                    </div>
                    <div class="mt20">
                        <!-- <h5 class="text-muted mb20 mtn"> Əsas </h5> -->
                        <div class="panel-group accordion" id="accordion1">
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
                                        Call Centerin əlaqə nömrəsi neçədir ?
                                    </a>
                                </div>
                                <div id="accordion1_1" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">*2700
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">
                                        Giriş kartımı itirdikdə nə etməliyəm? </a>
                                </div>
                                <div id="accordion1_2" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">İnsan Resursları departamentinə məlumat verilməli və sizin üçün
                                        yeni kart sifariş olunmalıdır.
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">
                                        Ay ərzində neçə saat icazə ala bilərəm ?</a>
                                </div>
                                <div id="accordion1_3" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">Ay ərzində saatlıq icazənin limiti 4 saatdır.</div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">
                                        Məzuniyyətə çıxmaq üçün nə etməliyəm ?</a>
                                </div>
                                <div id="accordion1_4" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        Məzuniyyətə çıxmaq üçün ərizə yazılmalıdır. Məzuniyyət ərizəsi azı beş gün qalmış
                                        İnsan Resursları Departamentinə təqdim olunmalıdır.
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">
                                        Məzuniyyətin növləri hansılardı ?</a>
                                </div>
                                <div id="accordion1_5" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <ul style="list-style-type: decimal;">
                                            <li>Əsas və əlavə məzuniyyətlərdən ibarət olan əmək məzuniyyəti.</li>
                                            <li>Sosial məzuniyyət.</li>
                                            <li>Təhsilini davam etdirmək və elmi yaradıcılıqla məşğul olmaq üçün verilən
                                                təhsil və yaradıcılıq məzuniyyəti.</li>
                                            <li>Ödənişsiz məzuniyyət.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">
                                        Əmək məzuniyyətindən istifadə etmək hüququ nə vaxt əmələ gəlir ?</a>
                                </div>
                                <div id="accordion1_6" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        İşçinin birinci iş ili üçün əmək məzuniyyətindən istifadə etmək hüququ əmək
                                        müqaviləsinin bağlandığı andan etibarən 6 ay işlədikdən sonra əmələ gəlir.
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7">
                                        İşdən çıxmaq üçün ərizəni nə vaxt təqdim etməliyəm ?</a>
                                </div>
                                <div id="accordion1_7" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        İşdən azad olunma ərizələri işçi tərəfindən 1 ay öncədən İnsan Resursları
                                        Departamentinə təqdim olunmalıdır. </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <a class="accordion-toggle accordion-icon link-unstyled collapsed"
                                        data-toggle="collapse" data-parent="#accordion1" href="#accordion1_8">
                                        Əmək qabiliyyətini müvəqqəti itirərkən nə etməliyəm?</a>
                                </div>
                                <div id="accordion1_8" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        İşçi əmək qabiliyyətini müvəqqəti itirərkən xəstəlik vərəqəni(əmək qabiliyyətini
                                        itirmək vərəqəsi) İnsan Resursları Departamentinə təqdim etməlidir.
                                        <br>
                                        Qeyd: Əmək qabiliyyətinin müvəqqəti itirilməsinə görə müavinət almaq hüququ
                                        <strong>ən azı 6
                                            ay</strong> sosial sığorta stajı olan şəxslərə şamil edilir.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
