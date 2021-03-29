<?php

namespace App\Imports;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UsersImport implements ToCollection,WithHeadingRow,WithProgressBar
{
    use Importable,SkipsFailures,SkipsErrors;

    public  $tag;
    public $admin_id;
    public function __construct($tag,$admin_id)
    {
        $this->admin_id=$admin_id;
        $this->tag=$tag;
    }
    public function headingRow(): int
    {
        return 1;
    }
    public function collection(Collection $collection)
    {
            foreach ($collection as $row){
                    $user= User::where('phone',$row['phone'])->where('tag_id',$this->tag)->first();

             if (!$user){
                $user= new User();
             }
             $user->name=$row['name'] ?? '';
             $user->email=$row['email'] ?? '';
             $user->phone=$row['phone'] ?? '';
             $user->country=$row['country'];
             $user->province=$row['province'];
             $user->password=bcrypt('123456');
             $user->city=$row['city'];
             $user->tag_id=$this->tag;
             $user->since=$row['since'];
             $user->admin_id=$this->admin_id;
             $user->save();
            }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new User([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'phone'=>$row['phone'],
            'country'=>$row['country'],
            'province'=>$row['province'],
            'since'=>$row['since'],
            'address'=>$row['address'],
            'city'=>$row['city'],
            'password'=>bcrypt('123456'),
            'tag_id'=>$this->tag,
            'admin_id'=>$this->admin_id
        ]);

    }
    public function rules():array
    {

     return [
            /* 'email'=>['required',
                  Rule::unique('users')->where('tag_id',$this->tag)
              ]*/
        ];

    }



}
