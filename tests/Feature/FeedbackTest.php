<?php

namespace Tests\Feature;

use App\Jobs\SyncFeedbackToGoogleSheets;
use App\Models\FeedbackSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    private function validData(string $token): array
    {
        return [
            'submission_token' => $token,
            'name' => 'Test Visitor',
            'company_name' => 'Example Company',
            'email' => 'visitor@example.com',
            'job_title' => 'Manager',
            'heard_from' => 'social_media',
            'heard_from_other' => null,
            'booth_rating' => 5,
            'booth_design' => 'yes',
            'attention_aspect' => 'visuals_graphics',
            'attention_aspect_other' => null,
            'representative_rating' => 'very_knowledgeable',
            'learned_something' => 'yes',
            'improvements' => 'More demonstrations.',
            'interested_products' => 'Energy solutions',
            'presentation_feedback' => 'Clear and useful.',
            'overall_satisfaction' => 'very_satisfied',
            'recommendation' => 'yes',
            'additional_comments' => null,
        ];
    }

    public function test_homepage_returns_200(): void
    {
        $this->get('/')->assertOk()->assertSee('Pertamina NAPEC 2026');
    }

    public function test_english_page_returns_200(): void
    {
        $this->get('/en')->assertOk()->assertSee('Visitor Information');
    }

    public function test_french_page_returns_200(): void
    {
        $this->get('/fr')->assertOk()->assertSee('Renseignements concernant le visiteur');
    }

    public function test_valid_english_submission_is_saved_and_job_dispatched(): void
    {
        Queue::fake();
        $this->get('/en');
        $token = session('feedback_form_token.en');

        $this->post('/en', $this->validData($token))->assertRedirect(route('feedback.success'));

        $this->assertDatabaseHas('feedback_submissions', [
            'language' => 'en',
            'email' => 'visitor@example.com',
            'booth_rating' => 5,
        ]);
        Queue::assertPushed(SyncFeedbackToGoogleSheets::class);
    }

    public function test_valid_french_submission_is_saved(): void
    {
        Queue::fake();
        $this->get('/fr');
        $token = session('feedback_form_token.fr');
        $data = $this->validData($token);
        $data['recommendation'] = 'additional';
        $data['additional_comments'] = 'Merci.';

        $this->post('/fr', $data)->assertRedirect(route('feedback.success'));
        $this->assertDatabaseHas('feedback_submissions', ['language' => 'fr']);
    }

    public function test_invalid_email_is_rejected(): void
    {
        $this->get('/en');
        $data = $this->validData(session('feedback_form_token.en'));
        $data['email'] = 'not-an-email';

        $this->from('/en')->post('/en', $data)->assertSessionHasErrors('email');
        $this->assertDatabaseCount('feedback_submissions', 0);
    }

    public function test_rating_outside_one_to_five_is_rejected(): void
    {
        $this->get('/en');
        $data = $this->validData(session('feedback_form_token.en'));
        $data['booth_rating'] = 6;

        $this->from('/en')->post('/en', $data)->assertSessionHasErrors('booth_rating');
        $this->assertDatabaseCount('feedback_submissions', 0);
    }

    public function test_required_fields_are_rejected(): void
    {
        $this->get('/en');
        $token = session('feedback_form_token.en');

        $this->from('/en')->post('/en', ['submission_token' => $token])->assertSessionHasErrors(['name', 'company_name', 'email', 'job_title']);
    }

    public function test_same_form_token_cannot_create_a_duplicate_submission(): void
    {
        Queue::fake();
        $this->get('/en');
        $token = session('feedback_form_token.en');
        $data = $this->validData($token);

        $this->post('/en', $data)->assertRedirect(route('feedback.success'));
        $this->post('/en', $data)->assertRedirect(route('feedback.success'));

        $this->assertDatabaseCount('feedback_submissions', 1);
    }
}
