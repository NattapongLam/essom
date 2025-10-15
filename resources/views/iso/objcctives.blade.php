@extends('layouts.main')
@section('content')
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
@endif

<style>
    :root{
      --bg:#f2f5f8;
      --card:#ffffff;
      --muted:#6b7280;
      --accent:#0ea5a4;
    }
    *{box-sizing:border-box}

    body{
      margin: 40px;
      font-family: "Noto Sans Thai", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background:
        radial-gradient(1200px 400px at -10% 10%, rgba(14,165,164,0.06), transparent 10%),
        linear-gradient(180deg, var(--bg), #eef3f7 60%);
      color:#0f172a;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      padding:40px 20px;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
    }

    .wrap{
      width:100%;
      max-width:980px;
      margin:20px auto;
    }

    .card{
      background: linear-gradient(180deg, var(--card), #fbfdff);
      border-radius:18px;
      padding:20px;
      box-shadow:
        0 6px 18px rgba(6,20,40,0.08),
        0 18px 40px rgba(8,25,60,0.08),
        inset 0 1px 0 rgba(255,255,255,0.6);
      border: 1px solid rgba(15,23,42,0.04);
      position:relative;
      overflow:visible;
    }

    input[type="text"], input[type="date"]{
      width:40%;
      padding:10px 12px;
      border-radius:10px;
      border:1px solid rgba(15,23,42,0.08);
      background: linear-gradient(180deg, #fff, #fbfcff);
      font-size:14px;
      outline:none;
      transition: box-shadow .16s, border-color .16s, transform .08s;
    }
    input[type="text"]:focus, input[type="date"]:focus{
      box-shadow: 0 6px 18px rgba(14,165,164,0.08);
      border-color: rgba(14,165,164,0.6);
      transform: translateY(-1px);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid black;
      margin-top: 15px;
    }
    th, td {
      border: 1px solid black;
      padding: 4px;
      text-align: center;
      vertical-align: middle;
    }
    th {
      background-color: #e9ecef;
      font-weight: bold;
    }

    .form-container {
      font-family: "Times New Roman", Times, serif;
      margin: 30px auto;
      background: #fff;
      padding: 20px 50px;
      border-radius: 25px;
      box-shadow: 2px 2px 10px gray;
      width: 1100px;
    }

    .actions{
      display:flex;
      gap:12px;
      justify-content:flex-end;
      margin-top:20px;
    }
    button.primary{
      background: linear-gradient(180deg, #258b25, #337725);
      color:white;
      border:none;
      padding:10px 16px;
      border-radius:10px;
      font-weight:700;
      box-shadow: 0 10px 30px rgba(8,158,157,0.18);
      cursor:pointer;
    }
    button.ghost{
      background:transparent;
      color:var(--muted);
      border:1px solid rgba(15,23,42,0.06);
      padding:10px 14px;
      border-radius:10px;
      cursor:pointer;
    }
</style>

<div class="wrap">
  <h2 align="center">ESSOM CO., LTD.</h2>
  <h2 align="center">OBJECTIVES</h2>

  <div class="form-container">
    <form action="{{ route('iso-objectives.store') }}" method="POST">
      @csrf

      <div>
        <span>Section <input type="text" name="section"></span>
        <span style="margin-left: 70px;">For period <input type="text" name="period"></span>
      </div>

      <table>
        <thead>
          <tr>
            <th rowspan="2" width="6%">No.</th>
            <th rowspan="2" width="25%">Description of Activities</th>
            <th rowspan="2" width="10%">Resp.<br>Person</th>
            <th colspan="3" width="30%">Objectives</th>
            <th rowspan="2" width="30%">Remarks / Corrective actions</th>
          </tr>
          <tr>
            <th width="8%">Previous</th>
            <th width="8%">Plan</th>
            <th width="8%">Results</th>
          </tr>
        </thead>
        <tbody>
          @for ($i = 1; $i <= 30; $i++)
          <tr>
            <td><input style="width: 50px; height: 30px;" type="text" name="no[{{ $i }}]"></td>
            <td><input style="width: 200px; height: 30px;" type="text" name="description[{{ $i }}]"></td>
            <td><input style="width: 100px; height: 30px;" type="text" name="resp_person[{{ $i }}]"></td>
            <td><input style="width: 100px; height: 30px;" type="text" name="previous[{{ $i }}]"></td>
            <td><input style="width: 100px; height: 30px;" type="text" name="plan[{{ $i }}]"></td>
            <td><input style="width: 100px; height: 30px;" type="text" name="results[{{ $i }}]"></td>
            <td><input style="width: 300px; height: 30px;" type="text" name="remarks[{{ $i }}]"></td>
          </tr>
          @endfor
        </tbody>
      </table>

      <br>

      <div>
        <span>Prepared by <input type="text" name="prepared_by" style="width: 200px; height: 30px;"></span>
        <span style="margin-left: 40px;">Date <input name="prepared_date" type="date" style="width: 100px; height: 30px;"></span>
      </div>

      <div>
        <span>Reported by <input type="text" name="reported_by" style="width: 200px; height: 30px;"></span>
        <span style="margin-left: 40px;">Date <input name="reported_date" type="date" style="width: 100px; height: 30px;"></span>
      </div>

      <div>
        <span>Reviewed by <input type="text" name="reviewed_by" style="width: 200px; height: 30px;"></span>
        <span style="margin-left: 40px;">Date <input name="reviewed_date" type="date" style="width: 100px; height: 30px;"></span>
      </div>

      <div>
        <span>Acknowledged by <input type="text" name="acknowledged_by" style="width: 180px; height: 30px;"></span>
        <span style="margin-left: 40px;">Date <input name="acknowledged_date" type="date" style="width: 100px; height: 30px;"></span>
      </div>

      <div>
        <span>Approved by <input name="approved_by" type="text" style="width: 200px; height: 30px;"></span>
        <span style="margin-left: 40px;">Date <input name="approved_date" type="date" style="width: 100px; height: 30px;"></span>
      </div>

      <div class="actions">
        <button type="submit" class="primary">บันทึกข้อมูล</button>
      </div>

    </form>
  </div>
</div>

@endsection