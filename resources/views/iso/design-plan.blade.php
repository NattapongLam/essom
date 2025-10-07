<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Design Request and Design Planning</title>
 <style>
    :root{
      --bg:#f2f5f8;
      --card:#ffffff;
      --muted:#6b7280;
      --accent:#0ea5a4;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
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
      justify-content:center;}

.highlight 
    font-weight: bold;
    text-decoration: underline;
    .wrap{
      width:100%;
      max-width:980px;
      margin:20px auto;
    }

    /* Card with layered shadow + reflection */
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
    body, label, input, textarea, button, h2, h3, p, th, td {
    font-weight: bold;
}

    .badge{
      position:absolute;
      right:16px;
      top:16px;
      font-size:12px;
      color:var(--muted);
      background: rgba(15,23,42,0.03);
      padding:6px 10px;
      border-radius:999px;
      border:1px solid rgba(15,23,42,0.02);
    }

    h1{
      font-size:20px;
      margin:0 0 8px 0;
      font-weight:700;
      letter-spacing:0.2px;
    }
    p.lead{
      margin:0 0 20px 0;
      color:var(--muted);
    }

    form{
      display:block;
      
    }

    .grid{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:16px;
      align-items:start;
      margin-bottom:15px;
    }
    label{
      display:block;
      font-size:13px;
      color: #0f172a;
      margin-bottom:6px;
      font-weight:600;}
  .checkbox-row1 {
        display: block;       /* ให้ container เป็น block */
        text-align: left;     /* จัดทุกอย่างให้ชิดซ้าย */
        margin-bottom: 15px; 
          gap: 5px; /* เว้นระยะห่างระหว่างกลุ่ม */
    }

    .checkbox-row label {
        display: block;       /* ให้แต่ละ label อยู่คนละบรรทัด */
        margin-bottom: 5px;   /* เพิ่มระยะห่างระหว่าง checkbox */
        text-align: left;  
          gap: 5px;  
}
        .muted{
      color:var(--muted);
      font-weight:400;
      font-size:13px;
    }
    .input6{
      display: flex; align-items: center;
      gap: 20px; 
       width:60%;
       white-space: nowrap;
    }
        .input5{
      display: flex; align-items: center;
      gap: 15px; 
       width:100%;
    white-space: nowrap;}
    .input4{
      display: flex; align-items: center;
      gap: 10px; 
       width:90%;
  margin-bottom: 10px;
  margin-left: 84px;
}
     
    .input3{
      display: flex; align-items: center;
      gap: 10px; 
       width:100%;
       
    }
    .input2{
 width:203%;
    }
    .input1{
 width:120%;
    }

    input[type="text"], input[type="date"], textarea, select{
      width:100%;
      padding:10px 12px;
      border-radius:10px;
      border:1px solid rgba(15,23,42,0.08);
      background: linear-gradient(180deg, #fff, #fbfcff);
      font-size:14px;
      outline:none;
      transition: box-shadow .16s, border-color .16s, transform .08s;
    }
    input[type="text"]:focus, textarea:focus, select:focus{
      box-shadow: 0 6px 18px rgba(14,165,164,0.08);
      border-color: rgba(14,165,164,0.6);
      transform: translateY(-1px);
    }
    textarea{
      min-height:110px;
      resize:vertical;
      padding-top:12px;
    }

    .row{
      margin-bottom:15px;
    }

    .checkbox-row{
      display: flex;
    flex-wrap: wrap;
    gap: 25px;
      
     
    }
    .checkbox-row label{ 
  display: block;  
    margin-bottom: 5px; 
        text-align: left; 
          gap: 25px;
  
}
    
    .small{
      font-size:14px;
      color:var(--muted);
      margin-top:6px;
    }
     .bold-label {
        font-weight: bold;
    }

    .actions{
      display:flex;
      gap:12px;
      justify-content:flex-end;
      margin-top:18px;
    }
    button.primary{
      background: linear-gradient(180deg, #258b25ff, #337725ff);
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

    /* preview of uploaded/attached scan on left */
    .layout{
      display:grid;
      grid-template-columns: 360px 1fr;
      gap:22px;
    }
    .scan{
      border-radius:12px;
      overflow:hidden;
      border:1px solid rgba(15,23,42,0.03);
      background:linear-gradient(180deg,#f8fafb,#fff);
      display:flex;
      align-items:center;
      justify-content:center;
      padding:12px;
      box-shadow: 0 8px 30px rgba(8,20,40,0.06);
    }
    .scan img{
      max-width:100%;
      height:auto;
      display:block;
      border-radius:6px;
      box-shadow: 0 10px 30px rgba(2,6,23,0.06);
      transform: translateY(-4px);
    }
.form-container {
font-family: "Times New Roman", Times, serif;
   margin: 30px;
background: #ffffffff;
padding: 20px 50px;
border-radius: 25px;box-shadow: 2px 2px 10px gray;
width: 950px;
overflow: hidden;
margin-top: 40px;
}
    .summary{
      margin-top:18px;
      background: linear-gradient(180deg, rgba(14,165,164,0.03), rgba(14,165,164,0.01));
      padding:14px;
      border-radius:12px;
      border:1px solid rgba(14,165,164,0.06);
    }
    .field{
      display:flex;
      gap:10px;
      align-items:flex-start;
      margin-bottom:8px;
    }
    .field b{ min-width:200px; display:inline-block; color:#0f172a; }

    @media (max-width:920px){
      .layout{ grid-template-columns: 1fr; }
      .grid{ grid-template-columns: 1fr; }
      .badge{ position:static; display:inline-block; margin-bottom:12px; }
    }
  </style>
</style>
</head>
<body>
 <div class="">
              <h2 align="center">ESSOM CO.,LTD.</h2>
          <h2 align="center">แผนการออกแบบผลิตภัณฑ์</h2>
     <h2 align="center">DESIGN REQUEST AND DESIGN PLANNING</h2>
    <div class="card">
    <h3>1.Design Request</h3>
    <form>
        <div class="grid">
              <div class="input1">
                <label >1.1Product</label>
                <input  type="text" name="name"  placeholder="Product">
              </div>
              <div style="margin-left: 195px;">
                  <label >Model</label>
                <input  style="width: 200px; " type="text" name="department"  placeholder="Model">
              </div>
         <div class="input2">
                <label>Desciption</label>
                <input type="text" name="Desciption"  placeholder="Desciption">
              </div>
               </div>
            <div class="checkbox-row" style=" align-items: left; gap: 10px;">
    <label style=" align-items: left; gap: 5px;">
       1.2Reasons: <input type="checkbox" name="  Cost Price" value="  Cost Price">
        Cost Price

      <input type="checkbox" name="    Drawing" id="" >   Drawing
 Picture for Catalog</span> 
      <input type="checkbox" name="   Prototype" id="" >
   Prototype
 </div> 

        <label>Other</label>
        <input type="text" name="other_reason" placeholder="Desciption">

        <label>Design Input</label>
     <div class="grid">
              <div>
                <label>1)</label>
                <input type="text" name="Design1"  placeholder="Design">
              </div>
              <div>
                <label>5)</label>
                <input type="text" name="Design5"  placeholder="Design">
              </div>
               </div>
<div class="grid">
              <div>
                <label>2)</label>
                <input type="text" name="Design2"  placeholder="Design">
              </div>
              <div>
                <label>6)</label>
                <input type="text" name="Design6"  placeholder="Design">
              </div> </div>
              
        <div class="grid">
              <div>
                <label>3)</label>
                <input type="text" name="Design3"  placeholder="Design">
              </div>
              <div>
                <label>7)
               <input type="text" name="Design7"  placeholder="Design"></label>
              </div> </div>
                <div class="grid">
              <div>
                <label>4)</label>
                <input type="text" name="Design4"  placeholder="Design">
              </div>
              <div>
                <label>8)</label>
                <input type="text" name="Design8"  placeholder="Design">
              </div> </div>
              <div class="input3">
  <label>1.4Reference:</label>
  <label >Brand</label>
  <input type="text" name="brand1" >
