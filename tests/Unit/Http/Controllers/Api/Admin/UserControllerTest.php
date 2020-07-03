<?php


namespace Tests\Unit\Http\Controllers\Api\Admin;



use App\Http\Controllers\Api\Admin\UserController;
use App\Services\Admin\UserService;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testStore() {

        $response = $this->postJson('/api/admin/user/store/', ['name' => 'Sally', 'surname' => 'sss', 'email' => 'ddsd@mail.ru', 'password' => 'sadsad'],['Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiYWMxZjJkMmZkYWVhNTg4N2ZmM2QzNWViNTI2YTMyMzM1OGNiYjdhN2MyYzM4NWRmZGU1NjJjNDQ3YmJlNmRlOWMzMWUxMTM2YTE4Yjc4NjUiLCJpYXQiOjE1OTM1MTI0NjYsIm5iZiI6MTU5MzUxMjQ2NiwiZXhwIjoxNjI1MDQ4NDY2LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.bgzZs7Lbr31vzjOonP7eM3wPeIlMjfFihkw8Y1v5oCc4vh7_xcjZ_i0GBr8Ouv_2bqcZLZdVnw5rSlsroYHFkV8KL4b6FMO46ag5JYAY6BNiaKlsB4QNRyAm0xJudiZNFqffxUOj5L-bhyLdr0JGxQBMc9p3DFaPz9JzDhV2oNpTFMYdR-ETM-poI5IWyGfXHYeF15LyJtPJODtgqW_GcIiyfwz9kYkpm3Dz57eNheWc0qnNaGoWHMqhjdC_EMOvH_tt7Fn8QZxNAF3cMH_TuHQU3nOKwgypI6VyzR6j1Y2u02DYkx-296xjH-r87nVYPFH5oDQSkAKWHBxMG_soaAXy72RGd-Gxq-S_6ryBfRwfUP1P47GLDjlDdO86DHismVXjwbqKImV0dvhrBtdn5_bnPVNsyw6mOZGzEteIIxzgNB9ngyCa1g9rlJcaz_u5ybXyy99MO1ORPll-Zl9N-vzwLwSAgpOhyUvFUIySVCWl9sqiTEfSzhm9rkyZRJ2h5QU6kWchEiaRKBzrp9DR3Lvco3ChlTwhM0JvqROV0KgkmO30-yFMpU9zDxOZhFPy-z6N44Qtqm6-1ujIxrw0grX6fk02Zrru68YkFrwWm8_ieAMYwzlgJqyy5Q9UCYH7_xcn4L56Ws0OQKKlEZhqZBG0OVVe_8GraYP9ZWttlLk']);

        $response
            ->assertStatus(200)
            /*->assertJson([
                'created' => true,
            ])*/;
    }
}
