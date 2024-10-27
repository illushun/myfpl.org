<?php

namespace Tests\Feature\Livewire;

use App\Livewire\IndexComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexComponentTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(IndexComponent::class)
            ->assertStatus(200);
    }
}
