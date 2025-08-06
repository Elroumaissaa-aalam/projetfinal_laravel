<?php

namespace Database\Seeders;

use App\Models\Medication;
use Illuminate\Database\Seeder;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medications = [
            [
                'name' => 'Lisinopril',
                'generic_name' => 'Lisinopril',
                'description' => 'ACE inhibitor used to treat high blood pressure and heart failure',
                'dosage_form' => 'Tablet',
                'strength' => '10mg',
                'side_effects' => 'Dry cough, dizziness, hyperkalemia',
                'contraindications' => 'Pregnancy, bilateral renal artery stenosis',
                'requires_prescription' => true,
            ],
            [
                'name' => 'Metformin',
                'generic_name' => 'Metformin HCl',
                'description' => 'Medication for type 2 diabetes',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'side_effects' => 'Nausea, diarrhea, metallic taste',
                'contraindications' => 'Severe kidney disease, metabolic acidosis',
                'requires_prescription' => true,
            ],
            [
                'name' => 'Amoxicillin',
                'generic_name' => 'Amoxicillin',
                'description' => 'Antibiotic for bacterial infections',
                'dosage_form' => 'Capsule',
                'strength' => '250mg',
                'side_effects' => 'Nausea, rash, diarrhea',
                'contraindications' => 'Penicillin allergy',
                'requires_prescription' => true,
            ],
            [
                'name' => 'Ibuprofen',
                'generic_name' => 'Ibuprofen',
                'description' => 'Nonsteroidal anti-inflammatory drug (NSAID)',
                'dosage_form' => 'Tablet',
                'strength' => '200mg',
                'side_effects' => 'Stomach upset, drowsiness',
                'contraindications' => 'Peptic ulcer disease, severe heart failure',
                'requires_prescription' => false,
            ],
            [
                'name' => 'Acetaminophen',
                'generic_name' => 'Acetaminophen',
                'description' => 'Pain reliever and fever reducer',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'side_effects' => 'Rare at therapeutic doses',
                'contraindications' => 'Severe liver disease',
                'requires_prescription' => false,
            ],
            [
                'name' => 'Amlodipine',
                'generic_name' => 'Amlodipine Besylate',
                'description' => 'Calcium channel blocker for hypertension',
                'dosage_form' => 'Tablet',
                'strength' => '5mg',
                'side_effects' => 'Swelling of ankles, dizziness',
                'contraindications' => 'Severe aortic stenosis',
                'requires_prescription' => true,
            ],
            [
                'name' => 'Simvastatin',
                'generic_name' => 'Simvastatin',
                'description' => 'Statin medication for high cholesterol',
                'dosage_form' => 'Tablet',
                'strength' => '20mg',
                'side_effects' => 'Muscle pain, liver enzyme elevation',
                'contraindications' => 'Active liver disease, pregnancy',
                'requires_prescription' => true,
            ],
            [
                'name' => 'Omeprazole',
                'generic_name' => 'Omeprazole',
                'description' => 'Proton pump inhibitor for acid reflux',
                'dosage_form' => 'Capsule',
                'strength' => '20mg',
                'side_effects' => 'Headache, nausea, diarrhea',
                'contraindications' => 'Hypersensitivity to benzimidazoles',
                'requires_prescription' => false,
            ],
            [
                'name' => 'Albuterol',
                'generic_name' => 'Albuterol Sulfate',
                'description' => 'Bronchodilator for asthma and COPD',
                'dosage_form' => 'Inhaler',
                'strength' => '90mcg/actuation',
                'side_effects' => 'Tremor, nervousness, palpitations',
                'contraindications' => 'Hypersensitivity to albuterol',
                'requires_prescription' => true,
            ],
            [
                'name' => 'Hydrochlorothiazide',
                'generic_name' => 'Hydrochlorothiazide',
                'description' => 'Thiazide diuretic for hypertension',
                'dosage_form' => 'Tablet',
                'strength' => '25mg',
                'side_effects' => 'Dehydration, low potassium',
                'contraindications' => 'Anuria, severe kidney disease',
                'requires_prescription' => true,
            ],
            [
                'name' => 'Aspirin',
                'generic_name' => 'Acetylsalicylic Acid',
                'description' => 'Pain reliever and blood thinner',
                'dosage_form' => 'Tablet',
                'strength' => '81mg',
                'side_effects' => 'Stomach irritation, bleeding risk',
                'contraindications' => 'Active bleeding, children with viral infections',
                'requires_prescription' => false,
            ],
            [
                'name' => 'Levothyroxine',
                'generic_name' => 'Levothyroxine Sodium',
                'description' => 'Thyroid hormone replacement',
                'dosage_form' => 'Tablet',
                'strength' => '50mcg',
                'side_effects' => 'Palpitations, insomnia if overdosed',
                'contraindications' => 'Untreated adrenal insufficiency',
                'requires_prescription' => true,
            ],
        ];

        foreach ($medications as $medication) {
            Medication::create($medication);
        }
    }
}
