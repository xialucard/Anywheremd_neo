@extends('layouts.app')
@section('content')
<datalist id="roleList">
    @foreach ($selectItems['roles'] as $ind => $item)
    <option value="{{ $item->name }}">{{ $item->name }}</option>
    @endforeach
</datalist>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{ __(ucwords(str_replace("_", " ", $viewFolder)) . ' List') }}</h2>
            <div class="card">
                <div class="card-header">
                    @include('elements.moduleOptions')
                </div>
                <div class="card-body table-responsive">
                    <div class="d-flex justify-content-end">
                        {{ $data->withQueryString()->links() }}
                    </div>
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th class="w-25"><i class="bi bi-gear"></i></th>
                                <th>@sortablelink('id')</th>
                                <th class="w-50">@sortablelink('name')</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dat)
                            <tr>
                                <td>@include($viewFolder . '.tableOptions')</td>
                                <td>{{ $dat->id }}</td>
                                <td>{{ $dat->name }}</td>
                                <td>{{ $dat->roles[0]->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $data->withQueryString()->links() }}
                    </div>
                </div>
                <div class="card-footer">
                    @include('elements.moduleOptions')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
