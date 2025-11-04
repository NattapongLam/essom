@extends('layouts.main')
@section('content')
<style>
body {
  font-family: "Prompt", "Tahoma", sans-serif;
  background: linear-gradient(135deg, #e3f2fd, #ffffff);
  margin: 0;
  padding: 0;
  color: #333;
}

.form-container {
  background: #ffffff;
  border-radius: 12px;
  padding: 20px;
  max-width: 100%;
  margin: 0 auto;
  box-shadow: 0 6px 20px rgba(0,0,0,0.08);
  border: 1px solid #e0e0e0;
  box-sizing: border-box;
}

h2 {
  text-align: center;
  color: #0f172a;
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 20px;
}

input, textarea, select {
  border: 1px solid #94a3b8;
  border-radius: 6px;
  padding: 6px 10px;
  font-size: 14px;
  box-sizing: border-box;
  background-color: #f8fafc;
  transition: 0.2s;
}

input:focus, textarea:focus {
  border-color: #010101;
  box-shadow: 0 0 6px rgba(59,130,246,0.3);
  background-color: #ffffff;
  outline: none;
}

.checkbox-inline {
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: 600;
}

textarea {
  width: 100%;
  min-height: 120px;
  resize: vertical;
}

.section {
  margin-bottom: 20px;
}
.flex-row {
  display: flex;
  align-items: center;  
  gap: 8px;              
  margin-bottom: 10px;  
}

.flex-row label {
  white-space: nowrap;   
}

.flex-row input,
.flex-row select,
.flex-row textarea {
  flex: 1 1 180px;
}

.checkbox-group {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 5px;
}

.signature {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

.signature .flex-row {
  flex: 1;
  min-width: 250px;
}

button {
  background: linear-gradient(180deg, #1e3a8a, #3b82f6);
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}

button:hover {
  transform: scale(1.05);
}

@media (max-width: 1024px) {
  .flex-row input,
  .flex-row select,
  .flex-row textarea {
    flex: 1 1 45%; 
  }
}

@media (max-width: 768px) {
  .flex-row { 
    flex-direction: column; 
    align-items: flex-start; 
    gap: 10px; 
  }
  .flex-row label { 
    width: 100%; 
    margin-bottom: 5px; 
  }
}

</style>
<div class="form-container">
  <h2>แก้ไขประวัติคอมพิวเตอร์</h2>
  <form method="POST" action="{{ route('computer-history.update', $item->id) }}">
    @csrf
    @method('PUT')


    <!-- 1) User Info -->
    <div class="section flex-row">
      <label>1) User Name:</label>
      <input type="text" name="user_name" value="{{ old('user_name', $item->user_name) }}">
      <label>No.</label>
      <input type="text" name="no_number" value="{{ old('no_number', $item->no_number) }}">
      <label>Starting Date:</label>
      <input type="date" name="start_date" value="{{ old('start_date', $item->start_date) }}">
    </div>

   <div class="section" style="display: flex; align-items: center; gap: 10px;">
  <label>2) Computer Type:</label>
  <div class="checkbox-group" style="display: flex; gap: 10px;">
    <label><input type="checkbox" name="type_pc" {{ $item->type_pc ? 'checked' : '' }}> PC</label>
    <label><input type="checkbox" name="type_notebook" {{ $item->type_notebook ? 'checked' : '' }}> Notebook</label>
  </div>
</div>

    <div class="section flex-row">
      <label>3) CPU / Spec:</label>
      <input type="text" name="cpu_spec" value="{{ old('cpu_spec', $item->cpu_spec) }}">
    </div>

    <div class="section">
      <label>4) RAM:</label>
      <div class="checkbox-group">
        <label><input type="checkbox" name="ram_ddr1" {{ $item->ram_ddr1 ? 'checked' : '' }}> DDR1</label>
        <label><input type="checkbox" name="ram_ddr2" {{ $item->ram_ddr2 ? 'checked' : '' }}> DDR2</label>
        <label><input type="checkbox" name="ram_ddr3" {{ $item->ram_ddr3 ? 'checked' : '' }}> DDR3</label>
      </div>
      <div class="flex-row">
        <label>Other:</label>
        <input type="text" name="ram_other" value="{{ old('ram_other', $item->ram_other) }}">
      </div>
      <div class="flex-row">
        <label>DIMM 1:</label>
        <input type="text" name="dimm1" value="{{ old('dimm1', $item->dimm1) }}">
        <label>Warranty:</label>
        <br><br>
        <input type="date" name="dimm1_warranty" value="{{ old('dimm1_warranty', $item->dimm1_warranty) }}">
        <label>Exp:</label>
        <input type="date" name="dimm1_exp" value="{{ old('dimm1_exp', $item->dimm1_exp) }}">
      </div>
      <div class="flex-row">
        <label>DIMM 2:</label>
        <input type="text" name="dimm2" value="{{ old('dimm2', $item->dimm2) }}">
        <label>Warranty:</label>
        <br><br>
        <input type="date" name="dimm2_warranty" value="{{ old('dimm2_warranty', $item->dimm2_warranty) }}">
        <label>Exp:</label>
        <input type="date" name="dimm2_exp" value="{{ old('dimm2_exp', $item->dimm2_exp) }}">
      </div>
    </div>
    <div class="section">
      <label>5) Hard Disk:</label>
      <div class="checkbox-group">
        <label><input type="checkbox" name="hd_ide" {{ $item->hd_ide ? 'checked' : '' }}> IDE</label>
        <label><input type="checkbox" name="hd_sata" {{ $item->hd_sata ? 'checked' : '' }}> SATA</label>
        <label><input type="checkbox" name="hd_sas" {{ $item->hd_sas ? 'checked' : '' }}> SAS</label>
        <label><input type="checkbox" name="hd_other" {{ $item->hd_other ? 'checked' : '' }}> Other</label>
      </div>
     <div class="flex-row">
  <label>Qty:</label>
  <input type="number" name="hd_qty" min="0" value="{{ old('hd_qty', $item->hd_qty) }}">
