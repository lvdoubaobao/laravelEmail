<?php

namespace App\Imports;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UsersImport implements ToModel,WithBatchInserts,WithChunkReading,WithValidation,WithHeadingRow,SkipsOnError,SkipsOnFailure
{
    use Importable,SkipsFailures,SkipsErrors;

    public  $tag;
    public function __construct($tag)
    {

        $this->tag=$tag;
    }
    public function headingRow(): int
    {
        return 1;
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
            'tag_id'=>$this->tag
        ]);

    }
    public function rules():array
    {

     return [
          'email'=>['required',
                  Rule::unique('users')->where('tag_id',$this->tag)
              ]
        ];

    }
    public function chunkSize(): int
    {
       return 100;
    }
    public function batchSize(): int
    {
       return 100;
    }


}
