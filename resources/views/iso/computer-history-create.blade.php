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

/* Flex container สำหรับ label + input */
.flex-row {
  display: flex;
  align-items: center;
  gap: 15px;
  flex-wrap: wrap;
}

.flex-row label {
  min-width: 120px;
  font-weight: 600;
  color: #000;
}

.flex-row input,
.flex-row select,
.flex-row textarea {
  flex: 1 1 150px;
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

button:hover { transform: scale(1.05); }

@media (max-width: 768px) {
  .flex-row { flex-direction: column; align-items: flex-start; }
  .flex-row label { width: 100%; margin-bottom: 5px; }
  .signature { flex-direction: column; }
}
</style>

<div class="form-container">
  <h2>ประวัติคอมพิวเตอร์</h2>

  <form method="POST" action="{{ route('computer-history.store') }}">
    @csrf

    <div class="section flex-row">
      <label>1) User Name:</label>
      <input type="text" name="user_name" placeholder="User Name">
      <label>No.</label>
      <input type="text" name="no_number" placeholder="No.">
      <label>Starting Date:</label>
      <input type="date" name="start_date">
    </div>

    <div class="section flex-row">
  <label style="min-width:auto;">2) Computer Type:</label>
  <div class="checkbox-group" style="display:flex; align-items:center; gap:10px;">
    <label><input type="checkbox" name="type_pc"> PC</label>
    <label><input type="checkbox" name="type_notebook"> Notebook</label>
  </div>
</div>
    <div class="section flex-row">
      <label>3) CPU / Spec:</label>
      <input type="text" name="cpu_spec">
    </div>
   <div class="section flex-row" style="align-items:center; gap:5px;">
  <label style="min-width:auto;">4) RAM:</label>
  <div class="checkbox-group" style="display:flex; align-items:center; gap:5px;">
    <label><input type="checkbox" name="ram_ddr1"> DDR I</label>
    <label><input type="checkbox" name="ram_ddr2"> DDR II</label>
    <label><input type="checkbox" name="ram_ddr3"> DDR III</label>
  </div>
</div>

    <div class="section flex-row">
      <label>DIMM 1:</label>
      <input type="text" name="dimm1" placeholder="DIMM 1">
      <label>Warranty Date:</label>
      <input type="date" name="dimm1_warranty">
      <label>Exp:</label>
      <input type="date" name="dimm1_exp">
    </div>

    <div class="section flex-row">
      <label>DIMM 2:</label>
      <input type="text" name="dimm2" placeholder="DIMM 2">
      <label>Warranty Date:</label>
      <input type="date" name="dimm2_warranty">
      <label>Exp:</label>
      <input type="date" name="dimm2_exp">
    </div>

    <div class="section flex-row">
      <label>Other:</label>
      <input type="text" name="ram_other">
    </div>
    <div class="section flex-row" style="align-items: center; flex-wrap: wrap; gap: 15px;">
  <label>5) Hard Disk:</label>

  <label class="checkbox-inline">
    <input type="checkbox" name="hd_ide"> IDE
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="hd_sata"> SATA
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="hd_sas"> SAS
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="hd_other"> Other
  </label>
  <label>Qty:</label>
  <input type="number" name="hd_qty" min="0" style="width:80px;">
</div>
      <div class="section flex-row">
        <label>Disk 1:</label>
        <input type="text" name="disk1">
        <label>Warranty Date:</label>
        <input type="date" name="disk1_warranty">
        <label>Exp:</label>
        <input type="date" name="disk1_exp">
      </div>
      <div class="section flex-row">
        <label>Disk 2:</label>
        <input type="text" name="disk2">
        <label>Warranty Date:</label>
        <input type="date" name="disk2_warranty">
        <label>Exp:</label>
        <input type="date" name="disk2_exp">
      </div>
      <div class="section flex-row">
        <label>External Disk Drive:</label>
        <input type="text" name="external_disk">
      </div>
    <div class="section" style="display:flex; align-items:center; gap:15px; flex-wrap:wrap;">
      <label>6) CD / DVD:</label>
      <div class="checkbox-group">
        <label><input type="checkbox" name="cd_ide"> IDE</label>
        <label><input type="checkbox" name="cd_sata"> SATA</label>
      </div>
      <div class="section flex-row">
        <label>Qty:</label>
        <input type="number" name="cd_qty" min="0">
      </div>
      <div class="section flex-row">
        <label>Drive 1:</label>
        <input type="text" name="cd_drive1">
        <label>Warranty Date:</label>
        <input type="date" name="cd1_warranty">
        <label>Exp:</label>
        <input type="date" name="cd1_exp">
      </div>
      <div class="section flex-row">
        <label>Drive 2:</label>
        <input type="text" name="cd_drive2">
        <label>Warranty Date:</label>
        <input type="date" name="cd2_warranty">
        <label>Exp:</label>
        <input type="date" name="cd2_exp">
      </div>
      <div class="section flex-row">
        <label>External CD/DVD Drive:</label>
        <input type="text" name="external_cd">
      </div>
    </div>
<div class="section flex-row">
        <label>7)Main Board/Spec:</label>
        <input type="text" name="main_board_spec">
      </div>
    <div class="section flex-row">
      <label>IDE Port:</label>
      <input type="text" name="mb_ide_port" placeholder="">
      <label>SATA Port:</label>
      <input type="text" name="mb_sata_port" placeholder="">
      <label>USB Port:</label>
      <input type="text" name="mb_usb_port" placeholder="">
    </div>
    <div class="section flex-row" style="align-items: center; flex-wrap: wrap; gap: 15px;">
  <label>8) VGA:</label>

  <label class="checkbox-inline">
    <input type="checkbox" name="vga_onboard"> Onboard
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="vga_display"> Display Card
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="vga_pci"> PCI
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="vga_pcie"> PCIE
  </label>

  <label>Brand / Spec:</label>
  <input type="text" name="vga_spec">
</div>
<div class="section flex-row" style="align-items: center; flex-wrap: wrap; gap: 15px;">
  <label>9) LAN / Wireless:</label>

  <label class="checkbox-inline">
    <input type="checkbox" name="lan_onboard"> Onboard
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="lan_usb"> USB Wireless
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="lan_card"> LAN Card
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="lan_pci"> PCI
  </label>
  <label class="checkbox-inline">
    <input type="checkbox" name="lan_pcie"> PCIE
  </label>
  <label>Brand / Spec:</label>
  <input type="text" name="lan_spec">
</div>

<div class="section flex-row" style="align-items: center; flex-wrap: wrap; gap: 15px;">
  <label>10) Power Supply</label>

  <label class="checkbox-inline">
    <input type="checkbox" name="psu_ide"> IDE Plug
  </label>

  <label class="checkbox-inline">
    <input type="checkbox" name="psu_sata"> SATA Plug
  </label>

  <label>Watt:</label>
  <input type="text" name="psu_watt" placeholder="">

  <label>Result:</label>
  <input type="text" name="psu_result">
</div>
    <div class="section flex-row">
      <label>11) Monitor (Brand / Spec):</label>
      <input type="text" name="monitor_spec">
    </div>
    <div class="section flex-row">
        <label>12) Accessory:</label>
      <input type="text" name="accessory">
      </div>
    <div class="section flex-row">
      <label>Mouse:</label>
      <input type="text" name="mouse">
      <label>Keyboard:</label>
      <input type="text" name="keyboard">
      <label>Sound Card:</label>
      <input type="text" name="sound_card">
    </div>
    <div class="section flex-row">
      <label>Drive A:</label>
      <input type="text" name="drive_a">
      <label>Card:</label>
      <input type="text" name="card">
      <label>Speaker:</label>
      <input type="text" name="speaker">
    </div>
    <div class="section flex-row">
      <label>Other:</label>
      <input type="text" name="accessory_other">
    </div>

    <hr>
    <label>Software license</label>
    <div class="section flex-row">
      <label>Operating Software:</label>
      <input type="text" name="os">
      <label>Office:</label>
      <input type="text" name="office">
      <label>Other:</label>
      <input type="text" name="software_other">
    </div>

    <div class="section">
      <label>Problem / Maintenance:</label>
      <textarea name="problem" rows="5" placeholder="Problem / Maintenance"></textarea>
    </div>
    <div class="section signature">
      <div class="flex-row">
        <label>Check by:</label>
        <input type="text" name="check_by" placeholder="Check by">
        <label>Date:</label>
        <input type="date" name="check_date">
      </div>
      <div class="flex-row">
        <label>Acknowledged by:</label>
        <input type="text" name="ack_by" placeholder="Acknowledged by">
        <label>Date:</label>
        <input type="date" name="ack_date">
      </div>
    </div>

   <div style="text-align:center; margin-top:30px;">
      <button type="submit">บันทึกข้อมูล</button>
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
    }).then((result) => {
      if (result.isConfirmed) form.submit();
    });
  });

  const sections = Array.from(form.querySelectorAll('.section'))
                        .filter(s => !s.classList.contains('signature') && s.querySelector('input, select, textarea'));
  const lastSections = Array.from(form.querySelectorAll('.section.signature, .section-software'));
  const submitBtn = form.querySelector('button[type="submit"]');
  const rowsPerPage = 10;
  let currentPage = 1;
  const totalPages = Math.ceil(sections.length / rowsPerPage);
  const pagination = document.createElement('div');
  pagination.style.textAlign = 'center';
  pagination.style.margin = '20px 0';
  pagination.innerHTML = `
    <button type="button" id="prev-page" style="margin-right:10px;">ก่อนหน้า</button>
    <span id="pagination-info"></span>
    <button type="button" id="next-page" style="margin-left:10px;">ถัดไป</button>
  `;
  submitBtn.parentNode.insertBefore(pagination, submitBtn);

  function showPage(page) {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    sections.forEach((section, idx) => {
      section.style.display = (idx >= start && idx < end) ? '' : 'none';
    });

    const isLastPage = page === totalPages;
    lastSections.forEach(s => {
      s.style.display = isLastPage ? '' : 'none';
    });
    submitBtn.style.display = isLastPage ? '' : 'none';

    document.getElementById('next-page').style.display = isLastPage ? 'none' : '';
    document.getElementById('pagination-info').textContent = `หน้า ${page} / ${totalPages}`;
    document.getElementById('prev-page').disabled = page === 1;
  }

  document.getElementById('prev-page').addEventListener('click', () => {
    if (currentPage > 1) { currentPage--; showPage(currentPage); }
  });

  document.getElementById('next-page').addEventListener('click', () => {
    if (currentPage < totalPages) { currentPage++; showPage(currentPage); }
  });

  showPage(currentPage); 
});
  </script>
@endsection