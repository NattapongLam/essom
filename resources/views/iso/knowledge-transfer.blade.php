<?php
function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
$data = $submitted ? $_POST : [];
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>knowledge-transfer</title>

  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;700&display=swap" rel="stylesheet">

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
      justify-content:center;
    }
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
      margin-bottom:12px;
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
  display: block;   /* ให้ label แต่ละอันเป็นบล็อก คนละบรรทัด */
    margin-bottom: 5px; /* เพิ่มระยะห่างเล็กน้อยระหว่างบรรทัด */
        text-align: left; 
          gap: 25px;
  
}
    
    .small{
      font-size:13px;
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
</head>
<body>
 <div class="wrap">
              <h2 align="center">ESSOM CO.,LTD.</h2>
          <h2 align="center">ใบส่งต่อความรู้องค์การ / การประเมินผลและการทบทวน</h2>
    <div class="card">
          <?php if($submitted): ?>
            <div class="summary">
              <h3 style="margin-top:0;margin-bottom:6px">ผลการบันทึกข้อมูล</h3>
              <div class="field"><b>ผู้ส่ง/ผู้ประเมิน:</b> </div>
              <div class="field"><b>หน่วยงาน / ตำแหน่ง:</b> </div>
              <div class="field"><b>วันที่:</b> </div>
              <div class="field"><b>เรื่อง:</b></div>
              <div class="field"><b>ข้อคิดเห็น / สถานะ:</b> </div></div>
            </div>
          <?php endif; ?>

          <form method="post" novalidate>
            <div class="grid">
              <div>
                <label>ผู้ส่ง/ผู้ประเมิน ชื่อ</label>
                <input type="text" name="name"  placeholder="ชื่อ-นามสกุล">
              </div>
              <div>
                <label>หน่วยงาน</label>
                <input type="text" name="department"  placeholder="แผนก / ฝ่าย">
              </div>

              <div>
                <label>ตำแหน่ง</label>
                <input type="text" name="position"  placeholder="ตำแหน่ง">
              </div>
              <div>
                <label>วันที่</label>
                <input type="date" name="date">
              </div>

              <div>
                <label>เอกสาร KM เลขที่</label>
                <input type="text" name="docno"  placeholder="KM-...">
              </div>
              <div>
                <label>อนุมัติเมื่อวันที่</label>
                <input type="date" >
              </div>

              <div style="grid-column: 1 / -1;">
                <label>เรื่อง</label>
                <input type="text" name="subject" >
              </div>
            </div>

            <div class="row">
              <label>2.1)สถานะการส่งต่อ-ถ่ายทอดองค์ความรู้</label>
              <div class="checkbox-row" style=" align-items: left; gap: 10px;">
    <label style=" align-items: left; gap: 5px;">
        <input type="checkbox" name="status_sent1" value="ส่งต่อ-ถ่ายทอดแล้ว">
         <strong>ส่งต่อ-ถ่ายทอดแล้ว</strong>
      <span style="margin-left: 30px;"> <strong>วันที่:</strong></span> <input type="date" name="date" id="date" style="width: 100px; height: 30px;">
</div>
                       <div class="checkbox-row" style=" align-items: left; gap: 10px;">
    <label style=" align-items: left; gap: 5px;">
        <input type="checkbox" name="status_sent1" value="ยังไม่ได้ส่งต่อ-ถ่ายทอด">
         <strong>ยังไม่ได้ส่งต่อ-ถ่ายทอด</strong>
      <span style="margin-left: 30px;"> <strong>กำหนดวันส่งต่อความรู้ให้แล้วเสร็จวันที่:</strong></span> <input type="date" name="date" id="date" style="width: 100px; height: 30px;">
</div>
                           <div class="checkbox-row" style=" align-items: left; gap: 10px;">
    <label style=" align-items: left; gap: 5px;">
        <input type="checkbox" name="status_sent1" value="อยู่ระหว่างแผนการส่งต่อความรู้">
         <strong>อยู่ระหว่างแผนการส่งต่อความรู้</strong>
      <span style="margin-left: 30px;"> <strong>กำหนดเสร็จ:</strong></span> <input type="date" name="date" id="date" style="width: 100px; height: 30px;">
