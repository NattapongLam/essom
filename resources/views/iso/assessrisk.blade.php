<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>assessrisk-swot</title>
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
    .form-group {
      margin-bottom: 5px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    .input_style {
      width: 55%;
      padding: 8px;
      border: 1px solid #aaa;
      border-radius: 5px;
    }
	.input_style2 {
      width: 15%;
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
      border-radius: 5px;}
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

     .input_style1 {      width: 55%;
      padding: 8px;
      border: 1px solid #aaa;
      border-radius: 5px;
}
.input_style31 {      width: 85%;
      padding: 8px;
      border: 1px solid #aaa;
      border-radius: 5px;
}
.input_style41 {      width: 70%;
      padding: 8px;
      border: 1px solid #aaa;
      border-radius: 5px;
}
.table_style {
  box-shadow: 2px 2px 10px gray;
   border: 30px solid white;
  border-radius: 25px;
}
.highlight 
    font-weight: bold;
    text-decoration: underline;
  
    .wrap{
      width:100%;
      max-width:980px;
      margin:20px auto;
    }
     </style>
</head>
<body >
  <center>
   <div class="wrap">
     <h2 align="center">การประเมินความเสี่ยงและโอกาส</h2>
     
<form>
	 <div align="center">ความเสี่ยงที่ 1 อ้างอิงจาก กระบวนการ / ระเบียบปฏิบัติการ / วิธีปฏิบัติ : 
	   <input class="input_style2" type="text" name="name" required>
	 เสนอโดย : 
	 <input class="input_style2" type="text" name="name2" required>
	 วันที่ : 
	 <input class="input_style2" type="date" name="name3" required>
  
     </div>
	<br/> 
<table width="1200" border="0" cellpadding="0" cellspacing="0" class="table_style">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr >
        <td colspan="2"><div class="form-group"> <strong>ประเด็นความเสี่ยง</strong> :
          <input  class="input_style41" type="text" name="name4" required>
          </div>
            <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
              <input  class="input_style1" type="text" name="name5" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="name6" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="name7" required>
          </div></td>
        <td colspan="2" valign="top"><table width="100%" height="181" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="154"><div align="center">ก่อนประเมิน</div></td>
              <td width="50" align="center">I</td>
              <td width="50" align="center">L</td>
              <td width="50" align="center">Level</td>
              <td width="50" align="center">Result</td>
              <td width="50" align="center">By</td>
              <td width="50" align="center">Date</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 1 </div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 2</div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 3 </div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="42%"><strong>มาตรการลดความเสี่ยงและแารติดตาม</strong>
            <div class="form-group"> 1)
              <input  class="input_style31" type="text" name="name8" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="name9" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="name10" required>
          </div></td>
        <td width="17%" valign="top"><table width="100%" height="149" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">รับทราบโดย/วันที่</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
        <td width="28%"><div class="form-group"> การติดตาม
          <input  class="input_style1" type="text" name="name11" required>
          </div>
            <div class="form-group"> การติดตาม
              <input  class="input_style1" type="text" name="name12" required>
            </div>
          <div class="form-group"> การติดตาม
            <input  class="input_style1" type="text" name="name13" required>
          </div></td>
        <td width="13%"><table width="100%" height="149" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">รับทราบโดย/วันที่</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td> สรุปผลการดำเนินการ</strong>
            <div class="form-group"> 1)
              <input  class="input_style31" type="text" name="name14" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="name15" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="name16" required>
          </div></td>
        <td><table width="100%" height="149" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">อนุมัติ/วันที่</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
        <td colspan="2"><table width="100%" height="147" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="154"><div align="center">ก่อนประเมิน</div></td>
              <td align="center">I</td>
              <td align="center">L</td>
              <td align="center">Level</td>
              <td align="center">Result</td>
              <td align="center">By</td>
              <td align="center">Date</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 1 </div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 2</div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 3 </div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>


<!-- Table 2-->
<br/><br/>

<div align="center">ความเสี่ยงที่ 2 อ้างอิงจาก กระบวนการ / ระเบียบปฏิบัติการ / วิธีปฏิบัติ : 
	   <input class="input_style2" type="text" name="name17" required>
	 เสนอโดย : 
	 <input class="input_style2" type="text" name="name18" required>
	 วันที่ : 
	 <input class="input_style2" type="date" name="name19" required>
  
     </div>
	<br/> 
  <div class="table_style" >
