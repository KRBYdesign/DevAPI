<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class MyUser
{
    protected string $table = 'users';

    protected ?int $id;
    protected string $name;
    protected string $email;
    protected string $password;
    protected bool $admin;

    public function __construct(string $name, string $email, string $password, bool $admin, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->admin = $admin;
    }

    /**
     * Creates a temporary user object for registration.
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param bool $admin
     * @return MyUser
     */
    public static function forRegistration(string $name, string $email, string $password, bool $admin = false) : MyUser
    {
        return new MyUser($name, $email, $password, $admin);
    }

    /**
     * Register (save) a new user from the registration page. Appends the user's ID to the user object.
     *
     * @return $this
     */
    public function register() : MyUser
    {
        $id = DB::table($this->table)->insertGetId([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'admin' => $this->admin,
        ]);

        $this->id = $id;

        return $this;
    }

    /**
     * Check if a given user object exists within the database.
     *
     * @return bool
     */
    public function exists() : bool
    {
        return DB::table($this->table)->where('email', $this->email)->exists();
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function isAdmin() : bool
    {
        return $this->admin;
    }
}
