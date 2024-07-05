@extends('layouts.panel')
@section('content')
    <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('helpdesk-category.create') }}">YENİ
        ŞABLON
        YARAT</a>
    <table class="table permissionsTable">
        <thead>
            <tr>
                <th>Şablon adı</th>
                <th>Yaradılma tarixi</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at->format('d.m.Y H:i') }}</td>

                    <td style="display: flex">
                        <a class="text-warning" href="{{ route('helpdesk-category.edit', $category->id) }}">Düzəliş et</a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
    @if (count($categories) == 0)
        <p>Əlavə olunmuş şablon yoxdur.</p>
    @endif
@endsection
