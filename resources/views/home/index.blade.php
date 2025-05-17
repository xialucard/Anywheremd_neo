@extends('layouts.app')
@section('content')
@php
    $bgColor = 'dark';
    if(!empty(Auth::user()->user_type)){
        if(Auth::user()->user_type == 'Doctor')
            $bgColor = 'warning';
        if(Auth::user()->user_type == 'Clinic')
            $bgColor = 'primary';
    }
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{-- {{ __('You are logged in!') }} --}}
                    @php
                        $yr = date('Y');
                        $mon = date('m');
                        // $mon = "05";
                        $dayArr[] = 'Sun';
                        $dayArr[] = 'Mon';
                        $dayArr[] = 'Tue';
                        $dayArr[] = 'Wed';
                        $dayArr[] = 'Thu';
                        $dayArr[] = 'Fri';
                        $dayArr[] = 'Sat';
                    @endphp
                    
                    <div class="card-body table-responsive">
                        <h3>{{ __(date('F Y', strtotime($yr . '-' . $mon . '-1'))) }}</h3>
                        <table class="table table-bordered table-striped-columns table-sm">
                            @php
                                $bgColor = 'dark';
                                if(!empty(Auth::user()->user_type)){
                                    if(Auth::user()->user_type == 'Doctor')
                                        $bgColor = 'warning';
                                    if(Auth::user()->user_type == 'Clinic')
                                        $bgColor = 'primary';
                                }
                            @endphp
                            <thead class="table-{{ $bgColor }}">
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $weekCnt = 0;
                            @endphp
                            @for($i=1; $i<=date('t', strtotime($yr . '-' . $mon . '-1')); $i++)
                                @if($i == 1)
                                <tr>
                                    @foreach($dayArr as $day)
                                        @php
                                            $weekCnt++;
                                        @endphp
                                        @if($day != date('D', strtotime($yr . '-' . $mon . '-' . $i)))
                                    <td>&nbsp;</td>
                                        @else
                                    <td>
                                        @if($i >= date('d'))
                                            @if (Route::has($viewFolder . '.show'))
                                                @can($viewFolder . '.show')
                                                <a href="#" class="link-{{ $bgColor }} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                @endcan
                                                    <div>
                                                        <div>{{ $i }}</div>
                                                        <div>&nbsp;</div>
                                                    </div>
                                                @can($viewFolder . '.show')
                                                </a>
                                                @endcan
                                            @endif
                                        @else
                                        <div>
                                            <div>{{ $i }}</div>
                                            <div>&nbsp;</div>
                                        </div>
                                        @endif
                                    </td>
                                            @if(($weekCnt%7) == 0)
                                </tr>           
                                            @endif
                                            @php
                                                break;
                                            @endphp
                                        @endif
                                        
                                    @endforeach
                                @else
                                    <td>
                                        @if($i >= date('d'))
                                            @if (Route::has($viewFolder . '.show'))
                                                @can($viewFolder . '.show')
                                                <a href="#" class="link-{{ $bgColor }} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                    <div>
                                                        <div>{{ $i }}</div>
                                                        <div>&nbsp;</div>
                                                    </div>
                                                </a>
                                                @endcan
                                            @endif
                                        @else
                                        <div>
                                            <div>{{ $i }}</div>
                                            <div>&nbsp;</div>
                                        </div>
                                        @endif
                                    </td>
                                    @if($i == date('t', strtotime($yr . '-' . $mon . '-1')) || ($weekCnt%7) == 0)
                                        @for($ii = $weekCnt; ($ii%7) <> 0; $ii++)
                                    <td>&nbsp;</td>
                                            
                                        @endfor
                                </tr>
                                    @endif
                                @endif
                                @php
                                    $weekCnt++;
                                @endphp
                            @endfor
                                {{-- <tr>
                                    <td>1<p>test</p></td>
                                    <td>2<p></p></td>
                                    <td>3<p></p></td>
                                    <td>4<p></p></td>
                                    <td>5<p></p></td>
                                    <td>6<p></p></td>
                                    <td>7<p></p></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
