<?php

namespace Database\Factories;

// TopicDataFactory.php
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TopicData;

class TopicDataFactory extends Factory
{
    protected $model = TopicData::class;

    public function definition()
    {
        $csAcademic = $this->faker->unique()->name();
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $projectID = $letters[rand(0, 25)] . $letters[rand(0, 25)] . (string) rand(0, 9);

        return [
            'CS_Academic' => $csAcademic,
            'Project_ID' => $projectID,
            'Research_Area' => $this->faker->text,
            'Project_Name' => $this->faker->text,
            'Project_Detail' => $this->faker->text,
            'Contact' => $this->faker->safeEmail,
            'Suitable_for' => $this->faker->randomElements(['Applied AI', 'AI', 'CS'], $count = 2),
            'Associate_Supervisor' => $this->faker->name,
            'Prerequisite' => $this->faker->text,
            'Quota' => $this->faker->numberBetween(1, 10),
            'References' => $this->faker->text,
        ];
    }
}

