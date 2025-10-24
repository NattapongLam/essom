<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('computer_histories', function (Blueprint $table) {
    $table->id(); 
    $table->string('no_number')->nullable();
    $table->string('user_name')->nullable();
            $table->date('start_date')->nullable();


            $table->boolean('type_pc')->default(false);
            $table->boolean('type_notebook')->default(false);

      
            $table->string('cpu_spec')->nullable();


            $table->boolean('ram_ddr1')->default(false);
            $table->boolean('ram_ddr2')->default(false);
            $table->boolean('ram_ddr3')->default(false);
            $table->string('dimm1')->nullable();
            $table->date('dimm1_warranty')->nullable();
            $table->date('dimm1_exp')->nullable();
            $table->string('dimm2')->nullable();
            $table->date('dimm2_warranty')->nullable();
            $table->date('dimm2_exp')->nullable();
            $table->string('ram_other')->nullable();


            $table->boolean('hd_ide')->default(false);
            $table->boolean('hd_sata')->default(false);
            $table->boolean('hd_sas')->default(false);
            $table->boolean('hd_other')->default(false);
            $table->integer('hd_qty')->nullable();
            $table->string('disk1')->nullable();
            $table->date('disk1_warranty')->nullable();
            $table->date('disk1_exp')->nullable();
            $table->string('disk2')->nullable();
            $table->date('disk2_warranty')->nullable();
            $table->date('disk2_exp')->nullable();
            $table->string('external_disk')->nullable();


            $table->boolean('cd_ide')->default(false);
            $table->boolean('cd_sata')->default(false);
            $table->integer('cd_qty')->nullable();
            $table->string('cd_drive1')->nullable();
            $table->date('cd1_warranty')->nullable();
            $table->date('cd1_exp')->nullable();
            $table->string('cd_drive2')->nullable();
            $table->date('cd2_warranty')->nullable();
            $table->date('cd2_exp')->nullable();
            $table->string('external_cd')->nullable();

            $table->string('main_board_spec')->nullable();
            $table->string('mb_ide_port')->nullable();
            $table->string('mb_sata_port')->nullable();
            $table->string('mb_usb_port')->nullable();

  
            $table->boolean('vga_onboard')->default(false);
            $table->boolean('vga_display')->default(false);
            $table->boolean('vga_pci')->default(false);
            $table->boolean('vga_pcie')->default(false);
            $table->string('vga_spec')->nullable();

    
            $table->boolean('lan_onboard')->default(false);
            $table->boolean('lan_usb')->default(false);
            $table->boolean('lan_card')->default(false);
            $table->boolean('lan_pci')->default(false);
            $table->boolean('lan_pcie')->default(false);
            $table->string('lan_spec')->nullable();

            $table->boolean('psu_ide')->default(false);
            $table->boolean('psu_sata')->default(false);
            $table->string('psu_watt')->nullable();
            $table->string('psu_result')->nullable();


            $table->string('monitor_spec')->nullable();

            $table->string('accessory')->nullable(); 
            $table->string('mouse')->nullable();
            $table->string('keyboard')->nullable();
            $table->string('sound_card')->nullable();
            $table->string('drive_a')->nullable();
            $table->string('card')->nullable();
            $table->string('speaker')->nullable();
            $table->string('accessory_other')->nullable();

            $table->string('os')->nullable();
            $table->string('office')->nullable();
            $table->string('software_other')->nullable();

            $table->text('problem')->nullable();

            $table->string('check_by')->nullable();
            $table->date('check_date')->nullable();
            $table->string('ack_by')->nullable();
            $table->date('ack_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_histories');
    }
};