<label >Model</label>
  <input type="text" name="model1" >
   <label >Brand</label>
  <input type="text" name="brand2" >
<label >Model</label>
  <input type="text" name="model2" >
</div>
<br>
<div class="input4">
    <label >Brand</label>
  <input type="text" name="brand1" >
<label >Model</label>
  <input type="text" name="model1" >
   <label >Brand</label>
  <input type="text" name="brand2" >
<label >Model</label>
  <input type="text" name="model2" >
</div>
<br>
 <div class="input5">
<label>1.5Requested By</label>
  <input type="text" name="requested_by" >
<label >Date</label>
  <input type="date" name="requested_date" >
   <label >Reviewed By</label>
  <input type="text" name="reviewed_by" >
<label >Date</label>
  <input type="date" name="reviewed_date" >
</div>
<br>
        <div class="input6">
<label>1.6Approved By</label>
  <input type="text" name="approved_by" >
<label>Date</label>
        <input type="date" name="approved_date">
</div>
        <h4>2. Design Planning</h4>
        <label>2.1 Engineer :</label>
        <input type="text" name="engineer">
        <label>2.2 Senior Engineer:</label>
        <input type="text" name="senior_engineer">
         <div class="input6">
<label>2.3 Due Date </label>
<label style="margin-left: 410px; text-decoration: underline;">Planning </label>
<label style="margin-left: 180px; text-decoration: underline;">Actual </label>
         </div>
          <div class="input5">
