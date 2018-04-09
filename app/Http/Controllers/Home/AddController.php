<?php



namespace App\Http\Controllers\Home;

use App\Models\AdminRotation;
use App\Model\HomeUser;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use Illuminate\Support\Facades\Validator;

use App\Models\Cate;

class AddController extends Controller
{

    public function index()
    {
        //查询所有类别
        $cate = Cate::get();

        // dd($cate);
        $tree = Cate::subtree($cate);
        // dd($tree);

        return view('home.addgoods.index',compact('tree'));
    }

    // 二级类
    public function two(Request $request)
    {
        $gid = $request->input('gid');
        //查询所有类别
        // return $gid;

        $two = Cate::where('pid',$gid)->get();

        return $two;
    }

    // 三级类
     public function three(Request $request)
    {
        $gid = $request->input('gid');
        //查询所有类别
        // return $gid;

        $three = Cate::where('pid',$gid)->get();

        return $three;
    }

    // 执行发布商品
    public function doadd(Request $request)
    {
        // dd($request);
        $input = $request->except('_token');

        // dd($input);

        $rule = [
            'cname' => 'required',
            'gname' => 'required',
            'file_upload' => 'required',
            'price' => 'required',
            'gdesc' => 'required',

        ];

        $msg = [
            'cname.required' => '请选择类别',
            'gname.required' => '商品名称不能为空',
            'file_upload.required' => '请上传商品图片',
            'price.required' => '价格不能为空',
            'gdesc.required' => '商品描述不能为空',
        ];

        $validator = Validator::make($input, $rule, $msg);

        // 2. 如果验证失败
            if ($validator->fails()) {
                return redirect('home/addgoods')
                    ->withErrors($validator)
                    ->withInput();
            }



        // $arr['cate_name'] = $input['cname'];
        $cate = Cate::where('cate_name',$input['cname'])->first();

        // $user['user_name']session('user')->uname

        $data['uid'] = session('user')->uid;

        $data['cid'] = $cate['id'];
        $data['gname'] = $input['gname'];
        $data['gpic'] = $input['art_thumb'];
        $data['price'] = $input['price'];
        $data['gdesc'] = $input['gdesc'];
        $data['addtime'] = time();

        // dd($data);

        $row = Goods::create($data);

        if ( $row ) {
            // flash('发布成功')->error();
            flash('发布成功')->success();
            return redirect('home/addgoods');
        }
        flash('发布失败')->error();
        return redirect('home/addgoods');


    }


}
