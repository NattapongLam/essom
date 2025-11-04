@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body { font-family: "Prompt", "Tahoma", sans-serif; background: linear-gradient(135deg, #e3f2fd, #ffffff); margin: 0; padding: 0; color: #333; }
.form-container { background: #ffffff; border-radius: 12px; padding: 20px; max-width: 100%; margin: 0 auto; box-shadow: 0 6px 20px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; box-sizing: border-box; }
h2 { text-align: center; color: #0f172a; font-size: 24px; font-weight: 700; margin-bottom: 20px; }
input, textarea, select { border: 1px solid #94a3b8; border-radius: 6px; padding: 6px 10px; font-size: 14px; box-sizing: border-box; background-color: #f8fafc; transition: 0.2s; }
input:focus, textarea:focus { border-color: #010101; box-shadow: 0 0 6px rgba(59,130,246,0.3); background-color: #ffffff; outline: none; }
.checkbox-inline { display: flex; align-items: center; gap: 10px; font-weight: 600; }
textarea { width: 100%; min-height: 120px; resize: vertical; }
.section { margin-bottom: 20px; }
.flex-row { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
.flex-row label { min-width: 120px; font-weight: 600; color: #000; }
.flex-row input, .flex-row select, .flex-row textarea { flex: 1 1 150px; }
.checkbox-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px; }
.signature { display: flex; gap: 20px; flex-wrap: wrap; }
.signature .flex-row { flex: 1; min-width: 250px; }
button { background: linear-gradient(180deg, #1e3a8a, #3b82f6); color: #fff; border: none; padding: 10px 25px; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; }
button:hover { transform: scale(1.05); }
@media (max-width: 768px) { .flex-row { flex-direction: column; align-items: flex-start; } .flex-row label { width: 100%; margin-bottom: 5px; } .signature { flex-direction: column; } }
</style>
<div class="form-container">
  <h2>แสดงประวัติคอมพิวเตอร์</h2>

  <form action="{{ route('computer-history.update', $history->id) }}" method="POST">
    @csrf
    @method('PUT')
 <div class="section flex-row">
        <label>1) User Name:</label>
        <input type="text" id="user_name" value="{{ $history->user_name }}" disabled>
        <label>No.</label>
        <input type="text" value="{{ $history->no_number }}" disabled>
        <label>Starting Date:</label>
        <input type="date" value="{{ $history->start_date }}" disabled>
    </div>

  <div class="section">
    <label>2) Computer Type:</label>
    <div class="checkbox-group">
      <label><input type="checkbox" {{ $history->type_pc ? 'checked' : '' }} disabled> PC</label>
      <label><input type="checkbox" {{ $history->type_notebook ? 'checked' : '' }} disabled> Notebook</label>
    </div>
  </div>

  <div class="section flex-row">
    <label>3) CPU / Spec:</label>
    <input type="text" value="{{ $history->cpu_spec }}" disabled>
  </div>

  <div class="section">
    <label>4) RAM:</label>
    <div class="checkbox-group">
      <label><input type="checkbox" {{ $history->ram_ddr1 ? 'checked' : '' }} disabled> DDR I</label>
      <label><input type="checkbox" {{ $history->ram_ddr2 ? 'checked' : '' }} disabled> DDR II</label>
      <label><input type="checkbox" {{ $history->ram_ddr3 ? 'checked' : '' }} disabled> DDR III</label>
    </div>
  </div>

  <div class="section flex-row">
    <label>DIMM 1:</label>
    <input type="text" value="{{ $history->dimm1 }}" disabled>
    <label>Warranty Date:</label>
    <input type="date" value="{{ $history->dimm1_warranty }}" disabled>
    <label>Exp:</label>
    <input type="date" value="{{ $history->dimm1_exp }}" disabled>
  </div>

  <div class="section flex-row">
    <label>DIMM 2:</label>
    <input type="text" value="{{ $history->dimm2 }}" disabled>
    <label>Warranty Date:</label>
    <input type="date" value="{{ $history->dimm2_warranty }}" disabled>
    <label>Exp:</label>
    <input type="date" value="{{ $history->dimm2_exp }}" disabled>
  </div>

  <div class="section flex-row">
    <label>Other:</label>
    <input type="text" value="{{ $history->ram_other }}" disabled>
  </div>

  <div class="section flex-row">
    <label>5) Hard Disk:</label>
    <label><input type="checkbox" {{ $history->hd_ide ? 'checked' : '' }} disabled> IDE</label>
    <label><input type="checkbox" {{ $history->hd_sata ? 'checked' : '' }} disabled> SATA</label>
    <label><input type="checkbox" {{ $history->hd_sas ? 'checked' : '' }} disabled> SAS</label>
    <label><input type="checkbox" {{ $history->hd_other ? 'checked' : '' }} disabled> Other</label>
    <label>Qty:</label>
    <input type="number" value="{{ $history->hd_qty }}" disabled style="width:80px;">
  </div>

  <div class="section flex-row">
    <label>Disk 1:</label>
    <input type="text" value="{{ $history->disk1 }}" disabled>
    <label>Warranty Date:</label>
    <input type="date" value="{{ $history->disk1_warranty }}" disabled>
    <label>Exp:</label>
    <input type="date" value="{{ $history->disk1_exp }}" disabled>
  </div>

  <div class="section flex-row">
    <label>Disk 2:</label>
    <input type="text" value="{{ $history->disk2 }}" disabled>
    <label>Warranty Date:</label>
    <input type="date" value="{{ $history->disk2_warranty }}" disabled>
    <label>Exp:</label>
    <input type="date" value="{{ $history->disk2_exp }}" disabled>
  </div>

  <div class="section flex-row">
    <label>External Disk Drive:</label>
    <input type="text" value="{{ $history->external_disk }}" disabled>
  </div>

<div class="section">
  <label>6) CD / DVD:</label>
  <div class="checkbox-group">
    <label><input type="checkbox" {{ $history->cd_ide ? 'checked' : '' }} disabled> IDE</label>
    <label><input type="checkbox" {{ $history->cd_sata ? 'checked' : '' }} disabled> SATA</label>
  </div>
</div>

<div class="section flex-row">
  <label>Qty:</label>
  <input type="number" value="{{ $history->cd_qty }}" disabled>
</div>

<div class="section flex-row">
  <label>Drive 1:</label>
  <input type="text" value="{{ $history->cd_drive1 }}" disabled>
  <label>Warranty Date:</label>
  <input type="date" value="{{ $history->cd1_warranty }}" disabled>
  <label>Exp:</label>
  <input type="date" value="{{ $history->cd1_exp }}" disabled>
</div>

<div class="section flex-row">
  <label>Drive 2:</label>
  <input type="text" value="{{ $history->cd_drive2 }}" disabled>
  <label>Warranty Date:</label>
  <input type="date" value="{{ $history->cd2_warranty }}" disabled>
  <label>Exp:</label>
  <input type="date" value="{{ $history->cd2_exp }}" disabled>
</div>

<div class="section flex-row">
  <label>External CD/DVD Drive:</label>
  <input type="text" value="{{ $history->external_cd }}" disabled>
</div>

<div class="section flex-row">
  <label>7)Main Board/Spec:</label>
  <input type="text" value="{{ $history->main_board_spec }}" disabled>
</div>
  <div class="section flex-row">
    <label>IDE Port:</label>
    <input type="text" value="{{ $history->mb_ide_port }}" disabled>
    <label>SATA Port:</label>
    <input type="text" value="{{ $history->mb_sata_port }}" disabled>
    <label>USB Port:</label>
    <input type="text" value="{{ $history->mb_usb_port }}" disabled>
  </div>

  <div class="section flex-row">
    <label>8)VGA:</label>
    <label><input type="checkbox" {{ $history->vga_onboard ? 'checked' : '' }} disabled> Onboard</label>
    <label><input type="checkbox" {{ $history->vga_display ? 'checked' : '' }} disabled> Display Card</label>
    <label><input type="checkbox" {{ $history->vga_pci ? 'checked' : '' }} disabled> PCI</label>
    <label><input type="checkbox" {{ $history->vga_pcie ? 'checked' : '' }} disabled> PCIE</label>
    <label>Brand / Spec:</label>
    <input type="text" value="{{ $history->vga_spec }}" disabled>
  </div>

  <div class="section flex-row">
    <label>9)LAN / Wireless:</label>
    <label><input type="checkbox" {{ $history->lan_onboard ? 'checked' : '' }} disabled> Onboard</label>
    <label><input type="checkbox" {{ $history->lan_usb ? 'checked' : '' }} disabled> USB Wireless</label>
    <label><input type="checkbox" {{ $history->lan_card ? 'checked' : '' }} disabled> LAN Card</label>
    <label><input type="checkbox" {{ $history->lan_pci ? 'checked' : '' }} disabled> PCI</label>
    <label><input type="checkbox" {{ $history->lan_pcie ? 'checked' : '' }} disabled> PCIE</label>
    <label>Brand / Spec:</label>
    <input type="text" value="{{ $history->lan_spec }}" disabled>
  </div>

  <div class="section flex-row">
    <label>10)Power Supply:</label>
    <label><input type="checkbox" {{ $history->psu_ide ? 'checked' : '' }} disabled> IDE Plug</label>
    <label><input type="checkbox" {{ $history->psu_sata ? 'checked' : '' }} disabled> SATA Plug</label>
    <label>Watt:</label>
    <input type="text" value="{{ $history->psu_watt }}" disabled>
    <label>Result:</label>
    <input type="text" value="{{ $history->psu_result }}" disabled>
  </div>

  <div class="section flex-row">
    <label>11)Monitor Brand / Spec:</label>
    <input type="text" value="{{ $history->monitor_spec }}" disabled>
  </div>

  <div class="section flex-row">
    <label>12)Accessory:</label>
    <input type="text" value="{{ $history->accessory }}" disabled>
  </div>

  <div class="section flex-row">
    <label>Mouse:</label>
    <input type="text" value="{{ $history->mouse }}" disabled>
    <label>Keyboard:</label>
    <input type="text" value="{{ $history->keyboard }}" disabled>
    <label>Sound Card:</label>
    <input type="text" value="{{ $history->sound_card }}" disabled>
  </div>

  <div class="section flex-row">
    <label>Drive A:</label>
    <input type="text" value="{{ $history->drive_a }}" disabled>
    <label>Card:</label>
    <input type="text" value="{{ $history->card }}" disabled>
    <label>Speaker:</label>
    <input type="text" value="{{ $history->speaker }}" disabled>
  </div>

  <div class="section flex-row">
    <label>Other:</label>
    <input type="text" value="{{ $history->accessory_other }}" disabled>
  </div>