<label style="margin-left: 20px;">2.3.1 Preliminary Design & Calculations</label>
  <input style="margin-left: 200px;"  type="date" name="plan_calc" >
        <input type="date" name="act_calc">
        </div>
        <br>
        <div class="input5">
        <label style="margin-left: 20px;">2.3.2 Design Review</label>
  <input style="margin-left: 310px;"  type="date" name="plan_review" >
        <input type="date" name="act_review">
</div>
<br>
<div class="input5">
        <label style="margin-left: 20px;">Participants:</label>
  <input  type="text" name="Participants" >
</div>
<br>
<div class="input5">
        <label style="margin-left: 20px;">2.3.3 Design Verification</label>
  <input style="margin-left: 290px;"  type="date" name="plan_verify" >
        <input type="date" name="act_verify">
</div>
<br>
<div class="input5">
        <label style="margin-left: 20px;">2.3.4 Prototype Production</label>
  <input style="margin-left: 270px;"  type="date" name="plan_proto" >
        <input type="date" name="act_proto">
</div>
<br>
        <div class="input5">
        <label style="margin-left: 20px;">2.3.5 Validationn</label>
  <input style="margin-left: 330px;"  type="date" name="plan_valid" >
        <input type="date" name="act_valid">
</div>
<br> 
     <div class="input5">
        <label style="margin-left: 20px;">2.3.6 Final Design Approval</label>
  <input style="margin-left: 270px;"  type="date" name="plan_final" >
        <input type="date" name="act_final">
</div>
<br> 
<div class="input5">
        <label style="margin-left: 10px;">2.4 Planned By</label>
  <input   type="text" name="Planned" > Engineering Section
      <label style="margin-left: 50px;" >Date  </label><input type="date" name="date_engineering">
</div>
<br> 
<div class="input5">
 <input   type="text" name="marketing" style="margin-left: 110px;" > Marketing Representative
      <label style="margin-left: 10px;" >Date  </label><input type="date" name="date_marketing">
</div>
<br> 
      <div class="input5">
 <input   type="text" name="plant" style="margin-left: 110px;" > Plant Representative
      <label style="margin-left: 40px;" >Date  </label><input type="date" name="date_plant">
</div>
<br> 
      <div class="input5">
        <label style="margin-left: 10px;">2.5 Approved By</label>
  <input   type="text" name="Approved" >
      <label style="margin-left: 200px;" >Date  </label><input type="date" name="date_engineering">
</div>
<br> 

     <div class="actions">
              <button type="button" class="ghost" onclick="window.location.href=window.location.pathname">รีเซ็ต</button>
              <button type="submit" class="primary">บันทึกข้อมูล</button>
            </div>
    </form>
</div>
</body>
</html>