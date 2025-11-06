@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>ประวัติคอมพิวเตอร์</title>

@if(session('success') || session('error'))
<script>
Swal.fire({
    icon: "{{ session('success') ? 'success' : 'error' }}",
    title: "{{ session('success') ? 'สำเร็จ!' : 'เกิดข้อผิดพลาด!' }}",
    text: "{{ session('success') ?? session('error') }}",
    confirmButtonColor: "{{ session('success') ? '#1e40af' : '#dc2626' }}"
});
</script>
@endif

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
  <h2>ประวัติคอมพิวเตอร์</h2>

  <form method="POST" action="{{ isset($computerHistory) ? route('computer-history.update', $computerHistory->id) : route('computer-history.store') }}">
    @csrf
    @if(isset($computerHistory)) @method('PUT') @endif


    <div class="section flex-row">
      <label>1) User Name:</label>
      <input type="text" name="user_name" value="{{ old('user_name', $computerHistory->user_name ?? '') }}">
      <label>No.</label>
      <input type="text" name="no_number" value="{{ old('no_number', $computerHistory->no_number ?? '') }}">
      <label>Starting Date:</label>
      <input type="date" name="start_date" value="{{ old('start_date', $computerHistory->start_date ?? '') }}">
    </div>

 
    <div class="section flex-row">
      <label>2) Computer Type:</label>
      <label><input type="checkbox" name="type_pc" {{ old('type_pc', $computerHistory->type_pc ?? false) ? 'checked' : '' }}> PC</label>
      <label><input type="checkbox" name="type_notebook" {{ old('type_notebook', $computerHistory->type_notebook ?? false) ? 'checked' : '' }}> Notebook</label>
    </div>


    <div class="section flex-row">
      <label>3) CPU / Spec:</label>
      <input type="text" name="cpu_spec" value="{{ old('cpu_spec', $computerHistory->cpu_spec ?? '') }}">
    </div>


    <div class="section flex-row">
      <label>4) RAM:</label>
      <label><input type="checkbox" name="ram_ddr1" {{ old('ram_ddr1', $computerHistory->ram_ddr1 ?? false) ? 'checked' : '' }}> DDR I</label>
      <label><input type="checkbox" name="ram_ddr2" {{ old('ram_ddr2', $computerHistory->ram_ddr2 ?? false) ? 'checked' : '' }}> DDR II</label>
      <label><input type="checkbox" name="ram_ddr3" {{ old('ram_ddr3', $computerHistory->ram_ddr3 ?? false) ? 'checked' : '' }}> DDR III</label>
    </div>

    <div class="section flex-row">
      <label>DIMM 1:</label>
      <input type="text" name="dimm1" value="{{ old('dimm1', $computerHistory->dimm1 ?? '') }}">
      <label>Warranty Date:</label>
      <input type="date" name="dimm1_warranty" value="{{ old('dimm1_warranty', $computerHistory->dimm1_warranty ?? '') }}">
      <label>Exp:</label>
      <input type="date" name="dimm1_exp" value="{{ old('dimm1_exp', $computerHistory->dimm1_exp ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>DIMM 2:</label>
      <input type="text" name="dimm2" value="{{ old('dimm2', $computerHistory->dimm2 ?? '') }}">
      <label>Warranty Date:</label>
      <input type="date" name="dimm2_warranty" value="{{ old('dimm2_warranty', $computerHistory->dimm2_warranty ?? '') }}">
      <label>Exp:</label>
      <input type="date" name="dimm2_exp" value="{{ old('dimm2_exp', $computerHistory->dimm2_exp ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>Other:</label>
      <input type="text" name="ram_other" value="{{ old('ram_other', $computerHistory->ram_other ?? '') }}">
    </div>


    <div class="section flex-row" style="align-items: center; flex-wrap: wrap; gap: 10px;">
      <label>5) Hard Disk:</label>
      <label><input type="checkbox" name="hd_ide" {{ old('hd_ide', $computerHistory->hd_ide ?? false) ? 'checked' : '' }}> IDE</label>
      <label><input type="checkbox" name="hd_sata" {{ old('hd_sata', $computerHistory->hd_sata ?? false) ? 'checked' : '' }}> SATA</label>
      <label><input type="checkbox" name="hd_sas" {{ old('hd_sas', $computerHistory->hd_sas ?? false) ? 'checked' : '' }}> SAS</label>
      <label><input type="checkbox" name="hd_other" {{ old('hd_other', $computerHistory->hd_other ?? false) ? 'checked' : '' }}> Other</label>
      <label>Qty:</label>
      <input type="number" name="hd_qty" min="0" value="{{ old('hd_qty', $computerHistory->hd_qty ?? '') }}" style="width:80px;">
    </div>
    <div class="section flex-row">
      <label>Disk 1:</label>
      <input type="text" name="disk1" value="{{ old('disk1', $computerHistory->disk1 ?? '') }}">
      <label>Warranty Date:</label>
      <input type="date" name="disk1_warranty" value="{{ old('disk1_warranty', $computerHistory->disk1_warranty ?? '') }}">
      <label>Exp:</label>
      <input type="date" name="disk1_exp" value="{{ old('disk1_exp', $computerHistory->disk1_exp ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>Disk 2:</label>
      <input type="text" name="disk2" value="{{ old('disk2', $computerHistory->disk2 ?? '') }}">
      <label>Warranty Date:</label>
      <input type="date" name="disk2_warranty" value="{{ old('disk2_warranty', $computerHistory->disk2_warranty ?? '') }}">
      <label>Exp:</label>
      <input type="date" name="disk2_exp" value="{{ old('disk2_exp', $computerHistory->disk2_exp ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>External Disk Drive:</label>
      <input type="text" name="external_disk" value="{{ old('external_disk', $computerHistory->external_disk ?? '') }}">
    </div>


    <div class="section flex-row">
      <label>6) CD / DVD:</label>
      <label><input type="checkbox" name="cd_ide" {{ old('cd_ide', $computerHistory->cd_ide ?? false) ? 'checked' : '' }}> IDE</label>
      <label><input type="checkbox" name="cd_sata" {{ old('cd_sata', $computerHistory->cd_sata ?? false) ? 'checked' : '' }}> SATA</label>
      <label>Qty:</label>
      <input type="number" name="cd_qty" min="0" value="{{ old('cd_qty', $computerHistory->cd_qty ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>Drive 1:</label>
      <input type="text" name="cd_drive1" value="{{ old('cd_drive1', $computerHistory->cd_drive1 ?? '') }}">
      <label>Warranty Date:</label>
      <input type="date" name="cd1_warranty" value="{{ old('cd1_warranty', $computerHistory->cd1_warranty ?? '') }}">
      <label>Exp:</label>
      <input type="date" name="cd1_exp" value="{{ old('cd1_exp', $computerHistory->cd1_exp ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>Drive 2:</label>
      <input type="text" name="cd_drive2" value="{{ old('cd_drive2', $computerHistory->cd_drive2 ?? '') }}">
      <label>Warranty Date:</label>
      <input type="date" name="cd2_warranty" value="{{ old('cd2_warranty', $computerHistory->cd2_warranty ?? '') }}">
      <label>Exp:</label>
      <input type="date" name="cd2_exp" value="{{ old('cd2_exp', $computerHistory->cd2_exp ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>External CD/DVD Drive:</label>
      <input type="text" name="external_cd" value="{{ old('external_cd', $computerHistory->external_cd ?? '') }}">
    </div>


    <div class="section flex-row">
      <label>7) Main Board / Spec:</label>
      <input type="text" name="main_board_spec" value="{{ old('main_board_spec', $computerHistory->main_board_spec ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>IDE Port:</label>
      <input type="text" name="mb_ide_port" value="{{ old('mb_ide_port', $computerHistory->mb_ide_port ?? '') }}">
      <label>SATA Port:</label>
      <input type="text" name="mb_sata_port" value="{{ old('mb_sata_port', $computerHistory->mb_sata_port ?? '') }}">
      <label>USB Port:</label>
      <input type="text" name="mb_usb_port" value="{{ old('mb_usb_port', $computerHistory->mb_usb_port ?? '') }}">
    </div>


    <div class="section flex-row">
      <label>8) VGA:</label>
      <label><input type="checkbox" name="vga_onboard" {{ old('vga_onboard', $computerHistory->vga_onboard ?? false) ? 'checked' : '' }}> Onboard</label>
      <label><input type="checkbox" name="vga_display" {{ old('vga_display', $computerHistory->vga_display ?? false) ? 'checked' : '' }}> Display Card</label>
      <label><input type="checkbox" name="vga_pci" {{ old('vga_pci', $computerHistory->vga_pci ?? false) ? 'checked' : '' }}> PCI</label>
      <label><input type="checkbox" name="vga_pcie" {{ old('vga_pcie', $computerHistory->vga_pcie ?? false) ? 'checked' : '' }}> PCIE</label>
      <label>Brand / Spec:</label>
      <input type="text" name="vga_spec" value="{{ old('vga_spec', $computerHistory->vga_spec ?? '') }}">
    </div>


    <div class="section flex-row">
      <label>9) LAN / Wireless:</label>
      <label><input type="checkbox" name="lan_onboard" {{ old('lan_onboard', $computerHistory->lan_onboard ?? false) ? 'checked' : '' }}> Onboard</label>
      <label><input type="checkbox" name="lan_usb" {{ old('lan_usb', $computerHistory->lan_usb ?? false) ? 'checked' : '' }}> USB Wireless</label>
      <label><input type="checkbox" name="lan_card" {{ old('lan_card', $computerHistory->lan_card ?? false) ? 'checked' : '' }}> LAN Card</label>
      <label><input type="checkbox" name="lan_pci" {{ old('lan_pci', $computerHistory->lan_pci ?? false) ? 'checked' : '' }}> PCI</label>
      <label><input type="checkbox" name="lan_pcie" {{ old('lan_pcie', $computerHistory->lan_pcie ?? false) ? 'checked' : '' }}> PCIE</label>
      <label>Brand / Spec:</label>
      <input type="text" name="lan_spec" value="{{ old('lan_spec', $computerHistory->lan_spec ?? '') }}">
    </div>

    <div class="section flex-row">
      <label>10) Power Supply</label>
      <label><input type="checkbox" name="psu_ide" {{ old('psu_ide', $computerHistory->psu_ide ?? false) ? 'checked' : '' }}> IDE Plug</label>
      <label><input type="checkbox" name="psu_sata" {{ old('psu_sata', $computerHistory->psu_sata ?? false) ? 'checked' : '' }}> SATA Plug</label>
      <label>Watt:</label>
      <input type="text" name="psu_watt" value="{{ old('psu_watt', $computerHistory->psu_watt ?? '') }}">
      <label>Result:</label>
      <input type="text" name="psu_result" value="{{ old('psu_result', $computerHistory->psu_result ?? '') }}">
    </div>


    <div class="section flex-row">
      <label>11) Monitor (Brand / Spec):</label>
      <input type="text" name="monitor_spec" value="{{ old('monitor_spec', $computerHistory->monitor_spec ?? '') }}">
    </div>

    <div class="section flex-row">
      <label>12) Accessory:</label>
      <input type="text" name="accessory" value="{{ old('accessory', $computerHistory->accessory ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>Mouse:</label>
      <input type="text" name="mouse" value="{{ old('mouse', $computerHistory->mouse ?? '') }}">
      <label>Keyboard:</label>
      <input type="text" name="keyboard" value="{{ old('keyboard', $computerHistory->keyboard ?? '') }}">
      <label>Sound Card:</label>
      <input type="text" name="sound_card" value="{{ old('sound_card', $computerHistory->sound_card ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>Drive A:</label>
      <input type="text" name="drive_a" value="{{ old('drive_a', $computerHistory->drive_a ?? '') }}">
      <label>Card:</label>
      <input type="text" name="card" value="{{ old('card', $computerHistory->card ?? '') }}">
      <label>Speaker:</label>
      <input type="text" name="speaker" value="{{ old('speaker', $computerHistory->speaker ?? '') }}">
    </div>
    <div class="section flex-row">
      <label>Other:</label>
      <input type="text" name="accessory_other" value="{{ old('accessory_other', $computerHistory->accessory_other ?? '') }}">
    </div>

 
    <hr>
    <label>Software license</label>
    <div class="section flex-row">
      <label>Operating Software:</label>
      <input type="text" name="os" value="{{ old('os', $computerHistory->os ?? '') }}">
      <label>Office:</label>
      <input type="text" name="office" value="{{ old('office', $computerHistory->office ?? '') }}">
      <label>Other:</label>
      <input type="text" name="software_other" value="{{ old('software_other', $computerHistory->software_other ?? '') }}">
    </div>

  
    <div class="section">
      <label>Problem / Maintenance:</label>
      <textarea name="problem">{{ old('problem', $computerHistory->problem ?? '') }}</textarea>
    </div>


    <div class="section signature">
      <div class="flex-row">
        <label>Check by:</label>
        <input type="text" name="check_by" value="{{ old('check_by', $computerHistory->check_by ?? '') }}">
        <label>Date:</label>
        <input type="date" name="check_date" value="{{ old('check_date', $computerHistory->check_date ?? '') }}">
      </div>
      <div class="flex-row">
        <label>Acknowledged by:</label>
        <input type="text" name="ack_by" value="{{ old('ack_by', $computerHistory->ack_by ?? '') }}" {{ isset($computerHistory) ? '' : 'disabled' }} readonly>
        <label>Date:</label>
        <input type="date" name="ack_date" value="{{ old('ack_date', $computerHistory->ack_date ?? '') }}" {{ isset($computerHistory) ? '' : 'disabled' }} readonly>
      </div>
    </div>

    <div style="text-align:center; margin-top:30px;">
      <button type="submit">{{ isset($computerHistory) ? 'Update' : 'บันทึกข้อมูล' }}</button>
    </div>
  </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('.form-container form');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'ยืนยันการบันทึกข้อมูล?',
      text: 'กรุณาตรวจสอบข้อมูลก่อนกดยืนยัน',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#1e3a8a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'บันทึก',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => { if (result.isConfirmed) form.submit(); });
  });

  const sections = Array.from(form.querySelectorAll('.section')).filter(s => !s.classList.contains('signature'));
  const signatureSection = form.querySelector('.signature');
  const submitBtn = form.querySelector('button[type="submit"]');
  const rowsPerPage = 4;
  let currentPage = 1;
  const totalPages = Math.ceil(sections.length / rowsPerPage);

  // สร้าง div pagination
  const pagination = document.createElement('div');
  pagination.style.textAlign = 'center';
  pagination.style.margin = '20px 0';
  const prevBtn = document.createElement('button');
  prevBtn.type = 'button';
  prevBtn.id = 'prev-page';
  prevBtn.textContent = 'ก่อนหน้า';
  const nextBtn = document.createElement('button');
  nextBtn.type = 'button';
  nextBtn.id = 'next-page';
  nextBtn.textContent = 'ถัดไป';
  const pageInfo = document.createElement('span');
  pageInfo.id = 'pagination-info';
  pageInfo.style.margin = '0 10px';
  pagination.appendChild(prevBtn);
  pagination.appendChild(pageInfo);
  pagination.appendChild(nextBtn);

  submitBtn.parentNode.insertBefore(pagination, submitBtn);

  function showPage(page) {
    const start = (page-1)*rowsPerPage;
    const end = start + rowsPerPage;
    sections.forEach((s,i)=> s.style.display = i>=start && i<end ? '' : 'none');

    if(page === totalPages){
      signatureSection.style.display = '';
      submitBtn.style.display = '';
      nextBtn.style.display = 'none';
    } else {
      signatureSection.style.display = 'none';
      submitBtn.style.display = 'none';
      nextBtn.style.display = ''; 

    pageInfo.textContent = `หน้า ${page} / ${totalPages}`;
    prevBtn.disabled = page === 1;
    currentPage = page;
  }

  prevBtn.addEventListener('click', ()=> showPage(currentPage-1));
  nextBtn.addEventListener('click', ()=> showPage(currentPage+1));

  showPage(currentPage);
}
});
</script>
@endsection
