<?php


namespace App\Services\Admin;


use App\Jobs\EmailSend;
use App\Models\Event;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\False_;

class UserService extends BaseService
{
    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->set_model($user);
    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        $users = $this->baseModel->paginate(15, ['name', 'surname', 'email']);
        return $users;
    }

    /**
     * @param $data
     * @return \Illuminate\Support\Collection
     */
    public function searchUserByEvent($data)
    {
        $users = collect([]);
        if (!empty($data)){
            $event = Event::find($data['search'],['id']);
            if (!$event){
                return collect([]);
            }
            $users = $event->users;
        }
        return $users;
    }

    /**
     * @param $data
     * @return array|bool
     */
    public function createUser($data)
    {
        DB::beginTransaction();
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        if (!$user){
            DB::rollBack();
            return false;
        }

        if (!$user->events()->sync($data['events'])){
            DB::rollBack();
            return false;
        }
        dispatch(new EmailSend($user));
        DB::commit();
        $http = new Client();
        $response = $http->post(config('app.url').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('auth.passport.password.id'),
                'client_secret' => config('auth.passport.password.secret'),
                'username' => $data['email'],
                'password' => $data['password'],
                'scope' => '',
            ],
        ]);

        return [$user, $response];
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateUser($id, $data)
    {
        DB::beginTransaction();
        $user = $this->baseModel->find($id);

        if (!$user){
            DB::rollBack();
            return false;
        }
        if (!$user->update($data)){
            DB::rollBack();
            return false;
        }

        if (!$user->events()->sync($data['events'])){
            DB::rollBack();
            return false;
        }
        DB::commit();

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->baseModel->with('events:name,date,city')->find($id, ['id', 'name', 'surname', 'email']);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $deleteItem = $this->baseModel->find($id);
        if (!$deleteItem) {
            return false;
        }
        $deleted = $deleteItem->delete();
        return $deleted;
    }
}
