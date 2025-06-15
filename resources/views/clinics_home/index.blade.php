@extends('layouts.app')
@section('content')

<datalist id="patientNameList"></datalist>
<datalist id="doctorNameList"></datalist>

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
                        // if(!isset($yr))
                        //     $yr = date('Y');
                        // if(!isset($mon))
                        //     $mon = date('n');
                        // $getDayKey = false;
                        // if(!isset($dayNum)){
                        //     $getDayKey = true;
                        //     $dayNum = date('d');
                        // }
                        unset($doctor_list);
                        unset($specialty_list);
                        if(!empty($schedules)){
                            if($dayNumSet){
                                $doctor_list = $schedules->get(['id', 'name', 'specialty'])->sortBy('name');
                                $specialty_list = $schedules->distinct()->get('specialty')->sortBy('specialty');
                            }else{
                                $doctor_list = $schedules->get(['id', 'name', 'specialty'])->sortBy('name');
                                $specialty_list = $schedules->distinct()->get('specialty')->sortBy('specialty');
                            }
                            // $doctor_list_id = $schedulesMon->get('id');
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
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="doctor_home_mon" aria-label="Month" onchange="
                                                // if($('#doctor_home_specialty').val() !== undefined)
                                                //     window.location.href = '{{ route($viewFolder . '.index') }}/' + $('#doctor_home_yr').val() + '/' + $(this).val() + '/ /' + $('#doctor_home_specialty').val();
                                                // else if($('#doctor_home_id').val() !== undefined)
                                                //     window.location.href = '{{ route($viewFolder . '.index') }}/' + $('#doctor_home_yr').val() + '/' + $(this).val() + '/ /' + $('#doctor_home_specialty').val() + '/' + $('#doctor_home_id').val();
                                                // else
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
                                        <input type="text" class="form-control" id="doctor_home_yr" placeholder="Year" aria-label="Year" value = "{{ $yr }}" onblur="
                                            if(typeof $('#doctor_home_specialty').val() == 'undefined')
                                                $('#doctor_home_specialty').val() = '';
                                            if(typeof $('#doctor_home_id').val() == 'undefined')
                                                $('#doctor_home_id').val() = '';
                                            window.location.href = '{{ route($viewFolder . '.index') }}/' + $(this).val();
                                        ">
                                        @can($viewFolder . '.book')
                                            @if(isset($specialty_list[0]))
                                            <form action="{{ route($viewFolder . '.book') }}" method="POST">
                                                @csrf
                                                <span class="input-group-text"><button type="submit" class="btn btn-sm"  title="Book" {{ !empty($doctor_id) ? '' : 'disabled' }}><i class="bi bi-clipboard2-plus"></i></button></span>
                                                <input type="hidden" name="{{ $viewFolder }}[dateSched]" value="{{ $yr . '-' . str_pad($mon, 2, 0, STR_PAD_LEFT) . '-' . str_pad($dayNum, 2, 0, STR_PAD_LEFT) }}">
                                                <input type="hidden" name="{{ $viewFolder }}[doctor_id]" value="{{ $doctor_id }}">
                                            </form>
                                            @endif
                                        @endcan
                                        @can($viewFolder . '.manageDoctor')
                                        <span class="input-group-text"><a type="submit" class="btn btn-sm" href="{{ route($viewFolder . '.manageDoctor') }}" title="Manage Doctor" role="button"><i class="bi bi-person-heart"></i></a></span>
                                        @endcan
                                        <span class="input-group-text"><a class="btn btn-sm" href="#" title="Search Booking" data-bs-toggle="offcanvas" data-bs-target="#searchPane" href="#" role="button"><i class="bi bi-search"></i></a></span>
                                    </div>
                                    @if(isset($specialty_list[0]))
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Specialty:</span>
                                        <select class="form-select" id="doctor_home_specialty" aria-label="Specialty" onchange="
                                            window.location.href = '{{ route($viewFolder . '.index') }}/' + $('#doctor_home_yr').val() + '/' + $('#doctor_home_mon').val() + '/{{ $dayNum }}/{{ $booking_type }}/' + $(this).val();
                                        ">
                                            <option></option>
                                        @foreach($specialty_list as  $doctor)
                                            <option value="{{ $doctor->specialty }}" {{ $specialty == $doctor->specialty ? 'selected' : '' }}>{{ $doctor->specialty }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    @if(isset($doctor_list[0]))
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Doctor:</span>
                                        <select class="form-select" id="doctor_home_id" aria-label="Doctor" onchange="
                                            if(typeof $('option:selected', this).attr('specialtyAttr') == 'undefined')
                                                $('option:selected', this).attr('specialtyAttr', '');
                                            window.location.href = '{{ route($viewFolder . '.index') }}/' + $('#doctor_home_yr').val() + '/' + $('#doctor_home_mon').val() + '/{{ $dayNum }}/{{ $booking_type }}/' + $('option:selected', this).attr('specialtyAttr') + '/' + $(this).val();
                                        ">
                                            <option></option>
                                        @foreach($doctor_list as  $doctor)
                                            <option value={{ $doctor->id }} specialtyAttr="{{ $doctor->specialty }}" {{ $doctor_id == $doctor->id ? 'selected' : '' }}>Dr. {{ $doctor->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    
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
                                                    @if(strtotime($yr . '-' . $mon . '-' . $i) >= strtotime(' - 4 days'))
                                                        @can($viewFolder . '.index')
                                                            {{-- @if(!empty($user->clinic->schedules()->whereIn('doctor_id', $doctor_list_id)->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0])) --}}
                                                            @if(isset($calendarArr[$i]) && sizeof($calendarArr[$i])>0)
                                                        <a href="{{ route($viewFolder . '.index', [$yr, $mon, $i]) }}" class="link-{{ $bgColor }} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                            @endif
                                                        @endcan
                                                            <div>
                                                                <div>{{ $i }}</div>
                                                                <div>
                                                                {{-- @if(!empty($user->clinic->schedules()->whereIn('doctor_id', $doctor_list_id)->where('dateSched', $yr . '-' . $mon . '-' . $i)->distinct()->get('doctor_id')[0]))     --}}
                                                                @if(isset($calendarArr[$i]) && sizeof($calendarArr[$i])>0)
                                                                    {{-- <i class="bi bi-person-check"></i> {{ !empty($user->clinic->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->distinct()->get('doctor_id')[0]) ? sizeof($user->clinic->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->distinct()->get('doctor_id')) : 0 }} --}}
                                                                    <i class="bi bi-person-check"></i> {{ sizeof($calendarArr[$i])>0 ? sizeof($calendarArr[$i]) : 0 }}
                                                                @else
                                                                    &nbsp;
                                                                @endif
                                                                </div>
                                                                <div>
                                                                    {{-- @if(!empty($user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $i)->get()[0])) --}}
                                                                    @if(isset($bookingArr[$i]) && $bookingArr[$i]>0)
                                                                    {{-- <i class="bi bi-list-ol"></i> {{ sizeof($user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $i)->get()) }} --}}
                                                                    <i class="bi bi-list-ol"></i> {{ $bookingArr[$i] }}
                                                                    @else
                                                                    &nbsp;
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @can($viewFolder . '.index')
                                                            {{-- @if(!empty($user->clinic->schedules()->whereIn('doctor_id', $doctor_list_id)->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0])) --}}
                                                            @if(isset($calendarArr[$i]) && sizeof($calendarArr[$i])>0)
                                                        </a>
                                                            @endif
                                                        @endcan
                                                        
                                                    @else
                                                    <div>
                                                        <div>{{ $i }}</div>
                                                        <div>&nbsp;</div>
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
                                                    @if(strtotime($yr . '-' . $mon . '-' . $i) >= strtotime('- 4 days'))
                                                        @can($viewFolder . '.index')
                                                            {{-- @if(!empty($user->clinic->schedules()->whereIn('doctor_id', $doctor_list_id)->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0])) --}}
                                                            @if(isset($calendarArr[$i]) && sizeof($calendarArr[$i])>0)
                                                        <a href="{{ route($viewFolder . '.index', [$yr, $mon, $i]) }}" class="link-{{ $bgColor }} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                            @endif
                                                        @endcan
                                                            <div>
                                                                <div>{{ $i }}</div>
                                                                <div>
                                                                {{-- @if(!empty($user->clinic->schedules()->whereIn('doctor_id', $doctor_list_id)->where('dateSched', $yr . '-' . $mon . '-' . $i)->distinct()->get('doctor_id')[0]))     --}}
                                                                @if(isset($calendarArr[$i]) && sizeof($calendarArr[$i])>0)
                                                                    {{-- <i class="bi bi-person-check"></i> {{ !empty($user->clinic->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->distinct()->get('doctor_id')[0]) ? sizeof($user->clinic->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $i)->distinct()->get('doctor_id')) : 0 }} --}}
                                                                    <i class="bi bi-person-check"></i> {{ sizeof($calendarArr[$i])>0 ? sizeof($calendarArr[$i]) : 0 }}
                                                                @else
                                                                    &nbsp;
                                                                @endif
                                                                </div>
                                                                <div>
                                                                    {{-- @if(!empty($user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $i)->get()[0])) --}}
                                                                    @if(isset($bookingArr[$i]) && $bookingArr[$i]>0)
                                                                    {{-- <i class="bi bi-list-ol"></i> {{ sizeof($user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $i)->get()) }} --}}
                                                                    <i class="bi bi-list-ol"></i> {{ $bookingArr[$i] }}
                                                                    @else
                                                                    &nbsp;
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @can($viewFolder . '.index')
                                                            {{-- @if(!empty($user->clinic->schedules()->whereIn('doctor_id', $doctor_list_id)->where('dateSched', $yr . '-' . $mon . '-' . $i)->get()[0])) --}}
                                                            @if(isset($calendarArr[$i]) && sizeof($calendarArr[$i])>0)
                                                        </a>
                                                            @endif
                                                        @endcan
                                                    @else
                                                    <div>
                                                        <div>{{ $i }}</div>
                                                        <div>&nbsp;</div>
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
                                <h3>Booking List ( {{ date('F d, Y', strtotime($yr. '-' . $mon . '-' . $dayNum)) }} )</h3>
                                @if(isset($booking_type_arr))
                                <ul class="nav nav-tabs">
                                    @if(!empty($yr))
                                        @foreach($booking_type_arr as $in=>$booking)
                                            @if($booking > 0)
                                    <li class="nav-item">
                                        @php
                                            $li_active = "";
                                            if($in == $booking_type)
                                                $li_active = "active";
                                            // elseif(!in_array($booking_type, $booking_type_arr))
                                            //     $li_active = "active";
                                        @endphp
                                        <a class="nav-link {{ $li_active }}" aria-current="page" href="{{ route($viewFolder . '.index', [$yr, $mon, $dayNum, $in, $specialty, $doctor_id]) . '?' . $urlQuery }}">{{ $in }} <span class="badge text-bg-{{ $bgColor }}">{{ $booking }}</span></a>
                                    </li>
                                            @endif
                                        @endforeach
                                    @endif
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
                                            @if(!empty($booking_type) && $booking_type == 'Referral')
                                                <th>Parent Booking #</th>
                                            @endif
                                                
                                                <th>Booking #</th>
                                                <th class="">Doctor</th>
                                            @if(!empty($booking_type) && $booking_type == 'Referral')
                                                <th>Clinic</th>
                                                <th>Booking Type</th>
                                            @endif
                                                <th class="">Patient</th>
                                            @if(isset($booking_type) && ($booking_type == 'Diagnostics' || $booking_type == 'Laser' || $booking_type == 'Surgery'))
                                                <th class="">Procedure</th>
                                            @else
                                                <th class="">Complaint</th>
                                                <th class="">Status</th>
                                            @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($booking_type_arr))    
                                            @if(!empty($yr))
                                                @php
                                                    if(!empty($booking_type) && $booking_type == 'Referral'){
                                                        if(!is_null($patientArr) && !is_null($doctorArr))
                                                            $bookingArr = $user->clinic->bookings()->whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get();
                                                        elseif(!is_null($patientArr))
                                                            $bookingArr = $user->clinic->bookings()->whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->get();
                                                        elseif(!is_null($doctorArr))
                                                            $bookingArr = $user->clinic->bookings()->whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('doctor_id', $doctorArr)->get();
                                                        else
                                                            $bookingArr = $user->clinic->bookings()->whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get();
                                                    }else{
                                                        if(!is_null($patientArr) && !is_null($doctorArr))
                                                            $bookingArr = $user->clinic->bookings()->where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get();
                                                        elseif(!is_null($patientArr))
                                                            $bookingArr = $user->clinic->bookings()->where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->get();
                                                        elseif(!is_null($doctorArr))
                                                            $bookingArr = $user->clinic->bookings()->where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('doctor_id', $doctorArr)->get();
                                                        else
                                                            $bookingArr = $user->clinic->bookings()->where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get();
                                                    }
                                                @endphp
                                                @foreach($bookingArr as $dat)
                                            <tr>
                                                <td>@include($viewFolder . '.tableOptions')</td>
                                                <td class="text-center"><img src="{{ !empty($dat->patient->profile_pic) ? (stristr($dat->patient->profile_pic, 'uploads') ? asset('storage/' . $dat->patient->profile_pic) : asset('storage/px_files/' . $dat->patient->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="70px"></td>
                                            @if($booking_type == 'Referral')
                                                <td>{{ $dat->consultation_parent_id }}</td>
                                            @endif
                                                <td>{{ $dat->id }}</td>
                                                <td class="">Dr. {{ $dat->doctor->name }}</td>
                                            @if($booking_type == 'Referral')
                                                <td>{{ $dat->clinic->name }}</td>
                                                <td>{{ $dat->booking_type == '' ? 'Consultations' : $dat->booking_type }}</td>
                                            @endif
                                                <td class="">{{ $dat->patient->name }}</td>
                                            @if(isset($booking_type) && ($booking_type == 'Diagnostics' || $booking_type == 'Laser' || $booking_type == 'Surgery'))
                                                <td class="">{{ $dat->procedure_details }}</td>
                                            @else
                                                <td class="">{{ $dat->complain }}</td>
                                                <td class="">{{ $dat->status }}</td>
                                            @endif
                                            </tr>
                                                @endforeach
                                            @endif
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
