<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Requirement;

class AddInitialRequirementsToRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $requirements = [
            'Barmaq izi',
            'Giriş çıxış kartı',
            'Email adres üçün şəkil çəkilmə və imzanın hazırlanması',
            'Korporativ nömrənin təqdim edilməsi (ehtiyac olduqda)',
            'Daxili nömrənin təqdim edilməsi (ehtiyac olduqda)',
            'İş otağı və iş yeri',
            'İş yoldaşları ilə tanışlıq',
            'Kompüter və digər ofis avadanlıqlarının təqdim və təhkim edilməsi',
            'Korporativ e-mailin açılması',
            'E-mail ünvanının qruplarına əlavə edilməsi (ehtiyac olduqda)',
            'Mobil nömrənin whatsapp qruplarına əlavə edilməsi',
            'Dəftərxana ləvazimatlarının təqdim edilməsi',
            'Yanacaq kartının təqdim və təhkim edilməsi (ehtiyac olduqda)',
            'Tiket sisteminə giriş hüququ (ehtiyac olduqda)',
            'Şöbənin fəaliyyət istiqamətləri barədə ümumi məlumatlar',
            'Daxili prosedurlar və qaydalar',
            'Vəzifəsi ilə əlaqəli sahələrin göstərilməsi'
        ];

        foreach ($requirements as $requirement) {
            Requirement::create(['name' => $requirement]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Requirement::whereIn('name', [
            'Barmaq izi',
            'Giriş çıxış kartı',
            'Email adres üçün şəkil çəkilmə və imzanın hazırlanması',
            'Korporativ nömrənin təqdim edilməsi (ehtiyac olduqda)',
            'Daxili nömrənin təqdim edilməsi (ehtiyac olduqda)',
            'İş otağı və iş yeri',
            'İş yoldaşları ilə tanışlıq',
            'Kompüter və digər ofis avadanlıqlarının təqdim və təhkim edilməsi',
            'Korporativ e-mailin açılması',
            'E-mail ünvanının qruplarına əlavə edilməsi (ehtiyac olduqda)',
            'Mobil nömrənin whatsapp qruplarına əlavə edilməsi',
            'Dəftərxana ləvazimatlarının təqdim edilməsi',
            'Yanacaq kartının təqdim və təhkim edilməsi (ehtiyac olduqda)',
            'Tiket sisteminə giriş hüququ (ehtiyac olduqda)',
            'Şöbənin fəaliyyət istiqamətləri barədə ümumi məlumatlar',
            'Daxili prosedurlar və qaydalar',
            'Vəzifəsi ilə əlaqəli sahələrin göstərilməsi'
        ])->delete();
    }
    
}
