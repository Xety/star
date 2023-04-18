<?php

namespace Tests\Feature;

use App\Models\Star;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/star/create');

        $response->assertOk();
    }

    public function test_new_star_page_can_be_created(): void
    {
        $user = User::factory()->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('star.jpg');

        $response = $this
            ->actingAs($user)
            ->post('/star/store', [
                'first_name' => 'Angelina',
                'last_name' => 'Jolie',
                'image' => $file,
                'description' => 'Lorem Ipsum',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('stars', [
            'first_name' => 'Angelina',
            'last_name' => 'Jolie',
            'image' => 'images/stars/' . $file->hashName(),
            'description' => 'Lorem Ipsum',
        ]);
    }

    public function test_edit_star_page_is_displayed_with_infos(): void
    {
        $user = User::factory()->create();
        $star = Star::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/star/edit/' . $star->id);

        $response->assertOk();
        $response->assertSee($star->first_name);
        $response->assertSee($star->last_name);
        $response->assertSee($star->description);
    }

    public function test_star_can_be_updated_without_file(): void
    {
        $user = User::factory()->create();
        $star = Star::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/star/update/' . $star->id, [
                'first_name' => 'Angelina',
                'last_name' => 'Jolie',
                'description' => 'Lorem Ipsum',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $oldFile = $star->image;
        $star->refresh();

        $this->assertSame('Angelina', $star->first_name);
        $this->assertSame('Jolie', $star->last_name);
        $this->assertSame('Lorem Ipsum', $star->description);
        $this->assertSame($oldFile, $star->image, 'The image name should not be changed');
    }

    public function test_star_can_be_updated_with_file(): void
    {
        $user = User::factory()->create();
        $star = Star::factory()->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('star.jpg');

        $response = $this
            ->actingAs($user)
            ->patch('/star/update/' . $star->id, [
                'first_name' => 'Angelina',
                'last_name' => 'Jolie',
                'image' => $file,
                'description' => 'Lorem Ipsum',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $oldFile = $star->image;
        $star->refresh();

        $this->assertSame('Angelina', $star->first_name);
        $this->assertSame('Jolie', $star->last_name);
        $this->assertSame('Lorem Ipsum', $star->description);
        $this->assertNotSame($oldFile, $star->image, 'The image name should be changed');
    }

    public function test_star_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $star = Star::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/star/destroy/' . $star->id);


        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertModelMissing($star);

    }
}