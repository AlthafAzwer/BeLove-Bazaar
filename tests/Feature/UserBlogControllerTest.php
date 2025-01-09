<?php

use App\Models\User;
use App\Models\Blog;

test('guest cannot view blogs and is redirected to login', function () {
    Blog::factory()->count(3)->create();

    $response = $this->get(route('blogs.index'));

    $response->assertRedirect(route('login'));
});

test('guest cannot view a single blog and is redirected to login', function () {
    $blog = Blog::factory()->create();

    $response = $this->get(route('blogs.show', $blog->id));

    $response->assertRedirect(route('login'));
});

test('guest cannot delete a blog and is redirected to login', function () {
    $blog = Blog::factory()->create();

    $response = $this->delete(route('admin.blogs.destroy', $blog->id));

    $response->assertRedirect(route('login'));
});
