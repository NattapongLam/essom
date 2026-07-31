@extends('layouts.main')
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
                            {{-- ป้องกัน Error ด้วยการเช็คว่ามีตัวแปร $notifications ส่งมาหรือไม่ --}}
                            @if(isset($notifications) && count($notifications) > 0)
                                @foreach($notifications as $key => $item)
                                    <tr>
                                        <td>{{ method_exists($notifications, 'firstItem') ? $notifications->firstItem() + $key : $key + 1 }}</td>
                                        <td>{{ $item->docutype ?? '' }}</td>
                                        <td>{{ $item->person ?? '' }}</td>
                                        <td>
                                            <span class="badge badge-warning">{{ $item->status ?? '' }}</span>
                                        </td>
                                        <td>{{ $item->remark ?? '' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted">ไม่มีรายการแจ้งเตือนในขณะนี้</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{-- ป้องกัน Error ที่ปุ่ม Pagination กรณีตัวแปรยังไม่ถูกส่งมา --}}
                    @if(isset($notifications) && method_exists($notifications, 'links'))
                        {{ $notifications->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection