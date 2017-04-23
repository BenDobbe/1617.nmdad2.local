<?php

namespace Tests\Unit;

use App\Models\Vote;
use Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VoteVerificationTest extends TestCase
{
    /**
     * @return void
     * @test
     */
    public function a_vote_verification_should_succeed_with_correct_password_()
    {
        $vote = Vote::all()->random(1)->first();

        $hashedValue = $vote->checksum;
        $vote->checksum = 'secret'; // Original password;
        // Decode and re-encode JSON to make sure it is PHP JSON, not MySQL JSON.
        $vote->details = $vote->details;
        $data = $vote->getAttributes();
        ksort($data);
        $value = hash('sha512', (json_encode($data)).$vote->checksum);
        // \Log::debug([$data, $value]);
        $this->assertTrue(Hash::check($value, $hashedValue));
    }

    /**
     * @return void
     * @test
     */
    public function a_vote_verification_should_fail_with_wrong_password_()
    {
        $vote = Vote::all()->random(1)->first();

        $hashedValue = $vote->checksum;
        $vote->checksum = 'wrongpassword'; // Original password;
        // Decode and re-encode JSON to make sure it is PHP JSON, not MySQL JSON.
        $vote->details = $vote->details;
        $data = $vote->getAttributes();
        ksort($data);
        $value = hash('sha512', (json_encode($data)).$vote->checksum);
        // \Log::debug([$data, $value]);
        $this->assertFalse(Hash::check($value, $hashedValue));
    }
}
