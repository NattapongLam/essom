<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>machine Record</title>
    <style>
        body {
              font-family: "Times New Roman", Times, serif;
      margin: 30px;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;}
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
h2 {
text-align: center;
margin-bottom: 25px;
}

label {
font-weight: bold;
display: block;
margin-top: 15px;
margin-bottom: 5px;
padding: 5px;
}
.input_style1{
            width: 90%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
}
.input_style2 {
            width: 38%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
 .input_style3 {
            width: 16%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
         .input_style4 {
            width:10%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
input, textarea {
width: 20%;
padding: 5px;
border: 1px solid #ccc;
border-radius: 8px;
font-size: 14px;
}
  .main_tabel {
            width: 1200px;
            margin: auto;
            text-align: center;
            
        }
        
.input_style5 {
            width : 98%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }

 .input_style4 {
            width: 60%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px; border-radius: 5px;
        }
        .input_style6 {
            width:30%;
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

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 15px;
        }

        .info label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        table {
            width: 100%;
         border: 3px solid #aaa;
            margin-bottom: 5px;
            
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .note {
            margin-top: 20px;
        }

        .note label {
            font-weight: bold;
        }

        textarea {
            width: 100%;
            height: 80px;
            border: 1px solid #333;
            border-radius: 5px;
            padding: 6px;
        }
    </style>
</head>
<body>

<form>
    <h2 align="center">ESSOM CO.,LTD.</h2>
    <h2 align="center">ประวัติเครื่องจักร EQUIPMENT RECORD </h2>  

<div class="form-container">

        <div align="center"><br />ชื่อเครื่องจักร  :
            <input class="input_style6" type="text" name="machine_name" required>
         <span style="margin-left: 30px;"> หมายเลข : </span>
            <input class="input_style6" type="text" name="machine_number" required> 
    </div>
<div align="center"><br />วันที่เริ่มใช้ :
            <input class="input_style3" type="date" name="date_start" required>
          <span style="margin-left: 30px;"> หน่วยงานที่รับผิดชอบ:</span> 
            <input class="input_style2" type="" name="" required>
    </div>
<br><br>
    <table  >
        <thead >
            <tr>
                <th style="width 30%; "  >วัน/เดือน/ปี</th>
                <th style="width: 76%;">รายการซ่อม/เปลี่ยน</th>
                <th style="width: 30%;" >ผู้ซ่อม</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<20; $i++): ?>
            <tr>
                <td ><span class="form-group">
                                    <input class="input_style4" type="date" name="repair_date_<?php echo $i; ?>">
                                </span></td>
                <td><span class="form-group">
                                    <input class="input_style5" type="text" name="repair_description_<?php echo $i; ?>">
                                </span></td>
                <td><span class="form-group">
                                    <input class="input_style1" type="text" name="repair_person_<?php echo $i; ?>">
                                </span></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
 <label>หมายเหตุ: </label>
<textarea class="input_style5" name="details" rows="8"></textarea>
    </div>
       <p>&nbsp;</p>
        <button type="submit">ส่งข้อมูล</button>
    </form>
</div>

     
</body>
</html>