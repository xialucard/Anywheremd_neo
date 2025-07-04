<div class="form-floating mb-3">
    <input type="text" list="patientNameList" name="{{ $viewFolder }}[Patient][name]" id="search_{{ $viewFolder }}_name" class="form-control" placeholder="" autocomplete="off" aria-describedby="helpId">
    <label for="search_{{ $viewFolder }}_name" class="form-label">{{ str_replace('Input New ', '', $inputFormHeader) }} Patient's Name</label>
    <small id="help_search_{{ $viewFolder }}_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
    <input type="text" list="doctorNameList" name="{{ $viewFolder }}[Doctor][name]" id="search_{{ $viewFolder }}_doctor_name" class="form-control" placeholder="" autocomplete="off" aria-describedby="helpId">
    <label for="search_{{ $viewFolder }}_doctor_name" class="form-label">{{ str_replace('Input New ', '', $inputFormHeader) }} Doctor's Name</label>
    <small id="help_search_{{ $viewFolder }}_doctor_name" class="text-muted"></small>
</div>


<script>
    $("#search_{{ $viewFolder }}_name").on("input", function () {
        val = $(this).val();
        if(val.length >= 3){
            $.ajax({
                type: 'GET',
                url: '{{ Route::has('clinics_home.getPatientList') ? route('clinics_home.getPatientList') : ''}}/' + val + '/true',
                success: function(data){
                patientsObj = jQuery.parseJSON(data);
                var options = "";
                patientsObj.forEach(function (item, index){
                    options  += '<option patient_id="' + item.id + '" value="' + item.name + '">' + item.name + '</option>';
                });
                $("#patientNameList").html(options);
                }
            });
        }
    });

    $("#search_{{ $viewFolder }}_doctor_name").on("input", function () {
        val = $(this).val();
        if(val.length >= 3){
            $.ajax({
                type: 'GET',
                url: '{{ Route::has('clinics_home.getDoctorList') ? route('clinics_home.getDoctorList') : ''}}/' + val,
                success: function(data){
                patientsObj = jQuery.parseJSON(data);
                var options = "";
                patientsObj.forEach(function (item, index){
                    options  += '<option patient_id="' + item.id + '" value="' + item.name + '">' + item.name + '</option>';
                });
                $("#doctorNameList").html(options);
                }
            });
        }
    });
</script>

