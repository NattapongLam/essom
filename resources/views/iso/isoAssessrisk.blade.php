<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	 <style>
    body {
      font-family: "Times New Roman", Times, serif;
      margin: 30px;
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
	.main_tabel{
	 width:1200px;
	 margin:auto;
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
     </style>
</head>
<body class="main_tabel">
     <h2 align="center">การประเมินความเสี่ยงและโอกาส</h2>
<form>
	 <div align="center">ความเสี่ยงที่ 1 อ้างอิงจาก กระบวนการ / ระเบียบปฏิบัติการ / วิธีปฏิบัติ : 
	   <input class="input_style2" type="text" name="txt1" required>
	 เสนอโดย : 
	 <input class="input_style2" type="text" name="txt2" required>
	 วันที่ : 
	 <input class="input_style2" type="date" name="date" required>
  
     </div>
	<br/> 
<table width="1200" border="0" cellpadding="0" cellspacing="0" class="table_style">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr >
        <td colspan="2"><div class="form-group"> <strong>ประเด็นความเสี่ยง</strong> :
          <input  class="input_style41" type="text" name="txt3" required>
          </div>
            <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
              <input  class="input_style1" type="text" name="txt4" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="date" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="txt5" required>
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
        <td width="42%"><strong>มาตรการลดความเสี่ยงและการติดตาม</strong>
            <div class="form-group"> 1)
              <input  class="input_style31" type="text" name="txt6" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="txt7" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="txt8" required>
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
          <input  class="input_style1" type="text" name="txt9" required>
          </div>
            <div class="form-group"> การติดตาม
              <input  class="input_style1" type="text" name="txt10" required>
            </div>
          <div class="form-group"> การติดตาม
            <input  class="input_style1" type="text" name="txt11" required>
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
              <input  class="input_style31" type="text" name="txt12" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="txt13" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="txt14" required>
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
	   <input class="input_style2" type="text" name="txt15" required>
	 เสนอโดย : 
	 <input class="input_style2" type="text" name="txt16" required>
	 วันที่ : 
	 <input class="input_style2" type="date" name="date" required>
  
     </div>
	<br/> 
<table width="1200" border="0" cellpadding="0" cellspacing="0" class="table_style">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr >
        <td colspan="2"><div class="form-group"> <strong>ประเด็นความเสี่ยง</strong> :
          <input  class="input_style41" type="text" name="txt17" required>
          </div>
            <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
              <input  class="input_style1" type="text" name="txt18" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="txt19" required>
            </div>
          <div class="form-group"> เหตุผลการยอมรับ / ไม่ยอมรับความเสี่ยง :
            <input  class="input_style1" type="text" name="txt20" required>
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
              <input  class="input_style31" type="text" name="txt21" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="txt22" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="txt23" required>
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
          <input  class="input_style1" type="text" name="txt24" required>
          </div>
            <div class="form-group"> การติดตาม
              <input  class="input_style1" type="text" name="txt25" required>
            </div>
          <div class="form-group"> การติดตาม
            <input  class="input_style1" type="text" name="txt26" required>
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
              <input  class="input_style31" type="text" name="txt27" required>
            </div>
          <div class="form-group"> 2)
            <input  class="input_style31" type="text" name="txt28" required>
            </div>
          <div class="form-group"> 3)
            <input  class="input_style31" type="text" name="txt29" required>
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


  <p>&nbsp;</p>
  <button type="submit">ส่งข้อมูล</button>
</form>
</body>
</html>

