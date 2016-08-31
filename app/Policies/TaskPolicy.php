<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Task $task
     * @return bool
     * @comment Determine if the user can delete the given task.
     */
    public function destroy(User $user, Task $task){
        return $user->id == $task->user_id;
    }
}
