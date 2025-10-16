@extends('layouts.main')
@section('content')
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 30px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .input_style {
            width: 92%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .input_style2 {
            width: 30%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .input_style3 {
            width: 85%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .input_style4 {
            width: 70%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .main_tabel {
            width: 1200px;
            margin: auto;
        }

        .table_style {
            box-shadow: 2px 2px 10px gray;
            border: 35px solid white;
            border-radius: 25px;
        }
    </style>
    <h2 align="center">ESSOM CO.,LTD.</h2>
    <h2 align="center">PLAN</h2>

    <form method="POST" action="{{ route('iso-plan.store') }}">
        @csrf

        <div align="left">
            Project :
            <input class="input_style2" type="text" name="project_name" required>
            Responsible Section / Person :
            <input class="input_style2" type="text" name="responsible_section" required>
        </div>

        <br />

        <table width="100%" border="1" cellpadding="0" cellspacing="0" class="table_style">
            <tr>
                <td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="4%" rowspan="2" align="center">No.</td>
                            <td width="38%" rowspan="2" align="center">Description of Activities</td>
                            <td width="6%" rowspan="2" align="center">Resp.<br>Person</td>
                            <td colspan="2" align="center">Date</td>
                            <td width="11%" align="center">STATUS</td>
                            <td width="24%" align="center">Progress Report/Remarks</td>
                        </tr>
                        <tr>
                            <td width="8%" align="center">Start</td>
                            <td width="9%" align="center">Finish</td>
                            <td align="center">Result</td>
                            <td align="center">&nbsp;</td>
                        </tr>

                        @for ($i = 0; $i < 14; $i++)
                            <tr>
                                <td align="center">{{ $i + 1 }}</td>
                                <td>
                                   <input class="input_style" type="text" name="DA[]" placeholder="Activity">
                            <input class="input_style4" type="text" name="RP[]" placeholder="Person">
                            <input class="input_style3" type="date" name="date_start[]">
                            <input class="input_style3" type="date" name="date_end[]">
                            <input class="input_style3" type="text" name="RS[]" placeholder="Status">
                            <input class="input_style" type="text" name="Remark[]" placeholder="Remarks">
                                </td>
                            </tr>
                        @endfor
                    </table>
                </td>
            </tr>
        </table>

        <p>&nbsp;</p>
        <button type="submit">ส่งข้อมูล</button>
    </form>
</body>

@endsection
