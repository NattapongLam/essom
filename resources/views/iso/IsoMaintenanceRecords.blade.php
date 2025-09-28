<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	 <style>
    body {
      font-family: "Prompt', sans-serif";
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
	.main_tabel{
	 width:1200px;
	 margin:auto;
	}
	.rotated-text {
      
	  writing-mode: vertical-rl;
	  
    }
	
	 .rotated-text {
    writing-mode: vertical-rl;     /* ข้อความแนวตั้ง */
   
    transform: rotate(-180deg);     /* พลิกให้ข้อความหันไปทางซ้าย */
  
    
  }

 .check {
      display: inline-block; /* กำหนดให้แสดงผลเป็นบล็อก */
      transform: rotate(45deg); /* หมุน 45 องศา */
      height: 12px; /* ความสูง */
      width: 6px; /* ความกว้าง */
      border-bottom: 3px solid #000; /* เส้นขอบด้านล่าง */
      border-right: 3px solid #000; /* เส้นขอบด้านขวา */
      /* สามารถปรับค่าต่างๆ เพื่อให้ได้รูปร่างที่ต้องการ */
    }
.checkbox-container {
background-color:#666666;
  display: inline-flex;
  align-items: center;
  cursor: pointer;
  user-select: none;
  gap: 8px;
}

/* ซ่อน checkbox ดั้งเดิม */
.checkbox-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* กล่อง checkbox ใหม่ */
.checkmark {
  width: 10px;
  height: 10px;
  border: 2px solid #000;
  border-radius: 4px;
  background: transparent;
  transition: background 0.2s;
}

/* เมื่อถูกเลือก */
.checkbox-container input:checked + .checkmark {
  background: #000;
}

/* เพิ่มสัญลักษณ์ ✓ */
.checkbox-container input:checked + .checkmark::after {
  content: "✓";
  color: #fff;
  font-size: 8px;
  display: block;
  text-align: center;
  line-height: 22px;
}
 .table_style {
  box-shadow: 2px 2px 10px gray;
   border: 35px  solid white;
  border-radius: 25px;
}	
 
     </style>
</head>
<body class="main_tabel">
     <h2 align="center">ESSOM CO.,LTD.</h2>
     <h2 align="center">บันทึกการบำรุงเครื่องจักร EQUIPMENT MAINTENANCE RECORD </h2>
<form>
<table width="100%" border="1" cellpadding="0" cellspacing="0"class="table_style">
  <tr>
    <td> <table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="150" height="154">รายการบำรุงรักษาเครื่องจักร</td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">1. เปลี่ยนน้ำมันเครื่อง</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">2. เปลี่ยนน้ำยาหล่อลื่น</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">3. เปลี่ยนสายพาน</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">4. ตรวจความตึงสายพาน/โซ่</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">5. ตรวจการทำงานระบบเบรค</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">6. ตรวจการทำงานระบบไฟ</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">7. ตรวจการทำงานทั่วไป</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">8. เป่า/ล้างทำความสะอาดตัวเครื่อง/หัวฉีด</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">9. ตรวจความหลวมของบูชชิ่ง/บานประตู</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">10. อัดจารบี/ลูกปืน</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">11. ตรวจระดับน้ำมัน</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">12. ทำความสะอาดใส้กรองอากาศ</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">13. ตรวจจุดสายไฟ/สายลม</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">14. ตรวจจุดขันข้อต่อ,เกลียวต่างๆ</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">15. สภาพเกจวัดความดัน</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">16. ความถูกต้องของอุณภูมิ/เวลาที่ตั้ง</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">17. ระดับอากาศที่ Manometer</label></td>
    <td width="30" align="center" valign="bottom"><label class="rotated-text">18. ชโลมจารบีที่สลิง/โซ่เฟือง</label></td>
    <td width="80">ผู้ตรวจ/วันที่</td>
    <!-- ยังไม่สมบูรณ์ค่ะ -->
  </tr>
  <tr>
    <td>SB1 ตู้พ่นสีแบบแห้ง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>SB2 ตู่พ่นสีผง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>SB3 ตู้อบสี </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>SB4 เครื่องพ่นสีผง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>SB5 ห้องพ่นสีใหญ่ </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>SB6 ตู้พ่นทราย </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>WE3 เครื่องเชื่อมอาก้อน </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>WE3 เครื่องเชื่อมมิกซ์ </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>WA3 เครื่องเชื่อม Spot </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ML1 เครื่องกลึง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ML2 เครื่องกลึง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ML3 เครื่องกลึง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ML4 เครื่องกลึง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ML5 เครื่องต๊าปเกียวท่อ </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ML6 เครื่องกลึง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ML7 เครื่องกลึง COMP </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MM1 เครื่องมิลลิ่ง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MM2 เครื่องมิลลิ่ง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MM3 เครื่องมิลลิ่ง </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MM4 เครื่องมิลลิ่ง CNC </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MS2 เครื่องตัดแผ่นเหล็ก </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MS5 เครื่องม้วนเหล็กเล็ก </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MD1 แท่นเจาะตั้งพื้น </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MD2 แท่นเจาะตั้งพื้น </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MD3 แท่นเจาะตั้งพื้น </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MD7 แท่นเจาะตั้งพื้น </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MD12 แท่นเจาะตั้งพื้น </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MG5 เครื่องลับดอกสว่าน </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>AC1 ปั้มลม </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>AC2 ปั้มลม </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>AC3 ปั้มลม </td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>


	 

     <p>หมายเหตุ : ลง  <label class="check"></label> 
       ในช่อง <input name="" type="checkbox" value=""> ที่ว่างและลงชื่อผู้ตรวจพร้อมวันที่ เมื่อตรวจและทำตามรายการเรียบร้อย</p>
	   <p>หมายเหตุ : ลง  ป 
       ในช่อง <input name="" type="checkbox" value=""> ที่ว่างและลงชื่อผู้ตรวจพร้อมวันที่ เมื่อทำการเปลี่ยนตามรายการเรียบร้อย</p>
	   <p>ช่อง <label class="checkbox-container"><input type="checkbox"><span class="checkmark"></span></label> คือช่องที่ไม่ต้องตรวจเช็ค</p>
	   
	   
</label>
	   <center>
    <div class="row">
        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary btn-user btn-block btn-sm" name="submit" id="submit">บันทึก</button>
                                            </center>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>

  

