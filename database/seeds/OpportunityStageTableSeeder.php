<?php

use Curema\Models\App\OpportunityStage;
use Illuminate\Database\Seeder;

class OpportunityStageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OpportunityStage::create(["name" => "Qualification"]);
        OpportunityStage::create(["name" => "Proposal"]);
        OpportunityStage::create(["name" => "Negotiation"]);
        OpportunityStage::create(["name" => "Closed Won"]);
        OpportunityStage::create(["name" => "Closed Lost"]);
    }
}
