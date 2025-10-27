<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerHistory extends Model
{
    use HasFactory;

    protected $table = 'computer_histories';

    protected $fillable = [
        'user_name',
        'no_number', 
        'start_date',

        // Computer Type
        'type_pc',
        'type_notebook',

        // CPU / Spec
        'cpu_spec',

        // RAM
        'ram_ddr1',
        'ram_ddr2',
        'ram_ddr3',
        'dimm1',
        'dimm1_warranty',
        'dimm1_exp',
        'dimm2',
        'dimm2_warranty',
        'dimm2_exp',
        'ram_other',

        // Hard Disk
        'hd_ide',
        'hd_sata',
        'hd_sas',
        'hd_other',
        'hd_qty',
        'disk1',
        'disk1_warranty',
        'disk1_exp',
        'disk2',
        'disk2_warranty',
        'disk2_exp',
        'external_disk',

        // CD/DVD
        'cd_ide',
        'cd_sata',
        'cd_qty',
        'cd_drive1',
        'cd1_warranty',
        'cd1_exp',
        'cd_drive2',
        'cd2_warranty',
        'cd2_exp',
        'external_cd',

        // Mainboard
        'main_board_spec',
        'mb_ide_port',
        'mb_sata_port',
        'mb_usb_port',

        // VGA
        'vga_onboard',
        'vga_display',
        'vga_pci',
        'vga_pcie',
        'vga_spec',

        // LAN
        'lan_onboard',
        'lan_usb',
        'lan_card',
        'lan_pci',
        'lan_pcie',
        'lan_spec',

        // Power
        'psu_ide',
        'psu_sata',
        'psu_watt',
        'psu_result',

        // Monitor
        'monitor_spec',

        // Accessories
        'accessory',
        'mouse',
        'keyboard',
        'sound_card',
        'drive_a',
        'card',
        'speaker',
        'accessory_other',

        // Software
        'os',
        'office',
        'software_other',

        // Maintenance
        'problem',

        // Signature
        'check_by',
        'check_date',
        'ack_by',
        'ack_date',
    ];
}
