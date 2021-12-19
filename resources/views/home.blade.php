@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div name="patient-info">
                <table 
                    class="table-bordered text-white table-sm" 
                    id="patient-info"
                    style="border: 1px solid white;width:100%;">
                    <thead>
                        <th>
                            MRN
                        </th>
                        <th>
                            Patient Full Name
                        </th>
                        <th>
                            DOB
                        </th>
                        <th>
                            Gender
                        </th>
                    </thead>
                    <tbody>
                        @foreach($patient_infos as $patient_info)
                        <tr id="{{$patient_info->mrn}}">
                            <th>
                                {{$patient_info->mrn}}
                            </th>
                            <th>
                                {{$patient_info->firstname.$patient_info->fathername.$patient_info->familyname}}
                            </th>
                            <th>
                                {{$patient_info->birthday}}
                            </th>
                            <th>
                                {{$patient_info->gender}}
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div name="result-info">
                <table 
                    class="table-bordered text-white table-sm" 
                    style="border: 1px solid white;width:100%;"
                >
                    <thead>
                        <th>
                            Record Date
                        </th>
                        <th>
                            Record Nature
                        </th>
                        <th>
                            Processing Site
                        </th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div name="search">
                <div class="form-group">
                    <label for="search_input">
                        Search:
                    </label>
                    <input name="search_input" id="search_input"/>
                </div>
            </div>
            <div name="result_preview">
                <div class="title">
                    Result Preview
                    <iframe src="http://docs.google.com/gview?url=http://localhost:8000/uploads/10000.pdf&embedded=true" 
                        style="width:600px; height:500px;" frameborder="0"></iframe>
                </div>
            </div>
            <div class="email_section">
                <div class="form-group">
                    <label for="email_input">
                        Email:
                    </label>
                    <input type="email"/>
                    <button class="btn">
                        Email Result
                    </button>
                    <button class="btn">
                        Download
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#patient-info').children('tbody').children('tr').on('click',function(){
            console.log($(this).attr('id'));
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/patient_info',
                data: {
                    id:$(this).attr('id')
                },
                cache:false,
                contentType:false,
                processData:false,
                success: function (data) {
                if(data.success){
                }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        })
    })
</script>
@endsection
