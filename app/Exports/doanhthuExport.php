<?php
namespace App\Exports;

use App\HoaDon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class doanhthuExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct($TuNgay=null, $DenNgay=null)
    {
        $this->TuNgay = Carbon::now()->startOfMonth();
        if ($TuNgay!=null)
        $this->TuNgay = $TuNgay;
        $this->DenNgay = Carbon::now()->endOfMonth();
        if ($DenNgay!=null)
        $this->DenNgay = $DenNgay;
    }
    public function headings(): array
    {
        return [
            'Mã HĐ',
            'Ngày lập hóa đơn',
            'NV lập hóa đơn',
            'Địa chỉ',
            'Khách hàng',
            'Số điện thoại',
            'Tổng tiền'
        ];
    }
    public function collection()
    {
        $danhsachhoadon = HoaDon::where('status', 3)
        // ->where('ThoiGian', '>=', $this->TuNgay)->where('ThoiGian', '<=', $this->DenNgay)
        ->get()->map(function($item) {
            $result = [
                'id' => $item->id,
                'time_buy' => $item->time_buy,
                'user_id' => $item->nhanvien->fullname,
                'address' => $item->address,
                'customer_name' => $item->customer_name,
                'phone' => $item->phone,
                'tongtien' => $item->tongtien()
            ];
            return $result;
        });
        return $danhsachhoadon;
    }
}
