@extends('layouts.main') <!-- ปรับชื่อ Layout หลักของคุณให้ตรงกัน เช่น layouts.admin หรือโครงสร้างหลักที่คุณใช้ -->

@section('title', 'รายการแจ้งเตือนเอกสารทั้งหมด')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-bell mr-2"></i> รายการแจ้งเตือนเอกสารทั้งหมดจากระบบ</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>ประเภทเอกสาร</th>
                                <th>ผู้เกี่ยวข้อง (Person)</th>
                                <th>สถานะ</th>
                                <th>รายละเอียด (Remark)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $key => $item)
                                <tr>
                                    <td>{{ $notifications->firstItem() + $key }}</td>
                                    <td>{{ $item->docutype }}</td>
                                    <td>{{ $item->person }}</td>
                                    <td>
                                        <span class="badge badge-warning">{{ $item->status }}</span>
                                    </td>
                                    <td>{{ $item->remark }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">ไม่มีรายการแจ้งเตือนในขณะนี้</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <!-- Pagination -->
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection