<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>email-registration</title>
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
width: 1200px;
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

   

    .sign-line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        width: 180px;
    }
    
    .small{
      font-size:14px;
      color:var(--muted);
      margin-top:6px;
    }
     .bold-label {
        font-weight: bold;
    }
table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid black;
    margin-top: 15px;
}th, td {
    border: 1px solid black;
    padding: 4px;
    text-align: center;
    vertical-align: middle;
}
th {
    background-color: #e9ecef;
    font-weight: bold;
}
    .actions{
      display:flex;
      gap:12px;
      justify-content:flex-end;
      margin-top:18px;
    }
    .section-line {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    font-size: 16px;
}

</style>
</head>
<body>

  <div class="wrap">
<h2 align="center">ทะเบียนผู้ใช้ Email Account</h2>
<div class="form-container">
     <table>
            <thead>
                <tr>
                <th width="10%">Item</th>
            <th width="40%">Email Account</th>
            <th width="15%">Password</th>
            <th width="10%">User</th>
            <th width="15%">Position</th>
            <th width="12%">Department</th>
            <th width="12%">Approved by</th>
            <th width="2%">Date</th>
            <th width="30%">Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<=30; $i++): ?>
                <tr>
                     <td><input type="text" name="item[<?= $i ?>]" placeholder=""></td>
            <td><input type="text" name="email_account[<?= $i ?>]" placeholder=""></td>
            <td><input type="text" name="password[<?= $i ?>]" placeholder=""></td>
            <td><input type="text" name="user_name[<?= $i ?>]" placeholder=""></td>
            <td><input type="text" name="position[<?= $i ?>]" placeholder=""></td>
            <td><input type="text" name="department[<?= $i ?>]" placeholder=""></td>
            <td><input type="text" name="approved_by[<?= $i ?>]" placeholder=""></td>
            <td><input type="date" name="date[<?= $i ?>]"></td>
            <td><input type="text" name="remark[<?= $i ?>]" placeholder=""></td>
        
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
 <div class="actions">
              <button type="button" class="ghost" onclick="window.location.href=window.location.pathname">รีเซ็ต</button>
              <button type="submit" class="primary">บันทึกข้อมูล</button>
            </div>
</div>
</body>
</html>