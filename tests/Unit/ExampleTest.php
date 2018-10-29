<?php

namespace Tests\Unit;
use App\Message;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Tests\AbstractTestCase;

class ExampleTest extends AbstractTestCase
{
    /**
     * Проверка содержимого на странице.
     *
     * @return void
     */
    public function testHeaderText()
    {
        $this->get('/')->assertSee('Messages wall');
    }

    /**
     * Создание обычного пользователя, без Списка пользователей
     *
     * @return void
     */
    public function testLoginByUser()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get('/')->assertDontSee('Список пользователей');
    }

    /**
     * Попытка входа админа, со Списком пользователей
     *
     * @return void
     */
    public function testLoginByAdmin()
    {
        $user = User::find(1);
        $this->actingAs($user)->get('/')->assertSee('Список пользователей');
    }

    /**
     * Добавление нового сообщения от пользователя
     *
     * @return void
     */
    public function testAddMessage()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post('/add',['text'=>'This IS UNIQUE TEXT','_token' => csrf_token()])->assertRedirect('/');
        $this->get('/')->assertSee('This IS UNIQUE TEXT');
    }


    /**
     * Проверка на не доступность ввода существующего сообщения
     *
     * @return void
     */
    public function testCannotAddingTheSameMessage()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post('/add',['text'=>'This IS UNIQUE TEXT','_token' => csrf_token()])->assertRedirect('/');
        $this->get('/')->assertSee('Такое сообщение уже отправлено');
    }


    /**
     * Попытка удаления сообщения админом
     *
     * @return void
     */
    public function testDeleteMessageByAdmin()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->create(['user_id'=>$user->id]);

        $user = User::find(1);
        $this->actingAs($user)->delete('/message/'.$message->id)->assertRedirect('/');
        $this->get('/')->assertDontSee($message->text);
    }

    /**
     * Не удачная попытка удаления пользователем чужого сообщения
     *
     * @return void
     */
    public function testDeleteMessageByUser()
    {
        $user = User::find(1);
        $message = factory(Message::class)->create(['user_id'=>$user->id]);

        $user = factory(User::class)->create();
        $this->actingAs($user)->delete('/message/'.$message->id)->assertRedirect('/');
        $this->get('/')->assertSee($message->text);
    }
}
