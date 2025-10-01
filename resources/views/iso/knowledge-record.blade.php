
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>knowledgeRecord</title>
<style>
body {
     font-family: "Times New Roman", Times, serif;
            margin: 30px;
background: #f9f9f9ff;
display: flex;
justify-content: center;
align-items: flex-start;
min-height: 100vh;
padding: 40px;
}
   .signature-pad {
      border: 2px solid #ccc;
      width: 400px;
      height: 150px;
      position: relative;
      cursor: crosshair;
    }
    .btns {
      margin-top: 10px;
    }
.radio-group {
    display: flex;
    gap: 20px; /* ช่องว่างระหว่าง radio แต่ละตัว */
    align-items: center;
    font-family: sans-serif;   
  }

  .radio-group label {
    display: flex;
    align-items: center;
    gap: 5px; /* ช่องว่างระหว่างปุ่มกับข้อความ */
    cursor: pointer;
    white-space: nowrap; 
    
  }

  .radio-group input[type="radio"] {
    transform: scale(1.1); /* ขยายปุ่มเล็กน้อย */
    cursor: pointer;
  }
.form-container {
font-family: "Times New Roman", Times, serif;
   margin: 30px;
background: #ffffffff;
padding: 20px 50px;
border-radius:25px;box-shadow: 2px 2px 10px gray;
width: 900px;
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
 .input_style3 {
            width: 16%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
         .input_style4 {
            width: 81%;
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
            width:95%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }

.input_style2 {
            width:10%;
            padding: 8px;
          
            border-radius: 5px;
        }
        .input_style6 {
            width:90%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
.radio-group {
margin-top: 10px;
display: flex;
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


</style>
</head>

<body class="main_tabel">
   <form>
    <h2 align="center">ESSOM CO.,LTD.</h2>
    <h2 align="center">ใบบันทึกความรู้องค์กร </h2>  
<h2 align="center">บึกทึกความรู้องค์กร</h2>
<form >
<div class="form-container">  
<div align="left"><br />จัดทำโดย :
            <input class="input_style3" type="text" name="Name" required>
          หน่วยงาน :
            <input class="input_style3" type="text" name="department" required> 
            ตำแหน่ง :
            <input class="input_style3" type="text" name="position" required>
  วันที่ :
            <input class="input_style2" type="date" name="request_date" required>
</div>
<br>
<div align="left">เอกสารKM เลขที่:  <input class="input_style4" type="text" name="documentKM_no" required>
  <br>
  <br>
  <div align="left">1.1)ความรู้องค์กรด้าน :
            <input class="input_style3" type="text" name="OZN" required>
         <span style="margin-left: 30px;">เอกสาร NCR/CAR/คำร้องเรียนเลขที่:</span>
            <input class="input_style3" type="text" name="document_no" required> 
            <br>
            <br>
    <div align="left">   เรื่อง :
            <input  class="input_style6" type="text" name="subject" required>      

<label>1.3)รายละเอียดของความรู้</label>
<textarea class="input_style5" name="details" rows="8"></textarea>
<br><br>
 <span style="margin-left: 7px;">เอกสารแนบ:</span>
        <input type="file" name="attachedFile" accept=".pdf,.doc,.docx,.jpg,.png">
<label for="">หมายเหตุ:
เอกสารแนบของบันทึกความรู้องค์กรที่มาจาก NCR/CAR/คำร้องเรียน ให้ไปดูที่แฟ้ม NCR/CAR/คำร้องเรียนนั้นๆ
<div class="radio-group">
  <label>การประเมินหัวข้อความรู้นี้โดยหัวหน้างาน</label>
  <label><input type="radio" name="approval" value="อนุมัติ"> อนุมัติ</label>
  <label><input type="radio" name="approval" value="ไม่อนุมัติ"> ไม่อนุมัติ</label>
  <label><input type="radio" name="approval" value="รอพิจรณา"> รอพิจารณา</label>
  <label><input type="radio" name="approval" value="เก็บไว้พิจรณาภายหลัง"> เก็บไว้พิจารณาภายหลัง</label>
</div>
<div align="left"><br />
  <label>กำหนดวันส่งต่อ-ถ่ายทอดองค์กรความรู้<span style="margin-left: 30px;">วันที่:</span> 
            <input class="input_style2" type="date" name="date" required> </label>   
<center> อนุมัติโดย:
            <input class="input_style3" type="text" name="NameCF" required>
         <span style="margin-left: 30px;">วันที่:</span>
            <input class="input_style2" type="date" name="Date" required> 
            </center>
    </span></td>
    </div>
    
 </form>
        <p>&nbsp;</p>
       <button type="submit" >ส่งข้อมูล</button>
    
</body>
</html>