<?php

namespace App\Policies;

use App\User;
use App\Map;
use Illuminate\Auth\Access\HandlesAuthorization;

class MapPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any maps.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // return $user_id === $map->user_id;
    }

    /**
     * Determine whether the user can view the map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function view(User $user, Map $map)
    {
        return $user->id === $map->user_id;
    }

    /**
     * Determine whether the user can create maps.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function update(User $user, Map $map)
    {
        return $user->id === $map->user_id;        
    }

    /**
     * Determine whether the user can delete the map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function delete(User $user, Map $map)
    {
        return $user->id === $map->user_id;        
    }

    /**
     * Determine whether the user can restore the map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function restore(User $user, Map $map)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function forceDelete(User $user, Map $map)
    {
        //
    }
}
