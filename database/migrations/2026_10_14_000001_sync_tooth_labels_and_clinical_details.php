<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->updateTeethLabelsFromUi();
        $this->backfillSpecificClinicalDetails();
    }

    public function down(): void
    {
        // Safe data backfill migration - intentionally non-destructive on rollback.
    }

    private function getTeethMapping(): array
    {
        return [
            // Permanent Maxillary Right (Quadrant 1)
            18 => ['universal' => '1', 'name' => 'Maxillary Right Third Molar'],
            17 => ['universal' => '2', 'name' => 'Maxillary Right Second Molar'],
            16 => ['universal' => '3', 'name' => 'Maxillary Right First Molar'],
            15 => ['universal' => '4', 'name' => 'Maxillary Right Second Premolar'],
            14 => ['universal' => '5', 'name' => 'Maxillary Right First Premolar'],
            13 => ['universal' => '6', 'name' => 'Maxillary Right Canine'],
            12 => ['universal' => '7', 'name' => 'Maxillary Right Lateral Incisor'],
            11 => ['universal' => '8', 'name' => 'Maxillary Right Central Incisor'],

            // Permanent Maxillary Left (Quadrant 2)
            21 => ['universal' => '9', 'name' => 'Maxillary Left Central Incisor'],
            22 => ['universal' => '10', 'name' => 'Maxillary Left Lateral Incisor'],
            23 => ['universal' => '11', 'name' => 'Maxillary Left Canine'],
            24 => ['universal' => '12', 'name' => 'Maxillary Left First Premolar'],
            25 => ['universal' => '13', 'name' => 'Maxillary Left Second Premolar'],
            26 => ['universal' => '14', 'name' => 'Maxillary Left First Molar'],
            27 => ['universal' => '15', 'name' => 'Maxillary Left Second Molar'],
            28 => ['universal' => '16', 'name' => 'Maxillary Left Third Molar'],

            // Permanent Mandibular Left (Quadrant 3)
            38 => ['universal' => '17', 'name' => 'Mandibular Left Third Molar'],
            37 => ['universal' => '18', 'name' => 'Mandibular Left Second Molar'],
            36 => ['universal' => '19', 'name' => 'Mandibular Left First Molar'],
            35 => ['universal' => '20', 'name' => 'Mandibular Left Second Premolar'],
            34 => ['universal' => '21', 'name' => 'Mandibular Left First Premolar'],
            33 => ['universal' => '22', 'name' => 'Mandibular Left Canine'],
            32 => ['universal' => '23', 'name' => 'Mandibular Left Lateral Incisor'],
            31 => ['universal' => '24', 'name' => 'Mandibular Left Central Incisor'],

            // Permanent Mandibular Right (Quadrant 4)
            41 => ['universal' => '25', 'name' => 'Mandibular Right Central Incisor'],
            42 => ['universal' => '26', 'name' => 'Mandibular Right Lateral Incisor'],
            43 => ['universal' => '27', 'name' => 'Mandibular Right Canine'],
            44 => ['universal' => '28', 'name' => 'Mandibular Right First Premolar'],
            45 => ['universal' => '29', 'name' => 'Mandibular Right Second Premolar'],
            46 => ['universal' => '30', 'name' => 'Mandibular Right First Molar'],
            47 => ['universal' => '31', 'name' => 'Mandibular Right Second Molar'],
            48 => ['universal' => '32', 'name' => 'Mandibular Right Third Molar'],

            // Primary Maxillary Right (Quadrant 5)
            55 => ['universal' => 'A', 'name' => 'Primary Maxillary Right Second Molar'],
            54 => ['universal' => 'B', 'name' => 'Primary Maxillary Right First Molar'],
            53 => ['universal' => 'C', 'name' => 'Primary Maxillary Right Canine'],
            52 => ['universal' => 'D', 'name' => 'Primary Maxillary Right Lateral Incisor'],
            51 => ['universal' => 'E', 'name' => 'Primary Maxillary Right Central Incisor'],

            // Primary Maxillary Left (Quadrant 6)
            61 => ['universal' => 'F', 'name' => 'Primary Maxillary Left Central Incisor'],
            62 => ['universal' => 'G', 'name' => 'Primary Maxillary Left Lateral Incisor'],
            63 => ['universal' => 'H', 'name' => 'Primary Maxillary Left Canine'],
            64 => ['universal' => 'I', 'name' => 'Primary Maxillary Left First Molar'],
            65 => ['universal' => 'J', 'name' => 'Primary Maxillary Left Second Molar'],

            // Primary Mandibular Left (Quadrant 7)
            75 => ['universal' => 'K', 'name' => 'Primary Mandibular Left Second Molar'],
            74 => ['universal' => 'L', 'name' => 'Primary Mandibular Left First Molar'],
            73 => ['universal' => 'M', 'name' => 'Primary Mandibular Left Canine'],
            72 => ['universal' => 'N', 'name' => 'Primary Mandibular Left Lateral Incisor'],
            71 => ['universal' => 'O', 'name' => 'Primary Mandibular Left Central Incisor'],

            // Primary Mandibular Right (Quadrant 8)
            81 => ['universal' => 'P', 'name' => 'Primary Mandibular Right Central Incisor'],
            82 => ['universal' => 'Q', 'name' => 'Primary Mandibular Right Lateral Incisor'],
            83 => ['universal' => 'R', 'name' => 'Primary Mandibular Right Canine'],
            84 => ['universal' => 'S', 'name' => 'Primary Mandibular Right First Molar'],
            85 => ['universal' => 'T', 'name' => 'Primary Mandibular Right Second Molar'],
        ];
    }

    private function updateTeethLabelsFromUi(): void
    {
        if (! Schema::hasTable('teeth')) {
            return;
        }

        $teethMap = $this->getTeethMapping();

        foreach (DB::table('teeth')->get() as $tooth) {
            $fdi = (int) $tooth->fdi_number;
            if (isset($teethMap[$fdi])) {
                $label = 'Tooth '.$teethMap[$fdi]['universal'].' · '.$teethMap[$fdi]['name'];
                DB::table('teeth')->where('id', $tooth->id)->update([
                    'label' => $label,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function backfillSpecificClinicalDetails(): void
    {
        if (! Schema::hasTable('clinical_sessions') || ! Schema::hasTable('dental_chart_entries')) {
            return;
        }

        $sessions = DB::table('clinical_sessions')->get();

        foreach ($sessions as $session) {
            $entries = DB::table('dental_chart_entries')
                ->join('teeth', 'dental_chart_entries.tooth_id', '=', 'teeth.id')
                ->where('dental_chart_entries.clinical_session_id', $session->id)
                ->select(
                    'dental_chart_entries.condition',
                    'dental_chart_entries.notes',
                    'teeth.label as tooth_label',
                    'teeth.fdi_number'
                )
                ->orderBy('dental_chart_entries.tooth_id')
                ->get();

            if ($entries->isNotEmpty()) {
                $findingsList = [];
                $diagnosisList = [];
                $treatmentList = [];

                foreach ($entries as $entry) {
                    $toothLabel = $entry->tooth_label;
                    $condition = $entry->condition ?: 'Clinical finding noted';
                    $note = trim((string) ($entry->notes ?? ''));

                    $findingsList[] = $toothLabel.': '.$condition.($note ? ' ('.$note.')' : '');
                    $diagnosisList[] = $toothLabel.': '.$this->conditionDiagnosis($condition);
                    $treatmentList[] = $toothLabel.': '.$this->conditionTreatment($condition);
                }

                $findingsJson = json_encode(array_values(array_unique($findingsList)));
                $diagnosisText = implode("\n", array_unique($diagnosisList));
                $treatmentText = implode("\n", array_unique($treatmentList));

                DB::table('clinical_sessions')->where('id', $session->id)->update([
                    'clinical_findings' => $findingsJson,
                    'diagnosis' => $diagnosisText,
                    'treatment_recommendations' => $treatmentText,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function conditionDiagnosis(string $condition): string
    {
        $c = strtolower(trim($condition));
        if (str_contains($c, 'caries') || str_contains($c, 'decay')) {
            return 'Dental Caries (Enamel/Dentin involvement)';
        }
        if (str_contains($c, 'root fragment')) {
            return 'Retained Root Fragment / Tip';
        }
        if (str_contains($c, 'amalgam')) {
            return 'Existing Amalgam Restoration';
        }
        if (str_contains($c, 'composite') || str_contains($c, 'restoration')) {
            return 'Restored Tooth (Composite)';
        }
        if (str_contains($c, 'temporary')) {
            return 'Previously Treated Tooth with Temporary Filling';
        }
        if (str_contains($c, 'missing') || str_contains($c, 'extracted')) {
            return 'Edentulous Tooth Space (Missing/Extracted)';
        }
        if (str_contains($c, 'unerupted')) {
            return 'Unerupted Tooth (Developmental / Eruption Monitoring)';
        }
        if (str_contains($c, 'impacted')) {
            return 'Impacted Tooth';
        }
        if (str_contains($c, 'sealant')) {
            return 'Preventive Pit and Fissure Sealant';
        }
        if (str_contains($c, 'crown')) {
            return 'Full Coverage Prosthetic Crown';
        }
        if (str_contains($c, 'root canal')) {
            return 'Endodontically Treated Tooth';
        }
        if (str_contains($c, 'sound') || str_contains($c, 'healthy') || str_contains($c, 'present')) {
            return 'Sound and Intact Tooth Structure';
        }

        return $condition;
    }

    private function conditionTreatment(string $condition): string
    {
        $c = strtolower(trim($condition));
        if (str_contains($c, 'caries') || str_contains($c, 'decay')) {
            return 'Composite Light-Cured Restoration';
        }
        if (str_contains($c, 'root fragment')) {
            return 'Surgical Root Extraction / Excision';
        }
        if (str_contains($c, 'amalgam')) {
            return 'Restorative Evaluation / Polishing';
        }
        if (str_contains($c, 'composite') || str_contains($c, 'restoration')) {
            return 'Routine Oral Care & Prophylaxis';
        }
        if (str_contains($c, 'temporary')) {
            return 'Permanent Restorative Treatment';
        }
        if (str_contains($c, 'missing') || str_contains($c, 'extracted')) {
            return 'Prosthetic Replacement / Space Maintenance';
        }
        if (str_contains($c, 'unerupted')) {
            return 'Periodic Radiographic & Clinical Monitoring';
        }
        if (str_contains($c, 'impacted')) {
            return 'Surgical Extraction / Orthodontic Consultation';
        }
        if (str_contains($c, 'sealant')) {
            return 'Preventive Maintenance & Recall';
        }
        if (str_contains($c, 'crown')) {
            return 'Crown Margin Check & Maintenance';
        }
        if (str_contains($c, 'root canal')) {
            return 'Post-Endodontic Restoration / Crown';
        }
        if (str_contains($c, 'sound') || str_contains($c, 'healthy') || str_contains($c, 'present')) {
            return 'Routine Oral Hygiene Prophylaxis & Recall';
        }

        return 'Clinical Evaluation & Monitoring';
    }
};