</div>

<div class="flex-row">
  <label>Disk 1:</label>
  <input type="text" name="disk1" value="{{ old('disk1', $item->disk1) }}">
  
  <label>Warranty:</label>
  <input type="date" name="disk1_warranty" value="{{ old('disk1_warranty', $item->disk1_warranty) }}">
  
  <label>Exp:</label>
  <input type="date" name="disk1_exp" value="{{ old('disk1_exp', $item->disk1_exp) }}">
</div>

<div class="flex-row">
  <label>Disk 2:</label>
  <input type="text" name="disk2" value="{{ old('disk2', $item->disk2) }}">
  
  <label>Warranty:</label>
  <input type="date" name="disk2_warranty" value="{{ old('disk2_warranty', $item->disk2_warranty) }}">
  
  <label>Exp:</label>
  <input type="date" name="disk2_exp" value="{{ old('disk2_exp', $item->disk2_exp) }}">
</div>
      <div class="flex-row">
        <label>External Disk Drive:</label>
        <input type="text" name="external_disk" value="{{ old('external_disk', $item->external_disk) }}">
      </div>
    </div>

    <div class="section">
      <label>6) CD/DVD:</label>
      <div class="checkbox-group">
        <label><input type="checkbox" name="cd_ide" {{ $item->cd_ide ? 'checked' : '' }}> IDE</label>
        <label><input type="checkbox" name="cd_sata" {{ $item->cd_sata ? 'checked' : '' }}> SATA</label>
      </div>
      <div class="flex-row">
        <label>Qty:</label>
        <input type="number" name="cd_qty" min="0" value="{{ old('cd_qty', $item->cd_qty) }}">
      </div>
      <div class="flex-row">
        <label>Drive 1:</label>
        <input type="text" name="cd_drive1" value="{{ old('cd_drive1', $item->cd_drive1) }}">
        <label>Warranty:</label>
        <br><br> 
        <input type="date" name="cd1_warranty" value="{{ old('cd1_warranty', $item->cd1_warranty) }}">
        <label>Exp:</label>
        <input type="date" name="cd1_exp" value="{{ old('cd1_exp', $item->cd1_exp) }}">
      </div>
      <div class="flex-row">
        <label>Drive 2:</label>
        <input type="text" name="cd_drive2" value="{{ old('cd_drive2', $item->cd_drive2) }}">
        <label>Warranty:</label>
        <br><br>
        <input type="date" name="cd2_warranty" value="{{ old('cd2_warranty', $item->cd2_warranty) }}">
        <label>Exp:</label>
        <input type="date" name="cd2_exp" value="{{ old('cd2_exp', $item->cd2_exp) }}">
      </div>
      <div class="flex-row">
        <label>External CD/DVD Drive:</label>
        <input type="text" name="external_cd" value="{{ old('external_cd', $item->external_cd) }}">
      </div>
    </div>
