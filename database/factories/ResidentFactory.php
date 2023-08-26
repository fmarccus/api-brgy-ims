<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = fake()->randomElement($array = array('Male', 'Female'));
        $pwd = fake()->randomElement($array = array('Yes', 'No'));
        $employed = fake()->randomElement($array = array('Yes', 'No'));
        $income = fake()->numberBetween($min = 11000, $max = 100000);
        $birthDate = fake()->date($format = 'Y-m-d', $max = 'now');
        return [
            'household_id' => fake()->numberBetween($min = 1, $max = 500),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'birth_date' => $birthDate,
            'age' => Carbon::parse($birthDate)->age,
            'sex' => $sex,
            'pregnant' => ($sex == 'Male') ? 'No' : $sex,
            'civil_status' => fake()->randomElement($array = array('Single', 'Married', 'Annulled', 'Separated', 'Widowed')),
            'religion' => fake()->randomElement($array = array('Catholic', 'Islam', 'INC', 'PIC', 'Adventist', 'Baptist', 'UCCP', 'Jehova', 'COC', 'Others', 'None')),
            'contact' => fake()->phoneNumber(),
            'nationality' => fake()->randomElement($array = array('Filipino', 'Others')),
            'household_head' => fake()->randomElement($array = array('Yes', 'No')),
            'bona_fide' => fake()->randomElement($array = array('Yes', 'No')),
            'resident_six_months' => fake()->randomElement($array = array('Yes', 'No')),
            'solo_parent' => fake()->randomElement($array = array('Yes', 'No')),
            'voter' => fake()->randomElement($array = array('Yes', 'No')),
            'pwd' => $pwd,
            'disability' => ($pwd == 'Yes') ? fake()->randomElement($array = array('Hearing', 'Intellectual', 'Learning', 'Mental', 'Orthopedic', 'Psychosocial', 'Speech', 'Visual', 'Cancer', 'Rare'))  : NULL,
            'studying' => fake()->randomElement($array = array('Yes', 'No')),
            'highest_education' => fake()->randomElement($array = array('None', 'Elementary', 'JHS', 'SHS', 'College', 'Postgrad')),
            'employed' => $employed,
            'job_title' => ($employed == 'Yes') ? fake()->randomElement($array = array('Manual', 'Professionals', 'Government', 'Private', 'Driver', 'Househelper', 'Lending', 'Sales', 'Agricultural', 'Others')) : NULL,
            'income' => ($employed == 'Yes') ? $income : NULL,
            'income_classification' => $this->getIncomeClassification($income),
        ];
    }
    private function getIncomeClassification($income)
    {
        if ($income > 0 && $income <= 10957) {
            $income_classification = "Poor";
        } elseif ($income > 10957 && $income <= 21194) {
            $income_classification = "Low income";
        } elseif ($income > 21194 && $income <= 43828) {
            $income_classification = "Lower middle class";
        } elseif ($income > 43828 && $income <= 76669) {
            $income_classification = "Middle class";
        } elseif ($income > 76670 && $income <= 131484) {
            $income_classification = "Upper middle class";
        } elseif ($income > 131484 && $income <= 219140) {
            $income_classification = "High income";
        } elseif ($income > 219140) {
            $income_classification = "Rich";
        } elseif ($income === NULL) {
            $income_classification = NULL;
        } else {
            $income_classification = "No data";
        }
        return $income_classification;
    }
}