<table width="1200" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr >
        <td colspan="2"><div class="form-group"> <strong>ประเด็นความเสี่ยง</strong> :
          <input  class="input_style41" type="text" name="name20" required>
          </div>
            <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
              <input  class="input_style1" type="text" name="name21" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="name22" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="name23" required>
          </div></td>
        <td colspan="2" valign="top"><table width="100%" height="181" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="154"><div align="center">ก่อนประเมิน</div></td>
              <td width="50" align="center">I</td>
              <td width="50" align="center">L</td>
              <td width="50" align="center">Level</td>
              <td width="50" align="center">Result</td>
              <td width="50" align="center">By</td>
              <td width="50" align="center">Date</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 1 </div></td>
               <td><input type="text" name="before_eval1_I" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval1_L" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval1_level" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval1_result" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval1_by" style="width:100%; text-align:center;"></td>
      <td><input type="date" name="before_eval1_date" style="width:100%; text-align:center;"></td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 2</div></td>
             <td><input type="text" name="before_eval2_I" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval2_L" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval2_level" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval2_result" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval2_by" style="width:100%; text-align:center;"></td>
      <td><input type="date" name="before_eval2_date" style="width:100%; text-align:center;"></td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 3 </div></td>
              <td><input type="text" name="before_eval3_I" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval3_L" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval3_level" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval3_result" style="width:100%; text-align:center;"></td>
      <td><input type="text" name="before_eval3_by" style="width:100%; text-align:center;"></td>
      <td><input type="date" name="before_eval3_date" style="width:100%; text-align:center;"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="42%"><strong>มาตรการลดความเสี่ยงและแารติดตาม</strong>
            <div class="form-group"> 1)
              <input  class="input_style31" type="text" name="name24" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="name25" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="name26" required>
          </div></td>
        <td width="17%" valign="top"><table width="100%" height="149" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">รับทราบโดย/วันที่</td>
             <tr>
    <td align="center">
      <input type="text" name="ack_by1" placeholder="ชื่อผู้รับทราบ" style="width: 60%; text-align: center;">
      <input type="date" name="ack_date1" style="width: 35%; text-align: center;">
    </td>
  </tr>

  <tr>
    <td align="center">
      <input type="text" name="ack_by2" placeholder="ชื่อผู้รับทราบ" style="width: 60%; text-align: center;">
      <input type="date" name="ack_date2" style="width: 35%; text-align: center;">
    </td>
  </tr>

  <tr>
    <td align="center">
      <input type="text" name="ack_by3" placeholder="ชื่อผู้รับทราบ" style="width: 60%; text-align: center;">
      <input type="date" name="ack_date3" style="width: 35%; text-align: center;">
    </td>
  </tr>
        </table></td>
        <td width="28%"><div class="form-group"> การติดตาม
          <input  class="input_style1" type="text" name="name27" required>
          </div>
            <div class="form-group"> การติดตาม
              <input  class="input_style1" type="text" name="name28" required>
            </div>
          <div class="form-group"> การติดตาม
            <input  class="input_style1" type="text" name="name29" required>
          </div></td>
        <td width="13%"><table width="100%" height="149" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">รับทราบโดย/วันที่</td>
            </tr>
            <td align="center">
      <input type="text" name="ack_by1" placeholder="ชื่อผู้รับทราบ" style="width: 60%; text-align: center;">
      <input type="date" name="ack_date1" style="width: 35%; text-align: center;">
    </td>
  </tr>

  <tr>
    <td align="center">
      <input type="text" name="ack_by2" placeholder="ชื่อผู้รับทราบ" style="width: 60%; text-align: center;">
      <input type="date" name="ack_date2" style="width: 35%; text-align: center;">
    </td>
  </tr>

  <tr>
    <td align="center">
      <input type="text" name="ack_by3" placeholder="ชื่อผู้รับทราบ" style="width: 60%; text-align: center;">
      <input type="date" name="ack_date3" style="width: 35%; text-align: center;">
        </table></td>
      </tr>
      <tr>
        <td> สรุปผลการดำเนินการ</strong>
            <div class="form-group"> 1)
              <input  class="input_style31" type="text" name="name30" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="name31" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="name32" required>
          </div></td>
        <td><table width="100%" height="149" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">อนุมัติ/วันที่</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
        <td colspan="2"><table width="100%" height="147" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="154"><div align="center">ก่อนประเมิน</div></td>
              <td align="center">I</td>
              <td align="center">L</td>
              <td align="center">Level</td>
              <td align="center">Result</td>
              <td align="center">By</td>
              <td align="center">Date</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 1 </div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 2</div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
            <tr>
              <td width="154"><div align="center">ครั้งที่ 3 </div></td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
              <td width="50">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
</table>

  <div class="actions">
              <button type="button" class="ghost" onclick="window.location.href=window.location.pathname">รีเซ็ต</button>
              <button type="submit" class="primary">บันทึกข้อมูล</button>
            </div>
</form>
</div>
</center>
</body>
</html>

