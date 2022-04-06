<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    protected $users;

    public function __construct(Request $request, $role=null)
    {
        $query = User::query();

        if ($role)
            $query->role($role);
        
        if (auth()->user()->hasRole('Patient'))
            $query->where('id', auth()->id());
        
        $this->users = $query->get();
    }

    /**
    * @return Illuminate\Contracts\View\View
    */
    public function view(): View
    {
        return view('exports.users', [
            'users' => $this->users
        ]);
    }
}
