<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'employee';

    protected $fillable = [
        'em_name',
        'em_birth',
        'em_email',
        'em_gender',
        'em_password',
        'em_phone',
        'status',
        'em_summary'
    ];

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return Employee
     */
    public function findForPassport($username)
    {
        return $this->where('em_name', $username)->first();
    }

    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return $password === $this->em_password;
    }
}
