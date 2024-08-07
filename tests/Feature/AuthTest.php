<?php

describe('auth', function () {
    it('should login', function () {
        $this->postJson('api/auth/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ])
            ->assertJson([
                'success' => true,
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'access_token',
                ],
            ]);
    });

    it('should logout', function () {
        $user = $this->user;

        $this->actingAs($user)
            ->postJson('api/auth/logout')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => null,
            ]);
    });
});