</div>
            <div class="row">
              <label>2.2) วิธีการในการส่งต่อ-ถ่ายทอดความรู้</label>
              <input type="text" name="method" value="">
            </div>
        <label>2.3) การประเมินผล</label>
            <div class="checkbox-row">
              <label >3.1
    <input type="checkbox" name="eval_understand1" value="รับรู้และเข้าใจเป็นอย่างดี">
   รับรู้และเข้าใจเป็นอย่างดี
</label>
<label>
    <input type="checkbox" name="eval_understand2" value="ยังไม่เข้าใจ">
    ยังไม่เข้าใจ
</label>

<label>
    <input type="checkbox" name="eval_understand3" value="เข้าใจเป็นบางส่วน">
      เข้าใจเป็นบางส่วน
</label>
            </div>
              <div class="checkbox-row">
              <label >3.2
    <input type="checkbox" name="other" value="ผ่าน">
   ผ่าน
</label>
<label>
    <input type="checkbox" name="eval_understand2" value="ไม่ผ่าน">
  ไม่ผ่าน
</label>
              </div>
              <div class="checkbox-row1">
                <label> 3.3<input type="checkbox" name="eval_other" value="ยังประเมินไม่ได้" >ยังประเมินไม่ได้</label>
                <label>3.4<input type="checkbox" name="eval_other1" value="ยังไม่ได้ประเมิน" > ยังไม่ได้ประเมิน</label>
              </div>

<div class="">
              <label>3.5) กรณีที่ยังไม่เข้าใจ/ไม่ผ่าน/ยังประเมินไม่ได้/ยังไม่ได้ประเมินไม่ได้ <span style="margin-left: 20px;"><strong>กำหนดวันประเมินอีกครั้ง วันที่:</strong></span> <input type="date" name="date" id="date" style="width: 100px; height: 30px;">
</div>
            <div class="row">
              <label>ข้อคิดเห็น / ข้อเสนอแนะจากหัวหน้างาน:</label>
              <textarea name="comments" placeholder="ข้อเสนอแนะ"></textarea>
            </div>

            <div class="row">
              <label>4) การทบทวนองค์ความรู้</label>
                <label><input type="checkbox" name="review1" value="องค์ความรู้นี้ยังสามารถใช้ได้ ณ ปัจจุบัน"> องค์ความรู้นี้ยังสามารถใช้ได้ ณ ปัจจุบัน</label>
              </div>
              
              <div style="margin-top:8px" class="checkbox-row">
                <label><input type="checkbox" name="review2" value="อาจไม่เป็นปัจจุบันแล้ว / ไม่สอดคล้องกับงาน" > อาจไม่เป็นปัจจุบันแล้ว / ไม่สอดคล้องกับงาน</label>
                <label>ควร<input type="checkbox" name="review3" value="ยกเลิกการนำไปใช้และจัดหาองค์ความรู้ใหม่แทน" > ยกเลิกการนำไปใช้และจัดหาองค์ความรู้ใหม่แทน</label>
              </div>

              <div style="margin-top:10px">
                <div class="small"></div>
                <div class="checkbox-row" style="margin-top:6px">
                  <label><input type="checkbox" name="freq" value="ทุกๆเดือน"> ทุกๆเดือน</label>
                  <label><input type="checkbox" name="freq" value="ทุกๆ 6 เดือน" > ทุกๆ 6 เดือน</label>
                  <label><input type="checkbox" name="freq" value="ทุกๆ 1 ปี" > ทุกๆ 1 ปี</label>
                  <label><input type="checkbox" name="freq" value="ไม่จำเป็นต้องทบทวนซ้ำ"> ไม่จำเป็นต้องทบทวนซ้ำ</label>
                </div>
              </div>
            </div>
            <div class="actions">
              <button type="button" class="ghost" onclick="window.location.href=window.location.pathname">รีเซ็ต</button>
              <button type="submit" class="primary">บันทึกข้อมูล</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</body>
</html>