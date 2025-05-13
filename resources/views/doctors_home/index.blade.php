@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                      
                    @php
                        if(!isset($yr))
                            $yr = date('Y');
                        if(!isset($mon))
                            $mon = date('n');
                        if(!isset($dayNum) && date('n') == $mon && date('Y') == $yr){
                            $dayNum = date('d');
                        }elseif(!isset($dayNum)){
                            $dayNum = 1;
                        }
                        
                        $dayArr[] = 'Sun';
                        $dayArr[] = 'Mon';
                        $dayArr[] = 'Tue';
                        $dayArr[] = 'Wed';
                        $dayArr[] = 'Thu';
                        $dayArr[] = 'Fri';
                        $dayArr[] = 'Sat';
                    @endphp
                    
                                <div class="table-responsive">
                                    @php
                                        $bgColor = 'dark';
                                        if(!empty(Auth::user()->user_type)){
                                            if(Auth::user()->user_type == 'Doctor')
                                                $bgColor = 'warning';
                                            if(Auth::user()->user_type == 'Clinic')
                                                $bgColor = 'primary';
                                        }
                                    @endphp
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="doctor_home_mon" aria-label="Month" onchange="
                                                window.location.href = '{{ route($viewFolder . '.index') }}/' + $('#doctor_home_yr').val() + '/' + $(this).val();
                                            ">
                                            <option value="1" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 1 ? 'selected' : '' }}>January</option>
                                            <option value="2" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 2 ? 'selected' : '' }}>February</option>
                                            <option value="3" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 3 ? 'selected' : '' }}>March</option>
                                            <option value="4" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 4 ? 'selected' : '' }}>April</option>
                                            <option value="5" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 5 ? 'selected' : '' }}>May</option>
                                            <option value="6" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 6 ? 'selected' : '' }}>June</option>
                                            <option value="7" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 7 ? 'selected' : '' }}>July</option>
                                            <option value="8" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 8 ? 'selected' : '' }}>August</option>
                                            <option value="9" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 9 ? 'selected' : '' }}>September</option>
                                            <option value="10" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 10 ? 'selected' : '' }}>October</option>
                                            <option value="11" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 11 ? 'selected' : '' }}>November</option>
                                            <option value="12" {{ date('m', strtotime($yr . '-' . $mon . '-1')) == 12 ? 'selected' : '' }}>December</option>
                                        </select>
                                        <span class="input-group-text">-</span>
                                        <input type="text" class="form-control" id="doctor_home_yr" placeholder="Year" aria-label="Year" value = {{ $yr }} onblur="
                                            window.location.href = '{{ route($viewFolder . '.index') }}/' + $(this).val() + '/' + $('#doctor_home_mon').val();
                                        ">
                                        @can($viewFolder . '.manageSchedule')
                                        <span class="input-group-text"><a class="btn btn-sm" href="{{ route($viewFolder . '.manageSchedule') }}" title="Manage Schedule" role="button"><i class="bi bi-gear"></i></a></span>
                                        @endcan
                                        @can($viewFolder . '.manageClinic')
                                        <span class="input-group-text"><a class="btn btn-sm" href="{{ route($viewFolder . '.manageClinic') }}" title="Manage Clinic" role="button"><i class="bi bi-hospital"></i></a></span>
                                        @endcan
                                    </div>
                                    <table class="table table-bordered table-striped-columns table-sm">
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
                                            @php
                                                $border = '';
                                                $textColor = '';
                                                $i = str_pad($i, 2, 0, STR_PAD_LEFT);
                                                $dayNum = str_pad($dayNum, 2, 0, STR_PAD_LEFT);
                                                if(($yr . '-' . $mon . '-'. $i == date('Y-n-d'))){
                                                    $textColor = 'text-danger';
                                                    $border = 'border border-danger border-3';
                                                }
                                                if(($yr . '-' . $mon . '-'. $i == $yr . '-' . $mon . '-'. $dayNum) && strtotime($yr . '-' . $mon . '-' . $i))
                                                    $border = 'border border-' . $bgColor . ' border-3';
                                            @endphp
                                            @if($i == 1)
                                            <tr>
                                                @foreach($dayArr as $day)
                                                    @php
                                                        $weekCnt++;
                                                    @endphp
                                                    @if($day != date('D', strtotime($yr . '-' . $mon . '-' . $i)))
                                                <td>&nbsp;</td>
                                                    @else
                                                <td class="{{ $border }} {{ $textColor }}">
                                                    @if(strtotime($yr . '-' . $mon . '-' . $i) >= strtotime('-3 days'))
                                                        @can($viewFolder . '.index')
                                                            @if(!empty($user->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0]))
                                                        <a href="{{ route($viewFolder . '.index') . '/' . $yr . '/' . $mon . '/' . $i }}" class="link-{{ $bgColor }} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                            @endif
                                                        @endcan
                                                            <div>
                                                                <div>{{ $i }}</div>
                                                                <div><i class="bi bi-list-ol"></i></div>
                                                            </div>
                                                        @can($viewFolder . '.index')
                                                            @if(!empty($user->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0]))
                                                        </a>
                                                            @endif
                                                        @endcan
                                                        
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
                                                <td class="{{ $border }} {{ $textColor }}">
                                                    @if(strtotime($yr . '-' . $mon . '-' . $i) >= strtotime('-3 days'))
                                                        @can($viewFolder . '.index')
                                                            @if(!empty($user->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0]))
                                                        <a href="{{ route($viewFolder . '.index') . '/' . $yr . '/' . $mon . '/' . $i }}" class="link-{{ $bgColor }} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                            @endif
                                                        @endcan
                                                            <div>
                                                                <div>{{ $i }}</div>
                                                                <div>
                                                                    @if(!empty($user->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $i)->get()[0]))
                                                                    <i class="bi bi-list-ol"></i> {{ sizeof($user->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $i)->get()) }}
                                                                    @else
                                                                    &nbsp;
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @can($viewFolder . '.index')
                                                            @if(!empty($user->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0]))
                                                        </a>
                                                            @endif
                                                        @endcan
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <h3>Booking List</h3>
                                @if(isset($booking_type_arr))
                                <ul class="nav nav-tabs">
                                    @foreach($booking_type_arr as $booking)
                                        @php
                                            
                                            $li_active = "";
                                            
                                            if(in_array($booking_type, $booking_type_arr) && $booking == $booking_type)
                                                $li_active = "active";
                                            elseif(!in_array($booking_type, $booking_type_arr) && $in == 0)
                                                $li_active = "active";
                                        @endphp
                                    <li class="nav-item">
                                        <a class="nav-link {{ $li_active }}" aria-current="page" href="{{ route($viewFolder . '.index') . '/' . $yr . '/' . $mon . '/' . $dayNum . '/' . $booking}}">{{ $booking }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-end">
                                        {{-- {{ $data->withQueryString()->links() }} --}}
                                    </div>
                                    <table class="table table-bordered table-striped table-hover table-sm">
                                        <thead class="table-{{ $bgColor }}">
                                            <tr>
                                                <th class=""><i class="bi bi-gear"></i></th>
                                                <th>Profile Pic</th>
                                                <th>Booking #</th>
                                                <th class="">Patient Name</th>
                                                <th class="">Complaint</th>
                                                <th class="">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($booking_type_arr))
                                            @php
                                                if($booking_type == 'Referral'){
                                                    $bookingArr = $user->bookings()->whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get();
                                                }else{
                                                    $bookingArr = $user->bookings()->where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get();
                                                }
                                            @endphp
                                            @foreach($bookingArr as $dat)
                                            {{-- @foreach($user->bookings()->where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get() as $dat) --}}
                                            <tr>
                                                <td>@include($viewFolder . '.tableOptions')</td>
                                                <td class="text-center"><img src="{{ !empty($dat->patient->profile_pic) ? asset('storage/px_files/' . $dat->patient->profile_pic) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="70px"></td>
                                                <td>{{ $dat->id }}</td>
                                                <td class="">{{ $dat->patient->name }}</td>
                                                <td class="">{{ $dat->complain }}</td>
                                                <td class="">{{ $dat->status }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>    
                                    <div class="d-flex justify-content-end">
                                        {{-- {{ $data->withQueryString()->links() }} --}}
                                    </div>
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
