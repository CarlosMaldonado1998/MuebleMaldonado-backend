<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Illuminate\Notifications\Notifiable;

class User extends JsonResource implements CanResetPasswordInterface
{
    use Notifiable;
    use CanResetPassword;
    protected $token;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token=$token;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'lastname' => $this->lastname,
            'cellphone' => $this->cellphone,
            'city' => $this->city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
            ];
    }
}