<label>Software license:</label>
  <div class="section flex-row">
    <label>Operating Software:</label>
    <input type="text" value="{{ $history->os }}" disabled>
    <label>Office:</label>
    <input type="text" value="{{ $history->office }}" disabled>
    <label>Other :</label>
    <input type="text" value="{{ $history->software_other }}" disabled>
  </div>

  <div class="section">
    <label>Problem / Maintenance:</label>
    <textarea disabled>{{ $history->problem }}</textarea>
  </div>
   <div class="section signature">
        <div class="flex-row">
            <label>Check by:</label>
            <input type="text" value="{{ $history->check_by }}" disabled>
            <label>Date:</label>
            <input type="date" value="{{ $history->check_date }}" disabled>
        </div>
        <div class="flex-row">
            <label>Acknowledged by:</label>
            <input type="text" name="ack_by" value="{{ old('ack_by', $history->ack_by) }}">
            <label>Date:</label>
            <input type="date" name="ack_date" value="{{ old('ack_date', $history->ack_date) }}">
        </div>
    </div>
<center>
    <div class="actions" style="margin-top:20px;">
        <button type="submit">บันทึก</button>
        <a href="{{ route('computer-history.index') }}" class="secondary">กลับไปหน้ารายการ</a>
    </div>
    </center>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById("exportBtn");
    if(btn){
        btn.addEventListener("click", function() {
            const wb = XLSX.utils.book_new();
            const ws_data = [];
            document.querySelectorAll(".form-container .section").forEach(section => {
                const sectionData = [];
                section.querySelectorAll("label").forEach(label => sectionData.push(label.innerText.trim()));
                section.querySelectorAll("input, textarea").forEach(input => {
                    if (input.type === "checkbox") sectionData.push(input.checked ? "✔" : "✖");
                    else sectionData.push(input.value || "");
                });
                if (sectionData.length) ws_data.push(sectionData);
            });
            if (!ws_data.length) { alert("ไม่พบข้อมูลสำหรับส่งออก"); return; }
            const ws = XLSX.utils.aoa_to_sheet(ws_data);
            XLSX.utils.book_append_sheet(wb, ws, "Computer History");
            const userName = document.getElementById("user_name")?.value || "Computer_History";
            XLSX.writeFile(wb, `${userName}_Computer_History.xlsx`);
        });
    }
});
</script>

@endsection