<div class="section flex-row">
        <label>7)Main Board/Spec:</label>
        <input type="text" name="main_board_spec" value="{{ old('mb_ide_port', $item->main_board_spec) }}">
      </div>
    <div class="section flex-row">
      <label>IDE Port:</label>
      <input type="text" name="mb_ide_port" value="{{ old('mb_ide_port', $item->mb_ide_port) }}">
      <label>SATA Port:</label>
      <input type="text" name="mb_sata_port" value="{{ old('mb_sata_port', $item->mb_sata_port) }}">
      <label>USB Port:</label>
      <input type="text" name="mb_usb_port" value="{{ old('mb_usb_port', $item->mb_usb_port) }}">
    </div>

    <div class="section flex-row">
      <label>8) VGA:</label>
      <label class="checkbox-inline"><input type="checkbox" name="vga_onboard" {{ $item->vga_onboard ? 'checked' : '' }}> Onboard</label>
      <label class="checkbox-inline"><input type="checkbox" name="vga_display" {{ $item->vga_display ? 'checked' : '' }}> Display Card</label>
      <label class="checkbox-inline"><input type="checkbox" name="vga_pci" {{ $item->vga_pci ? 'checked' : '' }}> PCI</label>
      <label class="checkbox-inline"><input type="checkbox" name="vga_pcie" {{ $item->vga_pcie ? 'checked' : '' }}> PCIE</label>
      <label>Brand / Spec:</label>
      <input type="text" name="vga_spec" value="{{ old('vga_spec', $item->vga_spec) }}">
    </div>

    <div class="section flex-row">
      <label>9) LAN / Wireless:</label>
      <label class="checkbox-inline"><input type="checkbox" name="lan_onboard" {{ $item->lan_onboard ? 'checked' : '' }}> Onboard</label>
      <label class="checkbox-inline"><input type="checkbox" name="lan_usb" {{ $item->lan_usb ? 'checked' : '' }}> USB Wireless</label>
      <label class="checkbox-inline"><input type="checkbox" name="lan_card" {{ $item->lan_card ? 'checked' : '' }}> LAN Card</label>
      <label class="checkbox-inline"><input type="checkbox" name="lan_pci" {{ $item->lan_pci ? 'checked' : '' }}> PCI</label>
      <label class="checkbox-inline"><input type="checkbox" name="lan_pcie" {{ $item->lan_pcie ? 'checked' : '' }}> PCIE</label>
      <label>Brand / Spec:</label>
      <input type="text" name="lan_spec" value="{{ old('lan_spec', $item->lan_spec) }}">
    </div>

    <div class="section flex-row">
      <label>10) Power Supply:</label>
      <label class="checkbox-inline"><input type="checkbox" name="psu_ide" {{ $item->psu_ide ? 'checked' : '' }}> IDE Plug</label>
      <label class="checkbox-inline"><input type="checkbox" name="psu_sata" {{ $item->psu_sata ? 'checked' : '' }}> SATA Plug</label>
      <label>Watt:</label>
      <input type="text" name="psu_watt" value="{{ old('psu_watt', $item->psu_watt) }}">
      <label>Result:</label>
      <input type="text" name="psu_result" value="{{ old('psu_result', $item->psu_result) }}">
    </div>

    <div class="section flex-row">
      <label>11) Monitor (Brand / Spec):</label>
      <input type="text" name="monitor_spec" value="{{ old('monitor_spec', $item->monitor_spec) }}">
    </div>

    <div class="section flex-row">
      <label>12) Accessory:</label>
      <input type="text" name="accessory" value="{{ old('accessory', $item->accessory) }}">
    </div>

    <div class="section flex-row">
      <label>Mouse:</label>
      <input type="text" name="mouse" value="{{ old('mouse', $item->mouse) }}">
      <label>Keyboard:</label>
      <input type="text" name="keyboard" value="{{ old('keyboard', $item->keyboard) }}">
      <label>Sound Card:</label>
      <input type="text" name="sound_card" value="{{ old('sound_card', $item->sound_card) }}">
    </div>

    <div class="section flex-row">
      <label>Drive A:</label>
      <input type="text" name="drive_a" value="{{ old('drive_a', $item->drive_a) }}">
      <label>Card:</label>
      <input type="text" name="card" value="{{ old('card', $item->card) }}">
      <label>Speaker:</label>
      <input type="text" name="speaker" value="{{ old('speaker', $item->speaker) }}">
    </div>

    <div class="section flex-row">
      <label>Other:</label>
      <input type="text" name="accessory_other" value="{{ old('accessory_other', $item->accessory_other) }}">
    </div>

    <hr>
    <label>Software License</label>
    <div class="section flex-row">
      <label>Operating Software:</label>
      <input type="text" name="os" value="{{ old('os', $item->os) }}">
      <label>Office:</label>
      <input type="text" name="office" value="{{ old('office', $item->office) }}">
      <label>Other:</label>
      <input type="text" name="software_other" value="{{ old('software_other', $item->software_other) }}">
    </div>

    <div class="section">
      <label>Problem / Maintenance:</label>
      <textarea name="problem" rows="5">{{ old('problem', $item->problem) }}</textarea>
    </div>

    <div class="section signature">
      <div class="flex-row">
        <label>Check by:</label>
        <input type="text" name="check_by" value="{{ old('check_by', $item->check_by) }}">
        <label>Date:</label>
        <input type="date" name="check_date" value="{{ old('check_date', $item->check_date) }}">
      </div>
      <div class="flex-row">
        <label>Acknowledged by:</label>
        <input type="text" name="ack_by" value="{{ old('ack_by', $item->ack_by) }}" readonly>
        <label>Date:</label>
        <input type="date" name="ack_date" value="{{ old('ack_date', $item->ack_date) }}" readonly>
      </div>
    </div>
<div style="text-align:center; margin-top:30px;">
      <button type="submit">บันทึก</button>
    </div>
  </form>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#1e40af'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'เกิดข้อผิดพลาด!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626'
});
</script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault(); 
        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล?',
            text: "ตรวจสอบข้อมูลให้ถูกต้องก่อนกดยืนยัน",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush