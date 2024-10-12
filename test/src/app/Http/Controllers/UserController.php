<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->input('gender');
        
        if ($gender === '全て') {
            $users = Contact::whereIn('gender', ['1', '2', '3'])->get();
        } else {
            $users = Contact::where('gender', $gender)->get();
        };

        $categories = Category::all();
        $contacts = Contact::search()->Paginate(7);
        $search_params = $request->only([
            'id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        return view('auth.admin', compact('contacts','categories','users', 'search_params'));
    }


        


    public function csvDownload() {
        $contacts = Contact::search()->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv"
        ];

        $callback = function() use($contacts) {
            $handle = fopen('php://output', 'w');

            $columns = [
                'id',
                'first_name',
                'last_name',
                'gender',
                'email',
                'tel',
                'address',
                'building',
                'category_id',
                'detail'
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($handle, $columns);

            foreach($contacts as $contact) {
                $csv = [
                    $contact->id,
                    $contact->first_name,
                    $contact->last_name,
                    $contact->gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category_id,
                    $contact->detail,
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($handle, $csv);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);

    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

}
