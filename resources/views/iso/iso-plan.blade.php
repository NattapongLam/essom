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

        .main_tabel {
            width: 1200px;
            margin: auto;
        }

        .table_style {
            box-shadow: 2px 2px 10px gray;
            border: 35px solid white;
            border-radius: 25px;
        }
    </style>
</head>

<body class="main_tabel">
    <h2 align="center">ESSOM CO.,LTD.</h2>
    <h2 align="center">PLAN </h2>
    <form>
        <div align="left">Project :
            <input class="input_style2" type="text" name="NamePJ" required>
            Responsible Section / Person :
            <input class="input_style2" type="text" name="RS" required>
        </div>

        <br />
        <table width="100%" border="1" cellpadding="0" cellspacing="0" class="table_style">
            <tr>
                <td>
                    <table width="100%" height="704" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="4%" rowspan="2" align="center">No.</td>
                            <td width="38%" rowspan="2" align="center">Description of Activitions </td>
                            <td width="6%" rowspan="2" align="center">
                                <p>Resp. </p>
                                <p>Person </p>
                            </td>
                            <td height="28" colspan="2" align="center">Date</td>
                            <td width="11%" align="center">STATUS</td>
                            <td width="24%" align="center">Progress Report/Remarks</td>
                        </tr>
                        <tr>
                            <td width="8%" align="center">Start</td>
                            <td width="9%" align="center">Finish</td>
                            <td align="center">Result</td>
                            <td align="center">&nbsp;</td>
                        </tr>
                        <tr> <!-- 2-->
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA1">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="Rp1">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date1">
                                </span></td>
                            <td><span class="form-group">
                                <input class="input_style3" type="date" name="date2">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS1">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP2">
                                </span></td> 
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA2">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP2">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date3">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date4">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS2">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP3">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA3">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP4">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date5">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date6">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS3">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP5">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA4">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP6">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date7">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date8">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS4">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP7">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA5">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP8">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date9">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date10">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS5">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP9">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA6">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP10">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date11">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date12">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS6">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP11">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA7">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP12">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date13">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date14">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS7">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP13">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA8">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP14">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date15">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date16">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS8">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP15">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA9">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP16">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date17">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date18">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS9">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP17">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA10">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP18">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date19">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date20">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS10">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP19">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA11">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP20">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date21">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date22">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS11">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP21">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA12">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP22">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date23">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date24">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS12">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP23">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA13">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP24">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date25">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date26">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS13">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP25">
                                </span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="DA14">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style4" type="text" name="RP26">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date27">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="date" name="date28">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style3" type="text" name="RS14">
                                </span></td>
                            <td><span class="form-group">
                                    <input class="input_style" type="text" name="RP27">
                                </span></td>
                        </tr>
                        <tr>
                            
                        </tr>
                    </table>
                </td>
            </tr>
        </table>


        <p>&nbsp;</p>
        <button type="submit">ส่งข้อมูล</button>
    </form>
</body>

</html>