<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>computer-records</title>
<style>
    body {
        font-family: "TH Sarabun New", Arial, sans-serif;
        margin: 30px;
        background-color: #f8f9fa;
        font-size: 16px;
    }

    .form-container {
font-family: "Times New Roman", Times, serif;
      margin: 30px auto;   
background: #ffffffff;
padding: 20px 50px;
border-radius: 25px;box-shadow: 2px 2px 10px gray;
width: 1300px;
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
    input[type="text"], input[type="date"], textarea, select{
      width:15%;
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

    .info-row {
        margin: 10px 0;
        font-size: 16px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        border: 1px solid #000;
        text-align: center;
        padding: 6px;
        vertical-align: middle;
    }

    th {
        background-color: #e9ecef;
    }

    .remark {
        margin-top: 15px;
    }

    .remark textarea {
        width: 100%;
        height: 80px;
        border: 1px solid #000;
        padding: 5px;
        resize: none;
    }

    .footer {
        margin-top: 15px;
        text-align: right;
        font-size: 16px;
    }

    .sign-line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        width: 180px;
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

</style>
</head>
<body>
              <h2 align="center">ESSOM CO.,LTD.</h2>
<div class="form-container">
    
     <label >
        การบำรุงรักษาอุปกรณ์ IT (IT Preventive Maintenance) For Asset Number </label>
        <input type="text" name="asset_number">

        User Name <input type="text" name="user_name">
      
        Period <input type="text" name="period">

    <table>
        <thead>
            <tr>
                <th  rowspan="2">Item</th>
                <th   rowspan="2">Maintenance List</th>
                <th colspan="14">Plan</th>
            </tr>
            <tr>
                
                <th>Jan.</th><th>Feb.</th><th>Mar.</th><th>Apr.</th><th>May.</th><th>Jun.</th>
                <th>Jul.</th><th>Aug.</th><th>Sep.</th><th>Oct.</th><th>Nov.</th><th>Dec.</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            $items = [
                "การทําความสะอาดภายในเครื่องคอมพิวเตอร์ทั่วไป",
                "การทําความสะอาด Hard Disk และทําสําเนาข้อมูลที่สําคัญแยกเก็บ",
                "การทําความสะอาด CD / DVD รวมถึงตรวจสอบสภาพแผ่นได้",
                "การทําความสะอาดหัวต่อ USB ทุกอุปกรณ์",
                "การทําความสะอาด UPS และตรวจสอบสภาพแบตเตอรี่ก่อนนำมาใช้งาน",
                "การทําความสะอาด OS ไม่พบการแจ้ง error ต่างๆ บนเครื่อง Desktop",
                "การทําความสะอาดอุปกรณ์ต่างๆ รอบตัวเช่นโต๊ะ เก้าอี้ พื้นไม่สกปรก",
                "การทําความสะอาดเครื่องพิมพ์ ไม่มีกระดาษค้างในเครื่อง",
                "การเปลี่ยน Server ที่มี Username / Password",
                "การทําสําเนาข้อมูลระบบงานหลักไว้ต่างระบบงานฐานข้อมูล",
                "การตรวจสอบระบบ Network ปกติ สามารถเชื่อมต่ออินเทอร์เน็ตได้",
                "การทําความสะอาด Internet Hub",
                "การทําความสะอาด Printer ขนาดเล็ก",
                "การทําความสะอาด Browser ป้องกันไวรัส ตรวจสอบจาก Worm ต่างๆ",
                "การทําความสะอาด E-Mail ใช้งานได้ปกติ",
                "การทําความสะอาดสิทธิ์ในการเข้าถึงแต่ละสิทธิ์",
                "การทําความสะอาดระบบกล้องและสาย ไม่สามารถเกิดสนิมได้",
          
            ];
            foreach($items as $i => $text): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td style="text-align:left;"><?= $text ?></td>
                <?php for($m=1;$m<=12;$m++): ?>
                    <td><input type="checkbox" name="m<?=$i?>_<?=$m?>"></td>
                <?php endfor; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

        Check by <input type="text" name="Check">
        &nbsp;&nbsp;&nbsp;
        Date <input type="date" name="Date_Check">
   

    <div class="remark">
        <b>Remark :</b><br>
        <textarea name="remark"></textarea>
    </div>

  <div class="actions">
              <button type="button" class="ghost" onclick="window.location.href=window.location.pathname">รีเซ็ต</button>
              <button type="submit" class="primary">บันทึกข้อมูล</button>
            </div>
</div>

</body>
</html>