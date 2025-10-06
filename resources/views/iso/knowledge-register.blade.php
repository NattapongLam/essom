<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>knowledge-register</title>
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
width: 900px;
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
      width:100%;
      padding:10px 12px;
      border-radius:10px;
      border:1px solid rgba(15,23,42,0.08);
      background: linear-gradient(180deg, #fff, #fbfcff);
      font-size:14px;
      outline:none;
      transition: box-shadow .16s, border-color .16s, transform .08s;
    }
    input[type="text"], input[type="date"] {
        width: 70%;
        border: 1px solid transparent;  
        border-radius: 6px;
        font-size: 14px;
        padding: 3px;
        text-align: center;
        background-color: transparent;
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
</style>
</head>
<body>

              <h2 align="center">ESSOM CO.,LTD.</h2>
        <h2 align="center">บริษัท เอสซอม จำกัด</h2>
         <h2 align="center">ทะเบียนความรู้องค์กร (Organization Registration)</h2>
    <div class="form-container">
    

    <form >
        <table>
            <thead>
                <tr>
                   <th style="width: 3%;">รหัสเอกสาร</th>
                    <th style="width: 3%;">วันที่รับเอกสาร</th>
                    <th style="width: 30%;">ชื่อเรื่ององค์กรความรู้</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<=30; $i++): ?>
                <tr>
                    <td><input type="text" name="document_code<?php echo $i; ?>" placeholder=""></td>
                    <td><input type="date" name="date_<?php echo $i; ?>"></td>
                    <td><input type="text" name="doc_title<?php echo $i; ?>" placeholder=""></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

       <div class="actions">
              <button type="button" class="ghost" onclick="window.location.href=window.location.pathname">รีเซ็ต</button>
              <button type="submit" class="primary">บันทึกข้อมูล</button>
            </div>
    </form>
</div>

</body>
</html>