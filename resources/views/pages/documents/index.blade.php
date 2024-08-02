@extends('layouts.panel')
@section('content')
<style>
    .list-item:hover{
        background-color:#fef9c3;
        cursor:pointer;
        text-decoration:underline;
    }
    .list-item a{
        color:#000;
    }
</style>
    <div>
        <div class="info-heading">
            <h5>
                Sənədlər
            </h5>
            <p>Bu səhifədə yer alan sənədləri yükləyə bilərsiniz.</p>
        </div>
        <br />
        <table class="table permissionsTable">
            <thead>
                <tr>
                    <th>Faylın adı</th>
                    <th>Növü</th>
                    <th>Əlavə olunma tarixi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                <tr class="list-item">
                    <td class="">
                        <a download target="_blank" href="{{$document->src}}">
                            @if($document->type == 'PDF')
                                <img src="/pdf.png" alt="">
                            @elseif($document->type == 'DOCX')
                                <img src="/pdf.png" alt="">
                            @elseif($document->type == 'XLSX')
                                <img src="/xls.png" alt="">
                            @endif
                            {{$document->name}}
                        </a>
                    </td>
                    <td>
                        <a download target="_blank" href="{{$document->src}}">
                            {{$document->type}}
                        </a>
                    </td>
                    <td>
                        <a download target="_blank" href="{{$document->src}}">
                            {{$document->created_at}}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
