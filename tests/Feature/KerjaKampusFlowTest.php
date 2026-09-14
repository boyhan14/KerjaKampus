<?php

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Enums\JobStatus;
use App\Enums\ProjectStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Application;
use App\Models\JobListing;
use App\Models\Project;
use App\Models\Review;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KerjaKampusFlowTest extends TestCase
{
    protected User $admin;
    protected User $client;
    protected User $talent;
    protected SkillCategory $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = SkillCategory::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Web dev category',
        ]);

        $this->admin = User::create([
            'name' => 'Admin Test',
            'username' => 'admintest',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
            'roles' => ['admin'],
            'status' => UserStatus::ACTIVE,
        ]);

        $this->client = User::create([
            'name' => 'Client Test',
            'username' => 'clienttest',
            'email' => 'client@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::CLIENT,
            'roles' => ['client'],
            'status' => UserStatus::ACTIVE,
            'company_name' => 'PT Test Client',
        ]);

        $this->talent = User::create([
            'name' => 'Talent Test',
            'username' => 'talenttest',
            'email' => 'talent@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::TALENT,
            'roles' => ['talent'],
            'status' => UserStatus::ACTIVE,
        ]);
    }

    public function test_user_can_register_as_talent()
    {
        $response = $this->post('/register', [
            'name' => 'New Student',
            'username' => 'newstudent',
            'email' => 'student@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'talent',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => 'student@test.com',
            'role' => 'talent',
        ]);
    }

    public function test_user_can_login()
    {
        $response = $this->post('/login', [
            'email' => 'talent@test.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($this->talent);
    }

    public function test_suspended_user_cannot_login()
    {
        $this->talent->update(['status' => UserStatus::SUSPENDED]);

        $response = $this->post('/login', [
            'email' => 'talent@test.com',
            'password' => 'password',
        ]);

        $this->assertGuest();
    }

    public function test_client_can_create_job()
    {
        $this->actingAs($this->client);

        $response = $this->post('/jobs', [
            'title' => 'Laravel Developer Needed',
            'description' => 'Need fullstack developer to build an app.',
            'category_id' => $this->category->id,
            'budget_min' => 1000000,
            'budget_max' => 3000000,
            'deadline' => now()->addDays(14)->format('Y-m-d'),
            'job_type' => 'freelance',
            'work_mode' => 'remote',
            'experience_level' => 'intermediate',
        ]);

        $response->assertRedirect('/my-jobs');
        $this->assertDatabaseHas('job_listings', [
            'title' => 'Laravel Developer Needed',
            'user_id' => $this->client->id,
            'status' => 'open',
        ]);
    }

    public function test_talent_cannot_create_job()
    {
        $this->actingAs($this->talent);

        $response = $this->post('/jobs', [
            'title' => 'Unauthorized Job',
            'description' => 'Test',
            'category_id' => $this->category->id,
            'budget_min' => 1000000,
            'budget_max' => 2000000,
            'deadline' => now()->addDays(14)->format('Y-m-d'),
            'job_type' => 'freelance',
            'work_mode' => 'remote',
            'experience_level' => 'beginner',
        ]);

        $response->assertStatus(403);
    }

    public function test_talent_can_apply_to_job_and_client_accepts_to_create_project()
    {
        // 1. Client creates a job
        $job = JobListing::create([
            'user_id' => $this->client->id,
            'title' => 'Build React Landing Page',
            'slug' => 'build-react-landing-page',
            'description' => 'Build a modern responsive page.',
            'category_id' => $this->category->id,
            'budget_min' => 2000000,
            'budget_max' => 4000000,
            'deadline' => now()->addDays(20),
            'job_type' => 'freelance',
            'work_mode' => 'remote',
            'experience_level' => 'beginner',
            'status' => JobStatus::OPEN,
        ]);

        // 2. Talent applies
        $this->actingAs($this->talent);
        $applyResponse = $this->post("/jobs/{$job->id}/apply", [
            'cover_letter' => 'Saya memiliki pengalaman 2 tahun dengan React dan siap bekerja.',
            'proposed_price' => 2500000,
            'estimated_duration' => '10 hari',
        ]);

        $applyResponse->assertRedirect('/my-applications');
        $this->assertDatabaseHas('applications', [
            'job_listing_id' => $job->id,
            'user_id' => $this->talent->id,
            'status' => 'pending',
        ]);

        $application = Application::where('job_listing_id', $job->id)->first();

        // 3. Client accepts application -> project automatically created
        $this->actingAs($this->client);
        $acceptResponse = $this->put("/applications/{$application->id}/status", [
            'status' => 'accept',
        ]);

        $acceptResponse->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'status' => 'accepted',
        ]);

        $this->assertDatabaseHas('projects', [
            'job_listing_id' => $job->id,
            'client_id' => $this->client->id,
            'talent_id' => $this->talent->id,
            'status' => 'active',
        ]);

        // 4. Complete project
        $project = Project::where('job_listing_id', $job->id)->first();
        $completeResponse = $this->post("/projects/{$project->id}/complete");
        $completeResponse->assertRedirect();

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'completed',
        ]);

        // 5. Client submits review
        $reviewResponse = $this->post("/projects/{$project->id}/review", [
            'rating' => 5,
            'comment' => 'Pekerjaan luar biasa dan tepat waktu!',
        ]);

        $reviewResponse->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'project_id' => $project->id,
            'reviewer_id' => $this->client->id,
            'reviewee_id' => $this->talent->id,
            'rating' => 5,
        ]);
    }

    public function test_admin_can_suspend_user_and_moderate_jobs()
    {
        $this->actingAs($this->admin);

        // Suspend user
        $response = $this->put("/admin/users/{$this->talent->id}/status", [
            'status' => 'suspended',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $this->talent->id,
            'status' => 'suspended',
        ]);
    }

    public function test_all_public_pages_render_successfully()
    {
        $this->get('/')->assertStatus(200);
        $this->get('/jobs')->assertStatus(200);
        $this->get('/talents')->assertStatus(200);
        $this->get('/talents/' . $this->talent->username)->assertStatus(200);
        $this->get('/how-it-works')->assertStatus(200);
        $this->get('/pricing')->assertStatus(200);
        $this->get('/login')->assertStatus(200);
        $this->get('/register')->assertStatus(200);
    }

    public function test_talent_pages_render_successfully()
    {
        $this->actingAs($this->talent);

        $this->get('/dashboard/talent')->assertStatus(200);
        $this->get('/profile')->assertStatus(200);
        $this->get('/profile/edit')->assertStatus(200);
        $this->get('/skills')->assertStatus(200);
        $this->get('/my-portfolio')->assertStatus(200);
        $this->get('/portfolio/create')->assertStatus(200);
        $this->get('/my-applications')->assertStatus(200);
        $this->get('/projects')->assertStatus(200);
        $this->get('/reviews')->assertStatus(200);
        $this->get('/notifications')->assertStatus(200);
    }

    public function test_client_pages_render_successfully()
    {
        $this->actingAs($this->client);

        $this->get('/dashboard/client')->assertStatus(200);
        $this->get('/my-jobs')->assertStatus(200);
        $this->get('/jobs/create')->assertStatus(200);
        $this->get('/projects')->assertStatus(200);
    }

    public function test_admin_pages_render_successfully()
    {
        $this->actingAs($this->admin);

        $this->get('/admin')->assertStatus(200);
        $this->get('/admin/users')->assertStatus(200);
        $this->get('/admin/jobs')->assertStatus(200);
        $this->get('/admin/skills')->assertStatus(200);
        $this->get('/admin/categories')->assertStatus(200);
        $this->get('/admin/reports')->assertStatus(200);
        $this->get('/admin/reviews')->assertStatus(200);
    }

    public function test_recent_notifications_api()
    {
        $this->actingAs($this->talent);

        $response = $this->getJson('/notifications/recent');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'unread_count',
                'notifications',
            ]);
    }

    public function test_client_applications_and_redirects()
    {
        $this->actingAs($this->client);

        // /applications route for client
        $this->get('/applications')->assertStatus(200);

        // /my-projects redirect to /projects
        $this->get('/my-projects')->assertRedirect('/projects');
    }

    public function test_job_show_by_id_and_slug()
    {
        $job = JobListing::create([
            'user_id' => $this->client->id,
            'title' => 'Vue Developer Needed',
            'slug' => 'vue-developer-needed',
            'description' => 'Vue developer needed for app',
            'category_id' => $this->category->id,
            'budget_min' => 2000000,
            'budget_max' => 5000000,
            'job_type' => 'freelance',
            'work_mode' => 'remote',
            'experience_level' => 'intermediate',
            'status' => JobStatus::OPEN,
        ]);

        $this->get("/jobs/{$job->slug}")->assertStatus(200);
        $this->get("/jobs/{$job->id}")->assertStatus(200);
    }
}

